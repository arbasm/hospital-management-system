<?php
include 'src/db.php';
$stmt = $pdo->query("DESCRIBE doctors");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
