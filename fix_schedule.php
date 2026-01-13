<?php
include 'src/db.php';
echo "Fixing schedule times...\n";
// Update where end_time is 06:00:00 to 18:00:00 for simplicity in this case, 
// assuming it was a 12h/24h conversion error.
$stmt = $pdo->prepare("UPDATE doctor_schedules SET end_time = '18:00:00' WHERE end_time = '06:00:00'");
$stmt->execute();
echo "Updated rows: " . $stmt->rowCount() . "\n";

// Sanity check
$stmt = $pdo->query("SELECT * FROM doctor_schedules WHERE doctor_id = 7 AND day_of_week = 'Tuesday'");
print_r($stmt->fetch(PDO::FETCH_ASSOC));
?>
