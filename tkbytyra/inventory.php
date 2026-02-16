<?php
// inventory.php
require 'db.php';
require 'functions.php';
require 'auth.php';

$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? sanitize($_GET['category']) : '';
$status_filter = isset($_GET['status']) ? sanitize($_GET['status']) : '';
$sort = isset($_GET['sort']) ? sanitize($_GET['sort']) : 'name_asc';

// Build Query
$query = "SELECT p.*, c.name as category_name, s.name as supplier_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          LEFT JOIN suppliers s ON p.supplier_id = s.id 
          WHERE 1=1";
$params = [];

if ($search) {
    $query .= " AND (p.name LIKE ? OR p.product_code LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category_filter) {
    $query .= " AND p.category_id = ?";
    $params[] = $category_filter;
}

if ($status_filter) {
    if ($status_filter === 'low') {
        $query .= " AND p.quantity <= p.min_stock_level AND p.quantity > 0";
    } elseif ($status_filter === 'out') {
        $query .= " AND p.quantity = 0";
    } elseif ($status_filter === 'in') {
        $query .= " AND p.quantity > p.min_stock_level";
    }
}

// Sorting
switch ($sort) {
    case 'qty_asc': $query .= " ORDER BY p.quantity ASC"; break;
    case 'qty_desc': $query .= " ORDER BY p.quantity DESC"; break;
    case 'name_desc': $query .= " ORDER BY p.name DESC"; break;
    default: $query .= " ORDER BY p.name ASC"; break;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Fetch Categories for Filter
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

include 'includes/header.php';
?>



<div class="glass-container glass-card animate-fade-in" style="margin-top: 2rem;">
    <!-- Filters Toolbar -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 10px;">
        <form method="GET" style="display: flex; gap: 1rem; flex-grow: 1;">
            <div style="position: relative; flex-grow: 1;">
                 <input type="text" name="search" class="form-control" placeholder="Search product name or SKU..." value="<?php echo $search; ?>" 
                    style="padding-left: 2.5rem;">
                 <i class="fas fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: var(--text-light);"></i>
            </div>
            
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $category_filter ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="in" <?php echo $status_filter == 'in' ? 'selected' : ''; ?>>In Stock</option>
                <option value="low" <?php echo $status_filter == 'low' ? 'selected' : ''; ?>>Low Stock</option>
                <option value="out" <?php echo $status_filter == 'out' ? 'selected' : ''; ?>>Out of Stock</option>
            </select>
            
            <!-- Hide submit if auto-submitting on change, but keep for search -->
            <button type="submit" class="btn btn-primary" style="padding: 0 1.5rem;"><i class="fas fa-filter"></i></button>
        </form>
        
        <a href="add_product.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Product</a>
    </div>



    <!-- Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 40px; height: 40px; background: #eee; border-radius: 8px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                                <?php if ($p['image_path']): ?>
                                    <img src="<?php echo htmlspecialchars($p['image_path']); ?>" alt="img" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <i class="fa-solid fa-image" style="color:#ccc;"></i>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span style="font-weight: 500; display: block;"><?php echo htmlspecialchars($p['name']); ?></span>
                                <small style="color: grey;"><?php echo htmlspecialchars($p['supplier_name'] ?? ''); ?></small>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($p['product_code']); ?></td>
                        <td><?php echo htmlspecialchars($p['category_name']); ?></td>
                        <td><?php echo formatPrice($p['selling_price']); ?></td>
                        <td class="text-center font-weight-bold"><?php echo $p['quantity']; ?></td>
                        <td class="text-center">
                            <?php if ($p['quantity'] <= 0): ?>
                                <span class="badge" style="background: #FFDDD2; color: #E76F51;">Out of Stock</span>
                            <?php elseif ($p['quantity'] <= $p['min_stock_level']): ?>
                                <span class="badge badge-low">Low Stock</span>
                            <?php else: ?>
                                <span class="badge badge-ok">In Stock</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="add_product.php?edit=<?php echo $p['id']; ?>" class="btn" style="padding: 5px 10px; color: var(--text-light);" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <?php if (isAdmin()): ?>
                                    <a href="delete_product.php?id=<?php echo $p['id']; ?>" class="btn" style="padding: 5px 10px; color: #e76f51;" onclick="return confirm('Are you sure?')" title="Delete"><i class="fa-solid fa-trash"></i></a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-4">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
