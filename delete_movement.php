<?php
// delete_movement.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isAdmin()) {
    redirect('stock_movement.php');
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM stock_movements WHERE id = ?");
    if ($stmt->execute([$id])) {
        logAction($pdo, "Deleted Stock Movement", "Movement ID: $id");
    }
}

redirect('stock_movement.php');
?>
