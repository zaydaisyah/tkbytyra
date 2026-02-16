<?php
require 'db.php';

$updates = [
    1 => 'Contour',
    2 => 'Lips',
    3 => 'Mascara',
    4 => 'Blusher',
    5 => 'Mist'
];

try {
    $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
    foreach ($updates as $id => $name) {
        $stmt->execute([$name, $id]);
        echo "Updated category $id to $name\n";
    }
    echo "Category renaming complete.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
