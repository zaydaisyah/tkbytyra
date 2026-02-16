<?php
require 'db.php';

$blusher_products = [
    [
        'name' => 'TK By TYRA Pillow Cheeks - Cottontail',
        'code' => 'BL-PILL-COT',
        'category_id' => 4,
        'cost' => 30.00,
        'price' => 55.00,
        'stock' => 40,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Pillow Cheeks - Feline',
        'code' => 'BL-PILL-FEL',
        'category_id' => 4,
        'cost' => 30.00,
        'price' => 55.00,
        'stock' => 35,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA Pillow Cheeks - Mariposa',
        'code' => 'BL-PILL-MAR',
        'category_id' => 4,
        'cost' => 30.00,
        'price' => 55.00,
        'stock' => 35,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TKbyTyra Wedding Collection Blusher EMfiniTY TE',
        'code' => 'BL-WEDD-EMF',
        'category_id' => 4,
        'cost' => 35.00,
        'price' => 59.00,
        'stock' => 25,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA The Cheek Canvas: Rebirth',
        'code' => 'BL-CANV-REB',
        'category_id' => 4,
        'cost' => 38.00,
        'price' => 69.00,
        'stock' => 20,
        'image' => 'img/products/mariposa.png'
    ],
    [
        'name' => 'TK By TYRA The Cheek Canvas: Lucky',
        'code' => 'BL-CANV-LUC',
        'category_id' => 4,
        'cost' => 38.00,
        'price' => 69.00,
        'stock' => 20,
        'image' => 'img/products/mariposa.png'
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO products (name, product_code, category_id, cost_price, selling_price, quantity, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $count = 0;
    foreach ($blusher_products as $p) {
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
    echo "Total $count blusher products added.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
