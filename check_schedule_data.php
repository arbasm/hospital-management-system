<?php
include 'src/db.php';
$stmt = $pdo->query("SELECT count(*) as count FROM doctor_schedules");
$count = $stmt->fetchColumn();
echo "Schedule Rows: " . $count . "\n";

if ($count > 0) {
    $stmt = $pdo->query("SELECT * FROM doctor_schedules LIMIT 5");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
}
?>
