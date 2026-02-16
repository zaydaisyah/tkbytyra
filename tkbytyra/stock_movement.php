<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch stock movements with product and user info
$query = "SELECT m.*, p.name as product_name, u.username as admin_name 
          FROM stock_movements m 
          JOIN products p ON m.product_id = p.id 
          JOIN users u ON m.user_id = u.id 
          ORDER BY m.created_at DESC";
$stmt = $pdo->query($query);
$movements = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Movements - TKBYTYRA</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <?php include 'includes/header.php'; ?>
        
        <main class="main-content">
            <div class="dashboard-header">
                <div class="header-titles">
                    <h1>Stock In & Out</h1>
                    <p>Track all inventory movements and stock history</p>
                </div>
            </div>

            <div class="glass-card">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Reason</th>
                                <th>Admin</th>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($movements as $m): ?>
                            <tr>
                                <td class="date-cell">
                                    <i class="fa-regular fa-calendar-alt"></i>
                                    <?php echo date('M j, Y, g:i a', strtotime($m['created_at'])); ?>
                                </td>
                                <td>
                                    <div class="product-info-cell">
                                        <span class="product-name"><?php echo htmlspecialchars($m['product_name']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($m['type'] == 'in'): ?>
                                        <span class="status-badge status-active">
                                            <i class="fa-solid fa-arrow-trend-up"></i> Stock In
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge status-low">
                                            <i class="fa-solid fa-arrow-trend-down"></i> Stock Out
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="quantity-cell">
                                    <span class="<?php echo $m['type'] == 'in' ? 'text-success' : 'text-danger'; ?>">
                                        <?php echo ($m['type'] == 'in' ? '+' : '-') . $m['quantity']; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($m['reason']); ?></td>
                                <td>
                                    <div class="admin-cell">
                                        <i class="fa-solid fa-user-shield"></i>
                                        <?php echo htmlspecialchars($m['admin_name']); ?>
                                    </div>
                                </td>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                <td class="actions-cell">
                                    <a href="edit_movement.php?id=<?php echo $m['id']; ?>" class="btn-icon" title="Edit"><i class="fa-solid fa-pen-to-square" style="color: #B08968;"></i></a>
                                    <a href="#" onclick="deleteMovement(<?php echo $m['id']; ?>)" class="btn-icon" title="Delete"><i class="fa-solid fa-trash" style="color: #D00000;"></i></a>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($movements)): ?>
                            <tr>
                                <td colspan="<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? '7' : '6'; ?>" class="text-center">No stock movements found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <script>
            function deleteMovement(id) {
                if (confirm('Are you sure you want to delete this stock movement? This will NOT revert the product quantity automatically. You may need to manually adjust the product stock if this movement was an error.')) {
                    window.location.href = 'delete_movement.php?id=' + id;
                }
            }
            </script>
        </main>
    </div>

    <style>
        .product-info-cell {
            font-weight: 500;
            color: var(--text-dark);
        }
        .date-cell, .admin-cell {
            color: var(--text-light);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .quantity-cell {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .text-success { color: #2d8a6c; }
        .text-danger { color: #c0392b; }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-active {
            background: rgba(45, 138, 108, 0.1);
            color: #2d8a6c;
        }
        .status-low {
            background: rgba(192, 57, 43, 0.1);
            color: #c0392b;
        }
    </style>
</body>
</html>
