<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'src/db.php';

echo "Checking 'services' table...\n";

// Check if table exists
try {
    $pdo->query("SELECT 1 FROM services LIMIT 1");
    echo "Table 'services' exists.\n";
} catch (PDOException $e) {
    echo "Table 'services' does not exist. Creating...\n";
    $sql = "CREATE TABLE services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table 'services' created.\n";
}

// Check if 'slug' column exists (for existing tables)
try {
    $pdo->query("SELECT slug FROM services LIMIT 1");
} catch (PDOException $e) {
    echo "Column 'slug' missing. Adding it...\n";
    $pdo->exec("ALTER TABLE services ADD COLUMN slug VARCHAR(255) UNIQUE NOT NULL");
    echo "Column 'slug' added.\n";
}

// Array of default services to seed
$defaults = [
    [
        'title' => 'Well Equipped Operation Theatre',
        'slug' => 'operation-theatre',
        'image' => 'images/OIP.jpeg',
        'description' => 'A well-equipped operation theatre (OT) is a crucial component of advanced medical facilities. It is designed to maintain a sterile environment and is outfitted with state-of-the-art medical equipment.'
    ],
    [
        'title' => 'Prenatal and Postnatal Care',
        'slug' => 'prenatal-postnatal-care',
        'image' => 'images/parent.jpeg',
        'description' => 'Prenatal and postnatal care encompasses the medical attention and support provided to women during and after pregnancy. Prenatal care focuses on regular checkups, monitoring the baby\'s growth.'
    ],
    [
        'title' => 'Pharmacy Services',
        'slug' => 'pharmacy-services',
        'image' => 'images/med.jpeg',
        'description' => 'Pharmacy services in our clinic typically include dispensing prescribed medications to patients, ensuring the availability of essential drugs, and providing guidance on proper medication usage.'
    ],
    [
        'title' => 'Modern Labs',
        'slug' => 'modern-labs',
        'image' => 'images/lab.jpeg',
        'description' => 'Modern laboratories in clinics are equipped with advanced diagnostic tools and technologies to ensure accurate and efficient test results. These labs typically include automated analyzers.'
    ],
    [
        'title' => 'ENT Surgeries',
        'slug' => 'ent-surgeries',
        'image' => 'images/ent.jpeg',
        'description' => 'ENT surgeries, or ear, nose, and throat surgeries, address a variety of conditions affecting these critical areas. Common procedures include tonsillectomies, sinus surgeries, and ear tube placements.'
    ],
    [
        'title' => '24 Hours Emergency',
        'slug' => 'emergency-services',
        'image' => 'images/emerg.jpeg',
        'description' => 'In a 24-hour emergency, swift action and clear communication are crucial for ensuring safety and efficiency. A dedicated team must assess the situation, prioritize tasks, and mobilize resources.'
    ]
];

// Check if table is empty
$stmt = $pdo->query("SELECT COUNT(*) FROM services");
$count = $stmt->fetchColumn();

if ($count == 0) {
    echo "Seeding default services...\n";
    $stmt = $pdo->prepare("INSERT INTO services (title, slug, image, description) VALUES (?, ?, ?, ?)");
    foreach ($defaults as $svc) {
        try {
            $stmt->execute([$svc['title'], $svc['slug'], $svc['image'], $svc['description']]);
            echo "Added: " . $svc['title'] . "\n";
        } catch (PDOException $e) {
            echo "Error adding " . $svc['title'] . ": " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "Services table already has data. Skipping seed.\n";
}

echo "Done.\n";
?>
