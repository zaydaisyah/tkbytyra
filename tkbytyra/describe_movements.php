<?php
require 'db.php';
$stmt = $pdo->query("DESCRIBE stock_movements");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . ' (' . $row['Type'] . ")\n";
}
?>
