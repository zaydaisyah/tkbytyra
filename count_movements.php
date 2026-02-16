<?php
require 'db.php';
$stmt = $pdo->query("SELECT COUNT(*) FROM stock_movements");
echo $stmt->fetchColumn() . " records found.\n";
?>
