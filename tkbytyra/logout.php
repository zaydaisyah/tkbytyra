<?php
// logout.php
require 'db.php';
require 'functions.php';
session_start();

// Log the action before destroying session if username exists
if (isset($_SESSION['username'])) {
    logAction($pdo, 'Logout', "User logged out: " . $_SESSION['username']);
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Tkbytyra Inventory</title>
    <!-- Use the custom CSS for the luxury theme -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background: linear-gradient(135deg, #FDF6F6 0%, #FFF5EB 100%); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
        }
        .logout-container { 
            width: 100%; 
            max-width: 400px; 
            padding: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="logout-container animate-fade-in">
    <div class="glass-card" style="text-align: center; padding: 3rem 2rem;">
        <div style="margin-bottom: 1.5rem;">
            <img src="img/tklogo.png" alt="Logo" style="height: 60px;">
        </div>
        <div style="font-size: 3rem; color: var(--primary-color); margin-bottom: 1rem;">
             <i class="fa-solid fa-circle-check"></i>
        </div>
        
        <h3 style="margin-bottom: 1rem; color: var(--text-main);">Logged Out</h3>
        
        <p style="color: var(--text-light); margin-bottom: 2rem;">
            You have successfully logged out of the system.
        </p>

        <a href="login.php" class="btn btn-primary" style="display: inline-block; padding: 12px 30px; font-size: 1rem; text-decoration: none;">
            Login Here
        </a>
    </div>
</div>

</body>
</html>
