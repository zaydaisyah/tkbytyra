<?php
require 'db.php';
$stmt = $pdo->query("SELECT id, name, quantity FROM products WHERE name LIKE '%Cottontail%' OR name LIKE '%Mascara%'");
while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . ' (Qty: ' . $row['quantity'] . ")\n";
}
?>
