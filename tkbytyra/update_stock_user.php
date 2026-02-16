<?php
require 'db.php';

$updates = [
    5 => 3,  // Pillow Cheeks Blusher - Cottontail -> Low Stock
    15 => 5, // TK By TYRA Pillow Cheeks - Cottontail -> Low Stock
    6 => 0,  // TK By TYRA Fluff & Flutter Mascara -> Out of Stock
    25 => 0, // TK By TYRA Fluff & Flutter – Super Waterproof Mascara -> Out of Stock
    26 => 0  // TK By TYRA Fluff & Flutter – Easy to Remove Mascara -> Out of Stock
];

try {
    $stmt = $pdo->prepare("UPDATE products SET quantity = ? WHERE id = ?");
    foreach ($updates as $id => $qty) {
        $stmt->execute([$qty, $id]);
        echo "Updated product ID $id to Qty $qty\n";
    }
    echo "User-requested stock simulation update complete.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
