<?php
require 'db.php';
$stmt = $pdo->query('SELECT * FROM categories');
while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . "\n";
}
?>
