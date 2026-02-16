<?php
require 'db.php';

$updates = [
    1 => 0, // Out of Stock
    2 => 5, // Low Stock
    3 => 8, // Low Stock
    4 => 0  // Out of Stock
];

try {
    $stmt = $pdo->prepare("UPDATE products SET quantity = ? WHERE id = ?");
    foreach ($updates as $id => $qty) {
        $stmt->execute([$qty, $id]);
        echo "Updated product ID $id to Qty $qty\n";
    }
    echo "Stock simulation update complete.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
