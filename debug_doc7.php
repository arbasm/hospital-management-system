<?php
include 'src/db.php';
$stmt = $pdo->prepare("SELECT * FROM doctor_schedules WHERE doctor_id = ?");
$stmt->execute([7]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Count: " . count($rows) . "\n";
print_r($rows);
?>
