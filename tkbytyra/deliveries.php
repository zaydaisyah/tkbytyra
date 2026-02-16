<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$page_title = "Delivery Management";

// Fetch deliveries with product info
$query = "SELECT d.*, p.name as product_name, p.product_code 
          FROM deliveries d 
          LEFT JOIN products p ON d.product_id = p.id 
          ORDER BY d.created_at DESC";
$stmt = $pdo->query($query);
$deliveries = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="dashboard-header animate-fade-in">
    <div class="header-titles">
        <h1>Delivery Management</h1>
        <p>Track customer shipments, tracking numbers, and delivery statuses</p>
    </div>
    <div class="header-actions">
        <a href="add_delivery.php" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> New Delivery
        </a>
    </div>
</div>

<div class="glass-card animate-slide-up">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Product & Qty</th>
                    <th>Customer Details</th>
                    <th>Address</th>
                    <th>Carrier Info</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($deliveries)): ?>
                <tr>
                    <td colspan="6" class="text-center">No deliveries found.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($deliveries as $d): ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <div class="product-name" style="font-weight: 600; color: var(--text-dark);">
                                    <?php echo htmlspecialchars($d['product_name'] ?? 'Unknown Product'); ?>
                                </div>
                                <div class="product-meta" style="font-size: 0.8rem; color: var(--text-light);">
                                    Code: <?php echo htmlspecialchars($d['product_code'] ?? 'N/A'); ?> | 
                                    <strong>Qty: <?php echo htmlspecialchars($d['quantity']); ?></strong>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="customer-info">
                                <div class="customer-name"><?php echo htmlspecialchars($d['customer_name']); ?></div>
                                <div class="customer-email"><?php echo htmlspecialchars($d['customer_email']); ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="address-cell" title="<?php echo htmlspecialchars($d['customer_address']); ?>">
                                <?php echo htmlspecialchars(substr($d['customer_address'], 0, 50)) . (strlen($d['customer_address']) > 50 ? '...' : ''); ?>
                            </div>
                        </td>
                        <td>
                            <div class="carrier-info">
                                <div class="tracking-no">
                                    <i class="fa-solid fa-hashtag"></i> <?php echo htmlspecialchars($d['tracking_number'] ?? 'Not Assigned'); ?>
                                </div>
                                <div class="courier-name">
                                    <i class="fa-solid fa-truck-fast"></i> <?php echo htmlspecialchars($d['courier_name'] ?? 'N/A'); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php 
                                $status_class = 'status-pending';
                                if ($d['status'] == 'Shipped') $status_class = 'status-shipped';
                                if ($d['status'] == 'Delivered') $status_class = 'status-delivered';
                                if ($d['status'] == 'Cancelled') $status_class = 'status-cancelled';
                                if ($d['status'] == 'Processing') $status_class = 'status-processing';
                            ?>
                            <span class="status-badge <?php echo $status_class; ?>">
                                <?php echo $d['status']; ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="edit_delivery.php?id=<?php echo $d['id']; ?>" class="btn-icon" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                <button class="btn-icon delete-delivery" data-id="<?php echo $d['id']; ?>" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .customer-info {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }
    .customer-name {
        font-weight: 600;
        color: var(--text-dark);
    }
    .customer-email {
        font-size: 0.85rem;
        color: var(--text-light);
    }
    .address-cell {
        font-size: 0.9rem;
        max-width: 250px;
        color: var(--text-light);
    }
    .carrier-info {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        font-size: 0.9rem;
    }
    .tracking-no {
        font-family: 'Courier New', Courier, monospace;
        font-weight: 600;
        color: var(--primary-color);
    }
    .courier-name {
        color: var(--text-light);
    }
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending { background: rgba(255, 193, 7, 0.1); color: #856404; }
    .status-processing { background: rgba(0, 123, 255, 0.1); color: #004085; }
    .status-shipped { background: rgba(23, 162, 184, 0.1); color: #0c5460; }
    .status-delivered { background: rgba(40, 167, 69, 0.1); color: #155724; }
    .status-cancelled { background: rgba(220, 53, 69, 0.1); color: #721c24; }
</style>

<?php include 'includes/footer.php'; ?>
