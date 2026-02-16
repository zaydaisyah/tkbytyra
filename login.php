<?php
// login.php
require 'db.php';
require 'functions.php';
session_start();

if (isLoggedIn()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        
        logAction($pdo, 'Login', "User logged in: $username");
        redirect('index.php');
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tkbytyra Inventory</title>
    <!-- Custom Luxury Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            /* Override global body to ensure centering if needed, but style.css body is fine. 
               However, login page usually needs full height centering. 
            */
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            background: radial-gradient(circle at center, #FFF5EB, #FDF6F6); /* Slightly different for login focus */
        }
        .login-container { 
            width: 100%; 
            max-width: 420px; 
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="login-container animate-fade-in">
    <div class="glass-card" style="text-align: center;">
        <div class="brand" style="justify-content: center; margin-bottom: 2rem;">
             <img src="img/tklogo.png" alt="Logo" style="height: 40px; margin-right: 12px;"> <span>Tkbytyra</span>
        </div>
        <h5 style="margin-bottom: 2rem; color: var(--text-light); font-weight: 400;">Inventory System Login</h5>
        
        <?php if ($error): ?>
            <div style="background: #ffe6e6; color: #cc0000; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" style="text-align: left;">
            <div style="margin-bottom: 1.5rem;">
                <label style="font-weight: 600; color: var(--text-main);">Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div style="margin-bottom: 2rem;">
                <label style="font-weight: 600; color: var(--text-main);">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 1rem;">Login</button>
        </form>
        

    </div>
</div>

</body>
</html>
