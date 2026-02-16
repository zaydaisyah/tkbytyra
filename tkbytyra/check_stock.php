<?php
require 'db.php';
$stmt = $pdo->query('SELECT id, name, quantity FROM products LIMIT 20');
while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . ' (Qty: ' . $row['quantity'] . ")\n";
}
?>
