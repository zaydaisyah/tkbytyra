<?php
require 'db.php';

try {
    $new_password = password_hash('tkbytyra019#', PASSWORD_DEFAULT);
    $new_username = 'tkadmin';
    
    // Check if 'admin' exists and update it, otherwise insert new
    $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE username = 'admin'");
    $stmt->execute([$new_username, $new_password]);
    
    if ($stmt->rowCount() == 0) {
        // If no 'admin' user existed to update, let's try to insert 'tkadmin' if it doesn't exist
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$new_username]);
        if (!$stmt->fetch()) {
             $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
             $stmt->execute([$new_username, $new_password]);
             echo "Created new admin user 'tkadmin'.";
        } else {
             echo "Admin user 'tkadmin' already exists (or verified).";
        }
    } else {
        echo "Updated existing 'admin' user to 'tkadmin' with new password.";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
