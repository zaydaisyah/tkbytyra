<?php
require 'db.php';

$suppliers = [
    ['name' => 'Velvet Gloss Co.', 'contact' => 'Sarah Johnson', 'email' => 'sales@velvetgloss.com', 'specialty' => 'Lips'],
    ['name' => 'Bloom Blush Manufacturing', 'contact' => 'Michael Chen', 'email' => 'contact@bloomblush.my', 'specialty' => 'Blusher'],
    ['name' => 'Lash Lab Experts', 'contact' => 'Jessica Wong', 'email' => 'info@lashlab.com', 'specialty' => 'Mascara'],
    ['name' => 'Chisel & Glow Supplies', 'contact' => 'David Miller', 'email' => 'orders@chiselglow.id', 'specialty' => 'Contour'],
    ['name' => 'Essence Mist Distro', 'contact' => 'Ahmad Faisal', 'email' => 'hello@essencemist.com', 'specialty' => 'Mist']
];

try {
    $stmt = $pdo->prepare("INSERT INTO suppliers (name, contact_person, email, created_at) VALUES (?, ?, ?, NOW())");
    foreach ($suppliers as $s) {
        $stmt->execute([$s['name'], $s['contact'], $s['email']]);
        echo "Seeded supplier: " . $s['name'] . "\n";
    }

    // Link products to suppliers based on category specialty
    // 1: Contour, 2: Lips, 3: Mascara, 4: Blusher, 5: Mist
    $mapping = [
        1 => 'Chisel & Glow Supplies',
        2 => 'Velvet Gloss Co.',
        3 => 'Lash Lab Experts',
        4 => 'Bloom Blush Manufacturing',
        5 => 'Essence Mist Distro'
    ];

    foreach ($mapping as $cat_id => $sup_name) {
        $sup_id = $pdo->query("SELECT id FROM suppliers WHERE name = '$sup_name'")->fetchColumn();
        if ($sup_id) {
            $pdo->query("UPDATE products SET supplier_id = $sup_id WHERE category_id = $cat_id");
            echo "Linked Category $cat_id products to $sup_name\n";
        }
    }

    echo "Supplier seeding and product linking complete.\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
