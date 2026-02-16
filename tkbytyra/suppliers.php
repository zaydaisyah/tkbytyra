<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch suppliers with a count of products they provide
$query = "SELECT s.*, COUNT(p.id) as product_count 
          FROM suppliers s 
          LEFT JOIN products p ON s.id = p.supplier_id 
          GROUP BY s.id 
          ORDER BY s.name ASC";
$stmt = $pdo->query($query);
$suppliers = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers - TKBYTYRA</title>
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
                    <h1>Suppliers</h1>
                    <p>Manage your luxury brand partners and vendors</p>
                </div>
                <div class="header-actions">
                    <a href="add_supplier.php" class="btn btn-primary">
                        <i class="fa-solid fa-plus"></i> Add Supplier
                    </a>
                </div>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success animate-fade-in"><?php echo htmlspecialchars($_GET['success']); ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger animate-fade-in"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <div class="glass-card">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Email/Phone</th>
                                <th>Address</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($suppliers as $s): ?>
                            <tr>
                                <td class="supplier-name-cell">
                                    <div class="supplier-icon">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    <span><?php echo htmlspecialchars($s['name']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($s['contact_person'] ?? 'N/A'); ?></td>
                                <td>
                                    <div class="email-cell">
                                        <i class="fa-regular fa-envelope"></i>
                                        <a href="mailto:<?php echo htmlspecialchars($s['email'] ?? ''); ?>" style="color: inherit; text-decoration: none;">
                                            <?php echo htmlspecialchars($s['email'] ?? 'N/A'); ?>
                                        </a>
                                    </div>
                                    <div class="email-cell" style="font-size: 0.8rem; margin-top: 4px;">
                                        <i class="fa-solid fa-phone"></i>
                                        <?php echo htmlspecialchars($s['phone'] ?? 'N/A'); ?>
                                    </div>
                                </td>
                                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo htmlspecialchars($s['address'] ?? ''); ?>">
                                    <?php echo htmlspecialchars($s['address'] ?? 'N/A'); ?>
                                </td>
                                <td>
                                    <span class="count-badge">
                                        <?php echo $s['product_count']; ?> Items
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit_supplier.php?id=<?php echo $s['id']; ?>" class="btn-icon" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                        <a href="delete_supplier.php?id=<?php echo $s['id']; ?>" class="btn-icon btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this luxury partner? This action cannot be undone.');"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (empty($suppliers)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No suppliers found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <style>
        .supplier-name-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 500;
        }
        .supplier-icon {
            width: 32px;
            height: 32px;
            background: rgba(176, 137, 104, 0.1);
            color: var(--primary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }
        .email-cell {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        .count-badge {
            background: rgba(176, 137, 104, 0.05);
            padding: 0.3rem 0.7rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--primary-color);
            border: 1px solid rgba(176, 137, 104, 0.1);
        }
        .status-badge {
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-active {
            background: rgba(45, 138, 108, 0.1);
            color: #2d8a6c;
        }
    </style>
</body>
</html>
