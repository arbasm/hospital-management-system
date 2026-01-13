<?php
include 'src/db.php';
echo "Checking Schedules...\n";
$stmt = $pdo->query("SELECT * FROM doctor_schedules");
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($schedules);

echo "\nChecking Doctors...\n";
$stmt = $pdo->query("SELECT id, name FROM doctors");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
