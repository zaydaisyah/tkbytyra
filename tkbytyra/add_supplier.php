<?php
session_start();
require_once 'db.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

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
            $stmt = $pdo->prepare("INSERT INTO suppliers (name, contact_person, email, phone, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $contact, $email, $phone, $address]);
            
            // Log Action
            $log_stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)");
            $log_stmt->execute([$_SESSION['user_id'], 'Add Supplier', "Added supplier: $name"]);
            
            $success = "Supplier added successfully!";
            header("refresh:2;url=suppliers.php");
        } catch (PDOException $e) {
            $error = "Error adding supplier: " . $e->getMessage();
        }
    }
}

$page_title = "Add New Supplier";
include 'includes/header.php';
?>

<div class="animate-fade-in">
    <div class="dashboard-header" style="margin-bottom: 2rem;">
        <div class="header-titles">
            <h1>Add Supplier</h1>
            <p>Onboard a new luxury beauty partner</p>
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
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Elysian Beauty Lab">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" placeholder="e.g. Sarah Johnson">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="e.g. sales@elysian.com">
                </div>
                <div class="form-group">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Phone Number</label>
                    <input type="text" name="phone" class="form-control" placeholder="e.g. +60 12-345-6789">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Office Address</label>
                <textarea name="address" class="form-control" rows="3" placeholder="Enter physical address..."></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <button type="reset" class="btn" style="background: rgba(0,0,0,0.05);">Clear Form</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Save Supplier
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
