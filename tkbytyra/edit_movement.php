<?php
// edit_movement.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isAdmin()) {
    redirect('stock_movement.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT m.*, p.name as product_name FROM stock_movements m JOIN products p ON m.product_id = p.id WHERE m.id = ?");
$stmt->execute([$id]);
$movement = $stmt->fetch();

if (!$movement) {
    redirect('stock_movement.php');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = (int)$_POST['quantity'];
    $type = $_POST['type'];
    $reason = sanitize($_POST['reason']);
    $created_at = $_POST['created_at'];

    if ($quantity <= 0) {
        $error = "Quantity must be greater than zero.";
    } else {
        $stmt = $pdo->prepare("UPDATE stock_movements SET quantity = ?, type = ?, reason = ?, created_at = ? WHERE id = ?");
        if ($stmt->execute([$quantity, $type, $reason, $created_at, $id])) {
            logAction($pdo, "Edited Stock Movement", "Movement ID: $id for Product: {$movement['product_name']}");
            $success = "Stock movement updated successfully. Please note: This does NOT automatically change the current product quantity. Use this to correct historical historical movement data for the graphs.";
            // Refresh movement data
            $stmt = $pdo->prepare("SELECT m.*, p.name as product_name FROM stock_movements m JOIN products p ON m.product_id = p.id WHERE m.id = ?");
            $stmt->execute([$id]);
            $movement = $stmt->fetch();
        } else {
            $error = "Failed to update movement.";
        }
    }
}

$page_title = "Edit Stock Movement";
include 'includes/header.php';
?>

<div class="glass-card animate-fade-in" style="max-width: 600px; margin: 2rem auto;">
    <h2 style="margin-bottom: 2rem; color: var(--primary-color);">Edit Historical Movement</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Product</label>
            <input type="text" value="<?php echo htmlspecialchars($movement['product_name']); ?>" disabled style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd; background: #f9f9f9;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Movement Type</label>
            <select name="type" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                <option value="in" <?php echo $movement['type'] == 'in' ? 'selected' : ''; ?>>Stock IN</option>
                <option value="out" <?php echo $movement['type'] == 'out' ? 'selected' : ''; ?>>Stock OUT</option>
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Quantity</label>
            <input type="number" name="quantity" value="<?php echo $movement['quantity']; ?>" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date/Time</label>
            <input type="datetime-local" name="created_at" value="<?php echo date('Y-m-d\TH:i', strtotime($movement['created_at'])); ?>" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
            <small style="color: #666; display: block; margin-top: 5px;">Change this to adjust which month the movement appears in the graph.</small>
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Reason</label>
            <textarea name="reason" rows="3" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ddd;"><?php echo htmlspecialchars($movement['reason']); ?></textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary" style="flex: 1; padding: 12px; border-radius: 8px; background: #B08968; border: none; color: white; cursor: pointer; font-weight: 600;">Save Changes</button>
            <a href="stock_movement.php" class="btn btn-outline-secondary" style="flex: 1; padding: 12px; border-radius: 8px; background: white; border: 1px solid #ddd; color: #555; text-align: center; font-weight: 600;">Cancel</a>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
