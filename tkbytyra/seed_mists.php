<?php
require 'db.php';

$mist_products = [
    [
        'name' => 'TKBYTYRA Head Over Heels Mist – Classic',
        'code' => 'MT-HOH-CLAS',
        'category_id' => 5,
        'cost' => 18.00,
        'price' => 35.00,
        'stock' => 80,
        'image' => 'img/products/fluttershy.png'
    ],
    [
        'name' => 'TKBYTYRA Head Over Heels Mist (Beautyra Kuih Raya)',
        'code' => 'MT-HOH-KUIH',
        'category_id' => 5,
        'cost' => 20.00,
        'price' => 38.00,
        'stock' => 60,
        'image' => 'img/products/fluttershy.png'
    ],
    [
        'name' => 'TKBYTYRA Head Over Heels Perfume Mist (Melon/Peach/Vanilla)',
        'code' => 'MT-HOH-PERF',
        'category_id' => 5,
        'cost' => 20.00,
        'price' => 38.00,
        'stock' => 50,
        'image' => 'img/products/fluttershy.png'
    ],
    [
        'name' => 'TKBYTYRA Head Over Heels Mist (TK Angels)',
        'code' => 'MT-HOH-ANGE',
        'category_id' => 5,
        'cost' => 18.00,
        'price' => 35.00,
        'stock' => 40,
        'image' => 'img/products/fluttershy.png'
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO products (name, product_code, category_id, cost_price, selling_price, quantity, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($mist_products as $p) {
        $check = $pdo->prepare("SELECT id FROM products WHERE product_code = ?");
        $check->execute([$p['code']]);
        if ($check->rowCount() == 0) {
            $stmt->execute([
                $p['name'],
                $p['code'],
                $p['category_id'],
                $p['cost'],
                $p['price'],
                $p['stock'],
                $p['image']
            ]);
            $count++;
            echo "Added: " . $p['name'] . "\n";
        } else {
            echo "Skipped: " . $p['name'] . " (Already exists)\n";
        }
    }
    echo "Total $count mist products added.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
