<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tkbytyra Inventory</title>
    <!-- Custom Luxury Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Export Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        /* Add some basic Bootstrap grid classes support if style.css doesn't have grid system, 
           or use inline styles for the moment if we want to stick to the exact HTML.
           However, the PHP logic uses some bootstrap classes (like alert-danger).
           We might want to keep Bootstrap included BUT allow custom CSS to override.
           Or better, convert PHP logic to use custom classes.
           For now, let's include specific Bootstrap components if needed, or just rely on custom CSS.
           The HTML provided didn't use Bootstrap. Let's try to stick to the HTML's CSS.
        */
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 8px; }
        .alert-danger { background: #ffe6e6; color: #cc0000; border: 1px solid #ffcccc; }
        .alert-success { background: #e6ffe6; color: #006600; border: 1px solid #ccffcc; }
        .alert-warning { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="brand">
                <img src="img/tklogo.png" alt="Logo" style="height: 32px; margin-right: 10px;">
                <span>Tkbytyra</span>
            </div>
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="inventory.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'inventory.php') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-list"></i> Product Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a href="suppliers.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'suppliers.php') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-handshake"></i> Suppliers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="stock_manage.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'stock_manage.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-boxes-stacked"></i> Stock Management
                    </a>
                </li>
                <li class="nav-item">
                    <a href="low_stock.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'low_stock.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-triangle-exclamation"></i> Low Stock
                    </a>
                </li>
                <li class="nav-item">
                    <a href="deliveries.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'deliveries.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-truck"></i> Delivery
                    </a>
                </li>
                <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'manager')): ?>
                <li class="nav-item">
                    <a href="reports.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'reports.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-file-invoice"></i> Reports
                    </a>
                </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a href="users.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-users-gear"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="audit.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'audit.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-clock-rotate-left"></i> Audit Log
                    </a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                        <i class="fa-solid fa-user-circle"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                         <i class="fa-solid fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <header class="top-bar glass-panel animate-fade-in">
                <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Tkbytyra Inventory'; ?></h1>
                <a href="profile.php" class="user-profile">
                    <span><?php echo isset($_SESSION['full_name']) ? htmlspecialchars($_SESSION['full_name']) : (isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User'); ?></span>
                    <div class="user-avatar"><?php echo isset($_SESSION['username']) ? strtoupper(substr($_SESSION['username'], 0, 2)) : 'US'; ?></div>
                </a>
            </header>

