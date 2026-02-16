<?php
// stock_manage.php
require 'db.php';
require 'functions.php';
require 'auth.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $type = $_POST['type']; // 'in' or 'out'
    $quantity = (int)$_POST['quantity'];
    $reason = sanitize($_POST['reason']);
    $user_id = $_SESSION['user_id'];

    if ($quantity > 0 && $product_id) {
        try {
            $pdo->beginTransaction();

            // Verify stock for 'out'
            if ($type === 'out') {
                $curr_stock = $pdo->prepare("SELECT quantity FROM products WHERE id = ?");
                $curr_stock->execute([$product_id]);
                $current = $curr_stock->fetchColumn();
                
                if ($current < $quantity) {
                    throw new Exception("Insufficient stock available.");
                }
                $sql = "UPDATE products SET quantity = quantity - ? WHERE id = ?";
            } else {
                $sql = "UPDATE products SET quantity = quantity + ? WHERE id = ?";
            }

            // Update Product
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$quantity, $product_id]);

            // Record Movement
            $log = $pdo->prepare("INSERT INTO stock_movements (product_id, user_id, type, quantity, reason) VALUES (?, ?, ?, ?, ?)");
            $log->execute([$product_id, $user_id, $type, $quantity, $reason]);

            $pdo->commit();
            $success = "Stock updated successfully.";
            logAction($pdo, 'Stock Update', "Stock $type: $quantity items for product ID $product_id");

        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Invalid quantity or product.";
    }
}

$products = $pdo->query("SELECT id, name, product_code, quantity FROM products ORDER BY name ASC")->fetchAll();

include 'includes/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Stock Management</h1>
</div>

<?php if ($success): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="row">
    <!-- Stock In/Out Form -->
    <div class="col-md-6 mb-4">
        <div class="glass-card h-100">
            <h3 style="margin-bottom: 1.5rem; color: var(--text-main);"><i class="fas fa-boxes" style="color: var(--primary-color);"></i> Update Stock</h3>
            
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Select Product</label>
                    <div style="position: relative;">
                         <select name="product_id" class="form-select" required onchange="updateStockInfo(this)">
                            <option value="">-- Choose Product --</option>
                            <?php foreach ($products as $p): ?>
                                <option value="<?php echo $p['id']; ?>" data-qty="<?php echo $p['quantity']; ?>">
                                    <?php echo htmlspecialchars($p['name']); ?> (Current: <?php echo $p['quantity']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                <label class="form-label" style="font-weight: 600;">Action</label>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="type" id="stockIn" value="in" checked>
                        <label class="btn btn-outline-success flex-grow-1" for="stockIn">Stock In (+)</label>

                        <input type="radio" class="btn-check" name="type" id="stockOut" value="out">
                        <label class="btn btn-outline-danger flex-grow-1" for="stockOut">Stock Out (-)</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-weight: 600;">Reason / Notes</label>
                    <input type="text" name="reason" class="form-control" placeholder="e.g. New Shipment, Damaged, Sold">
                </div>

                <button type="submit" class="btn btn-primary w-100" style="padding: 10px;">Update Stock</button>
            </form>
        </div>
    </div>
    
    <!-- Recent Movements -->
    <div class="col-md-6 mb-4">
        <div class="glass-card h-100">
            <h3 style="margin-bottom: 1.5rem; color: var(--text-main);"><i class="fas fa-history" style="color: var(--accent-dark);"></i> Recent Movements</h3>
            
            <div class="table-container">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT sm.*, p.name as product_name, u.username 
                                             FROM stock_movements sm 
                                             JOIN products p ON sm.product_id = p.id 
                                             LEFT JOIN users u ON sm.user_id = u.id 
                                             ORDER BY sm.created_at DESC LIMIT 10");
                        while ($row = $stmt->fetch()): 
                        ?>
                        <tr>
                            <td style="font-size: 0.9em;"><?php echo date('d M H:i', strtotime($row['created_at'])); ?></td>
                            <td style="font-weight: 500;"><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td>
                                <?php if ($row['type'] == 'in'): ?>
                                    <span class="badge badge-ok">IN</span>
                                <?php else: ?>
                                    <span class="badge badge-low">OUT</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight: bold;"><?php echo $row['quantity']; ?></td>
                            <td style="color: grey;"><small><?php echo htmlspecialchars($row['username']); ?></small></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
