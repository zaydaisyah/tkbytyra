<?php
require 'db.php';

try {
    // Users Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        full_name VARCHAR(100) DEFAULT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'staff', 'manager') NOT NULL DEFAULT 'staff',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Categories Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        description TEXT
    )");

    // Suppliers Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS suppliers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        contact_person VARCHAR(100),
        phone VARCHAR(20),
        email VARCHAR(100),
        address TEXT
    )");

    // Products Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_code VARCHAR(50) UNIQUE,
        name VARCHAR(150) NOT NULL,
        category_id INT,
        supplier_id INT,
        description TEXT,
        cost_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        selling_price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        quantity INT NOT NULL DEFAULT 0,
        min_stock_level INT NOT NULL DEFAULT 5,
        image_path VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
        FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL
    )");

    // Stock Movements Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS stock_movements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        user_id INT,
        type ENUM('in', 'out') NOT NULL,
        quantity INT NOT NULL,
        reason VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )");

    // Audit Log Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS audit_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        action VARCHAR(50) NOT NULL,
        details TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )");

    // Deliveries Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS deliveries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT,
        quantity INT NOT NULL DEFAULT 1,
        customer_name VARCHAR(150) NOT NULL,
        customer_email VARCHAR(150),
        customer_address TEXT NOT NULL,
        tracking_number VARCHAR(100),
        courier_name VARCHAR(100),
        status VARCHAR(50) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
    )");

    // 8. Customers Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS customers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(150) NOT NULL,
        email VARCHAR(150),
        phone VARCHAR(20),
        address TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 9. Orders Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT,
        user_id INT,
        total_amount DECIMAL(10,2) DEFAULT 0.00,
        status ENUM('Pending', 'Paid', 'Shipped', 'Cancelled') DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE SET NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    )");

    // 10. Order Items Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )");

    // Seed Users
    $password = password_hash('password', PASSWORD_DEFAULT);
    $admin_password = password_hash('tkbytyra019#', PASSWORD_DEFAULT);
    $batch_password = password_hash('tkbytyra2026#', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute(['tkadmin', $admin_password, 'admin']);
    $stmt->execute(['staff', $password, 'staff']);
    $stmt->execute(['manager', $password, 'manager']);
    $stmt->execute(['assistant_manager', $batch_password, 'manager']);

    // Batch create admin1 - admin18
    for ($i = 1; $i <= 18; $i++) {
        $stmt->execute(['admin' . $i, $batch_password, 'admin']);
    }

    // Seed Categories
    $stmt = $pdo->prepare("INSERT IGNORE INTO categories (name) VALUES (?)");
    $categories = ['Face', 'Lips', 'Eyes', 'Cheeks', 'Skincare', 'Treatments', 'Tools', 'Accessories'];
    foreach ($categories as $cat) {
        $stmt->execute([$cat]);
    }

    // Seed 20 Suppliers
    $stmt = $pdo->prepare("INSERT IGNORE INTO suppliers (name, contact_person, email) VALUES (?, ?, ?)");
    for ($i = 1; $i <= 20; $i++) {
        $stmt->execute(["Supplier $i corp", "Contact Person $i", "supplier$i@example.com"]);
    }

    // Seed 30 Audit Logs
    $stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)");
    for ($i = 1; $i <= 30; $i++) {
        $stmt->execute([1, "System Action $i", "Automated system log entry for testing #$i"]);
    }

    // Seed 50 Deliveries
    $stmt = $pdo->prepare("INSERT INTO deliveries (product_id, quantity, customer_name, customer_email, customer_address, tracking_number, courier_name, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
    $couriers = ['J&T Express', 'PosLaju', 'NinjaVan', 'DHL', 'Lalamove'];
    for ($i = 1; $i <= 50; $i++) {
        $prod_id = ($i % 26) + 1; // Round robin through 26 products
        $stmt->execute([
            $prod_id,
            rand(1, 5),
            "Customer Name $i",
            "customer$i@mail.com",
            "Address detail for customer $i, Malaysia",
            "TK-TRACK-" . (1000 + $i),
            $couriers[rand(0, 4)],
            $statuses[rand(0, 4)]
        ]);
    }

    echo "Database setup completed successfully.<br>";
    echo "Seed data counts: 20 Suppliers, 30 Audit Logs, 50 Deliveries created.";

} catch (PDOException $e) {
    die("Setup failed: " . $e->getMessage());
}
?>
