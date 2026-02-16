<?php
require 'db.php';

$lip_products = [
    [
        'name' => 'TK By TYRA Lip Paint - Tyara',
        'code' => 'LP-TYAR-01',
        'category_id' => 2,
        'cost' => 25.00,
        'price' => 45.00,
        'stock' => 50,
        'image' => 'img/products/fluttershy.png'
    ],
    [
        'name' => 'TK By TYRA Kiss & Tell - Pinky Swear',
        'code' => 'KT-PINK-01',
        'category_id' => 2,
        'cost' => 22.00,
        'price' => 39.00,
        'stock' => 45,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Kiss & Tell - Flirty Fling',
        'code' => 'KT-FLIR-01',
        'category_id' => 2,
        'cost' => 22.00,
        'price' => 39.00,
        'stock' => 45,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Kiss & Tell - Barely There',
        'code' => 'KT-BARE-01',
        'category_id' => 2,
        'cost' => 22.00,
        'price' => 39.00,
        'stock' => 45,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Kiss & Tell - Sweet Talk',
        'code' => 'KT-SWEE-01',
        'category_id' => 2,
        'cost' => 22.00,
        'price' => 39.00,
        'stock' => 45,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Kiss & Tell - Tempting Toast',
        'code' => 'KT-TEMP-01',
        'category_id' => 2,
        'cost' => 22.00,
        'price' => 39.00,
        'stock' => 45,
        'image' => 'img/products/mariposa.png'
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO products (name, product_code, category_id, cost_price, selling_price, quantity, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($lip_products as $p) {
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
    echo "Total $count lip products added.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
