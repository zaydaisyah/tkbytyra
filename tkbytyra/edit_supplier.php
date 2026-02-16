<?php
session_start();
require_once 'db.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$error = '';
$success = '';

// Fetch current data
$stmt = $pdo->prepare("SELECT * FROM suppliers WHERE id = ?");
$stmt->execute([$id]);
$supplier = $stmt->fetch();

if (!$supplier) {
    header("Location: suppliers.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact_person']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    if (empty($name)) {
        $error = "Supplier name is required.";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE suppliers SET name = ?, contact_person = ?, email = ?, phone = ?, address = ? WHERE id = ?");
            $stmt->execute([$name, $contact, $email, $phone, $address, $id]);
            
            // Log Action
            $log_stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)");
            $log_stmt->execute([$_SESSION['user_id'], 'Edit Supplier', "Updated supplier: $name (ID: $id)"]);
            
            $success = "Supplier updated successfully!";
            header("refresh:2;url=suppliers.php");
        } catch (PDOException $e) {
            $error = "Error updating supplier: " . $e->getMessage();
        }
    }
}

$page_title = "Edit Supplier: " . $supplier['name'];
include 'includes/header.php';
?>

<div class="animate-fade-in">
    <div class="dashboard-header" style="margin-bottom: 2rem;">
        <div class="header-titles">
            <h1>Edit Supplier</h1>
            <p>Update details for <?php echo htmlspecialchars($supplier['name']); ?></p>
        </div>
        <a href="suppliers.php" class="btn" style="background: rgba(0,0,0,0.05);">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="glass-card" style="max-width: 800px; margin: 0 auto;">
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="POST" class="luxury-form">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Supplier Name *</label>
                    <input type="text" name="name" class="form-control" required value="<?php echo htmlspecialchars($supplier['name']); ?>">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="<?php echo htmlspecialchars($supplier['contact_person'] ?? ''); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($supplier['email'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($supplier['phone'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Office Address</label>
                <textarea name="address" class="form-control" rows="3"><?php echo htmlspecialchars($supplier['address'] ?? ''); ?></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="button" onclick="window.location='suppliers.php'" class="btn" style="background: rgba(0,0,0,0.05);">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
