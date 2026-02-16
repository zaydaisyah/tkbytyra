<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Unauthorized access.");
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    try {
        // Check if there are products linked to this supplier
        $check = $pdo->prepare("SELECT COUNT(*) FROM products WHERE supplier_id = ?");
        $check->execute([$id]);
        $count = $check->fetchColumn();

        if ($count > 0) {
            header("Location: suppliers.php?error=Cannot delete supplier with linked products.");
            exit();
        }

        // Get Name for Log
        $stmt_name = $pdo->prepare("SELECT name FROM suppliers WHERE id = ?");
        $stmt_name->execute([$id]);
        $name = $stmt_name->fetchColumn();

        $stmt = $pdo->prepare("DELETE FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);

        // Log Action
        $log_stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)");
        $log_stmt->execute([$_SESSION['user_id'], 'Delete Supplier', "Deleted supplier: $name (ID: $id)"]);

        header("Location: suppliers.php?success=Supplier deleted successfully.");
    } catch (PDOException $e) {
        header("Location: suppliers.php?error=Error deleting supplier: " . $e->getMessage());
    }
} else {
    header("Location: suppliers.php");
}
?>
