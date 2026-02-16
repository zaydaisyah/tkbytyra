<?php
require 'db.php';

try {
    // Check if column exists
    $stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'full_name'");
    $exists = $stmt->fetch();

    if (!$exists) {
        // Add full_name column (Compatible with older MySQL)
        $pdo->exec("ALTER TABLE users ADD COLUMN full_name VARCHAR(100) AFTER username");
        echo "Added full_name column.<br>";
    } else {
        echo "Column full_name already exists.<br>";
    }
    
    // Set default full_name for existing users if empty
    $pdo->exec("UPDATE users SET full_name = 'TkAdmin' WHERE username = 'tkadmin' AND (full_name IS NULL OR full_name = '')");
    $pdo->exec("UPDATE users SET full_name = 'Staff Member' WHERE username = 'staff' AND (full_name IS NULL OR full_name = '')");
    $pdo->exec("UPDATE users SET full_name = 'Manager' WHERE username = 'manager' AND (full_name IS NULL OR full_name = '')");
    
    echo "Successfully updated defaults.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
