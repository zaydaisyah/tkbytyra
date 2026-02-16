<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$page_title = "Record New Delivery";
$success = "";
$error = "";

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
        $stmt = $pdo->prepare("INSERT INTO deliveries (product_id, quantity, customer_name, customer_email, customer_address, tracking_number, courier_name, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$product_id, $quantity, $customer_name, $customer_email, $customer_address, $tracking_number, $courier_name, $status]);
        
        // Log to audit
        $audit_stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, 'Add Delivery', ?)");
        $audit_stmt->execute([$_SESSION['user_id'], "Added delivery for customer: $customer_name (Qty: $quantity)"]);
        
        $success = "Delivery recorded successfully!";
    } catch (PDOException $e) {
        $error = "Failed to save delivery: " . $e->getMessage();
    }
}

include 'includes/header.php';
?>

<div class="dashboard-header animate-fade-in">
    <div class="header-titles">
        <h1>Record Delivery</h1>
        <p>Enter shipment details and customer information</p>
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
                        <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?> (<?php echo htmlspecialchars($p['product_code']); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity *</label>
                <input type="number" id="quantity" name="quantity" required min="1" value="1">
            </div>

            <div class="form-group full-width">
                <label for="customer_name">Customer Name *</label>
                <input type="text" id="customer_name" name="customer_name" required placeholder="Full name of the customer">
            </div>
            
            <div class="form-group">
                <label for="customer_email">Customer Email</label>
                <input type="email" id="customer_email" name="customer_email" placeholder="email@example.com">
            </div>

            <div class="form-group">
                <label for="status">Delivery Status</label>
                <select id="status" name="status">
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label for="customer_address">Shipping Address *</label>
                <textarea id="customer_address" name="customer_address" required rows="3" placeholder="Full delivery address"></textarea>
            </div>

            <div class="form-group">
                <label for="courier_name">Courier Name</label>
                <input type="text" id="courier_name" name="courier_name" placeholder="e.g. J&T, PosLaju, NinjaVan">
            </div>

            <div class="form-group">
                <label for="tracking_number">Tracking Number</label>
                <input type="text" id="tracking_number" name="tracking_number" placeholder="e.g. TK-MY-XXXXX">
            </div>
        </div>

        <div class="form-footer" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-save"></i> Save Delivery Details
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
