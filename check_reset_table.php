<?php
include 'src/db.php';
try {
    $stmt = $pdo->query("DESCRIBE password_resets");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
