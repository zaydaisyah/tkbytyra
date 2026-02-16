<?php
require 'db.php';

// Get some product IDs and user IDs
$products = $pdo->query("SELECT id FROM products LIMIT 10")->fetchAll(PDO::FETCH_COLUMN);
$users = $pdo->query("SELECT id FROM users LIMIT 5")->fetchAll(PDO::FETCH_COLUMN);

if (empty($products) || empty($users)) {
    die("Error: No products or users found to seed movements.");
}

$movements = [
    ['product_id' => $products[0], 'user_id' => $users[0], 'type' => 'in', 'quantity' => 100, 'reason' => 'Initial Stock', 'created_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
    ['product_id' => $products[1], 'user_id' => $users[0], 'type' => 'in', 'quantity' => 50, 'reason' => 'New Shipment', 'created_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
    ['product_id' => $products[0], 'user_id' => $users[1], 'type' => 'out', 'quantity' => 5, 'reason' => 'Customer Sale', 'created_at' => date('Y-m-d H:i:s', strtotime('-7 days'))],
    ['product_id' => $products[2], 'user_id' => $users[0], 'type' => 'in', 'quantity' => 30, 'reason' => 'Restocking', 'created_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
    ['product_id' => $products[4], 'user_id' => $users[2], 'type' => 'out', 'quantity' => 2, 'reason' => 'Damaged Item', 'created_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
    ['product_id' => $products[1], 'user_id' => $users[1], 'type' => 'out', 'quantity' => 10, 'reason' => 'Customer Sale', 'created_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
    ['product_id' => $products[5], 'user_id' => $users[0], 'type' => 'in', 'quantity' => 20, 'reason' => 'Vendor Delivery', 'created_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
    ['product_id' => $products[3], 'user_id' => $users[3], 'type' => 'out', 'quantity' => 1, 'reason' => 'Internal Use', 'created_at' => date('Y-m-d H:i:s', strtotime('-1 day'))],
];

try {
    $stmt = $pdo->prepare("INSERT INTO stock_movements (product_id, user_id, type, quantity, reason, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    foreach ($movements as $m) {
        $stmt->execute([$m['product_id'], $m['user_id'], $m['type'], $m['quantity'], $m['reason'], $m['created_at']]);
    }
    echo "Stock movements seeded successfully.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
