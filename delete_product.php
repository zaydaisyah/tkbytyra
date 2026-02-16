<?php
// delete_product.php
require 'db.php';
require 'functions.php';
require 'auth.php';

if (!isAdmin()) {
    redirect('index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get product name for log
    $stmt = $pdo->prepare("SELECT name FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();
    $name = $product ? $product['name'] : "ID $id";

    // Delete
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    if ($stmt->execute([$id])) {
        logAction($pdo, 'Delete Product', "Deleted product: $name");
    }
}

redirect('inventory.php');
?>
