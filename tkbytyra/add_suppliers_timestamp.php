<?php
require 'db.php';

try {
    // Check if column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM suppliers LIKE 'created_at'");
    $exists = $stmt->fetch();

    if (!$exists) {
        $pdo->exec("ALTER TABLE suppliers ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        echo "Added created_at column to suppliers table.\n";
    } else {
        echo "Column created_at already exists in suppliers table.\n";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
