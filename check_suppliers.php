<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM suppliers");
while ($row = $stmt->fetch()) {
    echo $row['id'] . ': ' . $row['name'] . "\n";
}
?>
