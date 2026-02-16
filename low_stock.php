<?php
// low_stock.php
require 'db.php';
require 'functions.php';
require 'auth.php';

$stmt = $pdo->query("SELECT p.*, s.name as supplier_name, s.email as supplier_email, s.contact_person 
                     FROM products p 
                     LEFT JOIN suppliers s ON p.supplier_id = s.id 
                     WHERE p.quantity <= p.min_stock_level
                     ORDER BY p.quantity ASC");
$products = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="glass-card animate-fade-in">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="color: var(--text-main);"><i class="fas fa-exclamation-triangle" style="color: var(--accent-pink);"></i> Low Stock Alerts</h3>
        <button onclick="window.print()" class="btn btn-outline-secondary">
            <i class="fas fa-print"></i> Print List
        </button>
    </div>

    <div class="glass-panel" style="padding: 1rem; margin-bottom: 2rem; background: rgba(255, 243, 205, 0.6); border: 1px solid rgba(255, 238, 186, 0.8);">
        <i class="fas fa-info-circle text-warning"></i> The following items are below their minimum stock level. Immediate reorder is recommended.
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Supplier</th>
                    <th class="text-center">Min Level</th>
                    <th class="text-center">Current Stock</th>
                    <th class="text-center">Status</th>
                    <th>Reorder Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td>
                            <strong style="color: var(--text-main);"><?php echo htmlspecialchars($p['name']); ?></strong><br>
                            <small class="text-muted">SKU: <?php echo htmlspecialchars($p['product_code']); ?></small>
                        </td>
                        <td>
                            <?php if ($p['supplier_name']): ?>
                                <?php echo htmlspecialchars($p['supplier_name']); ?><br>
                                <small class="text-muted"><?php echo htmlspecialchars($p['contact_person']); ?></small>
                            <?php else: ?>
                                <span class="text-muted">No Supplier</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo $p['min_stock_level']; ?></td>
                        <td class="text-center font-weight-bold" style="color: #e76f51;"><?php echo $p['quantity']; ?></td>
                        <td class="text-center">
                            <?php if ($p['quantity'] <= 0): ?>
                                <span class="badge" style="background: #FFDDD2; color: #E76F51;">OUT OF STOCK</span>
                            <?php else: ?>
                                <span class="badge" style="background: #FFF3CD; color: #856404;">LOW STOCK</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="stock_manage.php" class="btn btn-primary" style="padding: 5px 12px; font-size: 0.85rem;">
                                    <i class="fas fa-dolly"></i> Restock
                                </a>
                                <?php if ($p['supplier_email']): ?>
                                    <a href="mailto:<?php echo $p['supplier_email']; ?>?subject=Reorder: <?php echo urlencode($p['name']); ?>&body=Please send more stock of <?php echo urlencode($p['name']); ?>." class="btn btn-outline-secondary" style="padding: 5px 12px; font-size: 0.85rem;">
                                        <i class="fas fa-envelope"></i> Email Supplier
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4" style="color: #2D6A4F;"><i class="fas fa-check-circle"></i> No low stock items!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
