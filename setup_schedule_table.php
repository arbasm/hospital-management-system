<?php
include 'src/db.php';
try {
    $sql = "CREATE TABLE IF NOT EXISTS doctor_schedules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        doctor_id INT NOT NULL,
        day_of_week VARCHAR(20) NOT NULL, -- Monday, Tuesday
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql);
    echo "Table 'doctor_schedules' created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
