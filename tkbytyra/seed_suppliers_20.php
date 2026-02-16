<?php
require 'db.php';

$suppliers = [
    ['name' => 'Velvet Gloss Co.', 'contact' => 'Sarah Johnson', 'email' => 'sales@velvetgloss.com', 'phone' => '+60 12-345-6789', 'address' => 'Lot 10, Bukit Bintang, KL'],
    ['name' => 'Bloom Blush Manufacturing', 'contact' => 'Michael Chen', 'email' => 'contact@bloomblush.my', 'phone' => '+60 3-8888-9999', 'address' => 'Seksyen 13, Petaling Jaya'],
    ['name' => 'Lash Lab Experts', 'contact' => 'Jessica Wong', 'email' => 'info@lashlab.com', 'phone' => '+60 17-222-3344', 'address' => 'Puchong Gateway, Selangor'],
    ['name' => 'Chisel & Glow Supplies', 'contact' => 'David Miller', 'email' => 'orders@chiselglow.id', 'phone' => '+62 21-555-0123', 'address' => 'Jakarta Selatan, Indonesia'],
    ['name' => 'Essence Mist Distro', 'contact' => 'Ahmad Faisal', 'email' => 'hello@essencemist.com', 'phone' => '+60 19-444-5566', 'address' => 'Georgetown, Penang'],
    ['name' => 'Rose Quartz Radiance', 'contact' => 'Isabel Low', 'email' => 'glow@rosequartz.com', 'phone' => '+60 11-2345-6789', 'address' => 'Bangsar South, KL'],
    ['name' => 'Satin Skin Solutions', 'contact' => 'Dr. Aris Ramli', 'email' => 'derm@satinskin.com', 'phone' => '+60 3-7777-6666', 'address' => 'Solaris Dutamas, KL'],
    ['name' => 'Aura Artisans', 'contact' => 'Siti Nurul', 'email' => 'create@aura.my', 'phone' => '+60 14-555-6677', 'address' => 'Cyberjaya, Selangor'],
    ['name' => 'Majestic Mineral Lab', 'contact' => 'Robert Tan', 'email' => 'purity@majestic.com', 'phone' => '+60 12-888-9900', 'address' => 'Ipoh, Perak'],
    ['name' => 'Silk & Saffron Artisans', 'contact' => 'Zainab Hamid', 'email' => 'heritage@silksaffron.com', 'phone' => '+60 13-999-0011', 'address' => 'Kota Bharu, Kelantan'],
    ['name' => 'Lumiere Cosmetic Labs', 'contact' => 'Claire Dupont', 'email' => 'labs@lumiere.fr', 'phone' => '+33 1 45 67 89 10', 'address' => 'Paris, France'],
    ['name' => 'Elysian Beauty Lab', 'contact' => 'Elena Ross', 'email' => 'lab@elysian.com', 'phone' => '+44 20 7946 0001', 'address' => 'London, UK'],
    ['name' => 'Opulence Pigments', 'contact' => 'Marcus Gold', 'email' => 'color@opulence.com', 'phone' => '+60 16-111-2222', 'address' => 'Mont Kiara, KL'],
    ['name' => 'Azure Bloom Organics', 'contact' => 'Fiona Green', 'email' => 'nature@azurebloom.com', 'phone' => '+61 2 9876 5432', 'address' => 'Sydney, Australia'],
    ['name' => 'Velvet Petal Distro', 'contact' => 'Heng Poh Wah', 'email' => 'supply@velvetpetal.my', 'phone' => '+60 4-333-4444', 'address' => 'Bayan Lepas, Penang'],
    ['name' => 'Gilded Glow Importers', 'contact' => 'Samir Khan', 'email' => 'luxury@gildedglow.com', 'phone' => '+971 4 123 4567', 'address' => 'Dubai, UAE'],
    ['name' => 'Nordic Nectar Labs', 'contact' => 'Astrid Jensen', 'email' => 'pure@nordicnectar.se', 'phone' => '+46 8 123 45 67', 'address' => 'Stockholm, Sweden'],
    ['name' => 'Zenith Zen Beauty', 'contact' => 'Yuki Tanaka', 'email' => 'balance@zenith.jp', 'phone' => '+81 3-3456-7890', 'address' => 'Tokyo, Japan'],
    ['name' => 'Pearl & Peony Artisans', 'contact' => 'Li Wei', 'email' => 'art@pearlpeony.cn', 'phone' => '+86 21 6543 2109', 'address' => 'Shanghai, China'],
    ['name' => 'Divine Dew Drops', 'contact' => 'Grace Lee', 'email' => 'hydrate@divinedew.com', 'phone' => '+65 6789 0123', 'address' => 'Orchard Road, Singapore']
];

try {
    // Optional: Truncate the table if you want exactly 20, 
    // but better to just insert if not exists to avoid breaking existing product links.
    // For this task, we will just add them.
    
    $stmt = $pdo->prepare("INSERT INTO suppliers (name, contact_person, email, phone, address) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($suppliers as $s) {
        // Check if exists
        $check = $pdo->prepare("SELECT id FROM suppliers WHERE name = ?");
        $check->execute([$s['name']]);
        if (!$check->fetch()) {
            $stmt->execute([$s['name'], $s['contact'], $s['email'], $s['phone'], $s['address']]);
            echo "Added supplier: " . $s['name'] . "\n";
        } else {
            echo "Skipped existing: " . $s['name'] . "\n";
        }
    }
    
    echo "Total Suppliers now: " . $pdo->query("SELECT COUNT(*) FROM suppliers")->fetchColumn() . "\n";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>
