<?php
include 'src/db.php';
try {
    $stmt = $pdo->query("DESCRIBE services");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($columns);
} catch (Exception $e) {
    echo "Table services does not exist. Creating it...\n";
    $sql = "CREATE TABLE services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "Table created.\n";
}
?>
