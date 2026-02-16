<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    header("Location: deliveries.php");
    exit();
}

$page_title = "Update Delivery Status";
$success = "";
$error = "";

// Fetch current data
$stmt = $pdo->prepare("SELECT * FROM deliveries WHERE id = ?");
$stmt->execute([$id]);
$delivery = $stmt->fetch();

if (!$delivery) {
    header("Location: deliveries.php");
    exit();
}

// Fetch products for dropdown
$products = $pdo->query("SELECT id, name, product_code FROM products ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['customer_name'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $tracking_number = $_POST['tracking_number'];
    $courier_name = $_POST['courier_name'];
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("UPDATE deliveries SET product_id = ?, quantity = ?, customer_name = ?, customer_email = ?, customer_address = ?, tracking_number = ?, courier_name = ?, status = ? WHERE id = ?");
        $stmt->execute([$product_id, $quantity, $customer_name, $customer_email, $customer_address, $tracking_number, $courier_name, $status, $id]);
        
        // Log to audit
        $audit_stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, 'Update Delivery', ?)");
        $audit_stmt->execute([$_SESSION['user_id'], "Updated delivery #$id for customer: $customer_name (Qty: $quantity)"]);
        
        $success = "Delivery updated successfully!";
        // Refresh data
        $stmt = $pdo->prepare("SELECT * FROM deliveries WHERE id = ?");
        $stmt->execute([$id]);
        $delivery = $stmt->fetch();
    } catch (PDOException $e) {
        $error = "Failed to update delivery: " . $e->getMessage();
    }
}

include 'includes/header.php';
?>

<div class="dashboard-header animate-fade-in">
    <div class="header-titles">
        <h1>Update Delivery #<?php echo $id; ?></h1>
        <p>Modify shipment details for <?php echo htmlspecialchars($delivery['customer_name']); ?></p>
    </div>
    <div class="header-actions">
        <a href="deliveries.php" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="glass-card animate-slide-up" style="max-width: 800px; margin: 0 auto;">
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" class="luxury-form">
        <div class="form-grid">
            <div class="form-group">
                <label for="product_id">Product to Deliver *</label>
                <select id="product_id" name="product_id" required>
                    <option value="">-- Select Product --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?php echo $p['id']; ?>" <?php echo $delivery['product_id'] == $p['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($p['name']); ?> (<?php echo htmlspecialchars($p['product_code']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity *</label>
                <input type="number" id="quantity" name="quantity" required min="1" value="<?php echo htmlspecialchars($delivery['quantity']); ?>">
            </div>

            <div class="form-group full-width">
                <label for="customer_name">Customer Name *</label>
                <input type="text" id="customer_name" name="customer_name" required value="<?php echo htmlspecialchars($delivery['customer_name']); ?>">
            </div>
            
            <div class="form-group">
                <label for="customer_email">Customer Email</label>
                <input type="email" id="customer_email" name="customer_email" value="<?php echo htmlspecialchars($delivery['customer_email']); ?>">
            </div>

            <div class="form-group">
                <label for="status">Delivery Status</label>
                <select id="status" name="status">
                    <option value="Pending" <?php echo $delivery['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                    <option value="Processing" <?php echo $delivery['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                    <option value="Shipped" <?php echo $delivery['status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                    <option value="Delivered" <?php echo $delivery['status'] == 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                    <option value="Cancelled" <?php echo $delivery['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label for="customer_address">Shipping Address *</label>
                <textarea id="customer_address" name="customer_address" required rows="3"><?php echo htmlspecialchars($delivery['customer_address']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="courier_name">Courier Name</label>
                <input type="text" id="courier_name" name="courier_name" value="<?php echo htmlspecialchars($delivery['courier_name'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="tracking_number">Tracking Number</label>
                <input type="text" id="tracking_number" name="tracking_number" value="<?php echo htmlspecialchars($delivery['tracking_number'] ?? ''); ?>">
            </div>
        </div>

        <div class="form-footer" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-save"></i> Update Delivery
            </button>
        </div>
    </form>
</div>

<style>
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .full-width {
        grid-column: span 2;
    }
    .luxury-form input, .luxury-form select, .luxury-form textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        border: 1px solid rgba(176, 137, 104, 0.2);
        background: rgba(255, 255, 255, 0.5);
        font-family: inherit;
        transition: all 0.3s ease;
    }
    .luxury-form input:focus, .luxury-form select:focus, .luxury-form textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(176, 137, 104, 0.1);
        outline: none;
    }
    .luxury-form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 0.9rem;
    }
</style>

<?php include 'includes/footer.php'; ?>
