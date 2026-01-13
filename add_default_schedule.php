<?php
include 'src/db.php';

echo "Adding default schedule for all doctors...\n";

// Get all doctors
$stmt = $pdo->query("SELECT id FROM doctors");
$doctors = $stmt->fetchAll(PDO::FETCH_COLUMN);

$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
$start = '09:00:00';
$end = '17:00:00';

foreach ($doctors as $docId) {
    // Check if schedule exists
    $stmt = $pdo->prepare("SELECT count(*) FROM doctor_schedules WHERE doctor_id = ?");
    $stmt->execute([$docId]);
    if ($stmt->fetchColumn() == 0) {
        foreach ($days as $day) {
            $stmt = $pdo->prepare("INSERT INTO doctor_schedules (doctor_id, day_of_week, start_time, end_time) VALUES (?, ?, ?, ?)");
            $stmt->execute([$docId, $day, $start, $end]);
        }
        echo "Added schedule for Doctor ID: $docId\n";
    } else {
        echo "Schedule already exists for Doctor ID: $docId\n";
    }
}
echo "Done.";
?>
