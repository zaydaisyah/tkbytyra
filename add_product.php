<?php
// add_product.php
require 'db.php';
require 'functions.php';
require 'auth.php';

$title = "Add New Product";
$product = [
    'id' => '', 'name' => '', 'product_code' => '', 'category_id' => '', 
    'supplier_id' => '', 'description' => '', 'cost_price' => '', 
    'selling_price' => '', 'quantity' => '', 'min_stock_level' => 5, 'image_path' => ''
];

$is_edit = false;

// Handle Edit
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $fetch = $stmt->fetch();
    if ($fetch) {
        $product = $fetch;
        $title = "Edit Product: " . htmlspecialchars($product['name']);
        $is_edit = true;
    }
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $product_code = sanitize($_POST['product_code']);
    $category_id = $_POST['category_id'] ?: null;
    $supplier_id = $_POST['supplier_id'] ?: null;
    $description = sanitize($_POST['description']);
    $cost_price = $_POST['cost_price'];
    $selling_price = $_POST['selling_price'];
    $min_stock = $_POST['min_stock_level'];
    
    // Only update quantity on create, stock management handles changes later
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : $product['quantity'];

    // Image Upload
    $image_path = $product['image_path'];
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    try {
        if ($is_edit) {
            $stmt = $pdo->prepare("UPDATE products SET name=?, product_code=?, category_id=?, supplier_id=?, description=?, cost_price=?, selling_price=?, min_stock_level=?, image_path=? WHERE id=?");
            $stmt->execute([$name, $product_code, $category_id, $supplier_id, $description, $cost_price, $selling_price, $min_stock, $image_path, $product['id']]);
            logAction($pdo, 'Update Product', "Updated product ID: " . $product['id']);
        } else {
            $stmt = $pdo->prepare("INSERT INTO products (name, product_code, category_id, supplier_id, description, cost_price, selling_price, quantity, min_stock_level, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $product_code, $category_id, $supplier_id, $description, $cost_price, $selling_price, $quantity, $min_stock, $image_path]);
            $new_id = $pdo->lastInsertId();
            
            // Log initial stock movement
            if ($quantity > 0) {
                $stmt = $pdo->prepare("INSERT INTO stock_movements (product_id, user_id, type, quantity, reason) VALUES (?, ?, 'in', ?, 'Initial Stock')");
                $stmt->execute([$new_id, $_SESSION['user_id'], $quantity]);
            }
            logAction($pdo, 'Add Product', "Added product: $name");
        }
        redirect('inventory.php');
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$suppliers = $pdo->query("SELECT * FROM suppliers")->fetchAll();

include 'includes/header.php';
?>

<div class="glass-card animate-fade-in" style="max-width: 900px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(0,0,0,0.05);">
        <h3 style="color: var(--text-main); margin-bottom: 0;"><?php echo $title; ?></h3>
        <a href="inventory.php" class="btn btn-outline-secondary" style="padding: 5px 15px;">Cancel</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" style="margin-bottom: 20px;"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Product Name *</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">SKU / Barcode</label>
                <input type="text" name="product_code" class="form-control" value="<?php echo htmlspecialchars($product['product_code']); ?>">
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Category</label>
                <select name="category_id" class="form-select">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $product['category_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label" style="font-weight: 600;">Supplier</label>
                <select name="supplier_id" class="form-select">
                    <option value="">Select Supplier</option>
                    <?php foreach ($suppliers as $sup): ?>
                        <option value="<?php echo $sup['id']; ?>" <?php echo $sup['id'] == $product['supplier_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($sup['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
    
            <div class="col-12 mb-3">
                <label class="form-label" style="font-weight: 600;">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
    
            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Cost Price</label>
                <input type="number" step="0.01" name="cost_price" class="form-control" value="<?php echo $product['cost_price']; ?>" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Selling Price</label>
                <input type="number" step="0.01" name="selling_price" class="form-control" value="<?php echo $product['selling_price']; ?>" required>
            </div>
            
            <?php if (!$is_edit): ?>
            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Initial Stock Quantity</label>
                <input type="number" name="quantity" class="form-control" value="0">
            </div>
            <?php else: ?>
            <div class="col-md-4 mb-3">
                 <label class="form-label" style="font-weight: 600;">Current Stock</label>
                 <input type="text" class="form-control" value="<?php echo $product['quantity']; ?>" disabled style="background-color: rgba(0,0,0,0.05);">
                 <small class="text-muted">Use 'Stock Management' page to update stock.</small>
            </div>
            <?php endif; ?>
    
            <div class="col-md-4 mb-3">
                <label class="form-label" style="font-weight: 600;">Min. Stock Level</label>
                <input type="number" name="min_stock_level" class="form-control" value="<?php echo $product['min_stock_level']; ?>">
            </div>
    
            <div class="col-md-8 mb-3">
                <label class="form-label" style="font-weight: 600;">Product Image</label>
                <input type="file" name="image" class="form-control">
                <?php if ($product['image_path']): ?>
                    <div class="mt-2" style="display: flex; align-items: center; gap: 10px;">
                        <img src="<?php echo htmlspecialchars($product['image_path']); ?>" width="50" class="img-thumbnail" style="border-radius: 8px;"> 
                        <small>Current Image</small>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="col-12 mt-4" style="text-align: right;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem; font-size: 1rem;"><i class="fas fa-save"></i> Save Product</button>
            </div>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
