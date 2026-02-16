<?php
require 'db.php';

echo "--- Database Status Check ---\n";

// Check users table
$stmt = $pdo->query("SHOW COLUMNS FROM users LIKE 'full_name'");
$fullname_exists = $stmt->fetch();
echo "users.full_name: " . ($fullname_exists ? "EXISTS" : "MISSING") . "\n";

// Check categories
$stmt = $pdo->query("SELECT name FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo "Categories: " . implode(", ", $categories) . "\n";

// Check suppliers
$stmt = $pdo->query("SELECT COUNT(*) FROM suppliers");
$supplier_count = $stmt->fetchColumn();
echo "Suppliers count: $supplier_count\n";

// Check product-supplier links
$stmt = $pdo->query("SELECT COUNT(*) FROM products WHERE supplier_id IS NOT NULL");
$linked_products = $stmt->fetchColumn();
echo "Products linked to suppliers: $linked_products\n";

echo "--- Check Complete ---\n";
?>
