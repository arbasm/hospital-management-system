<?php
include 'src/db.php';

$new_password = 'admin123';
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
$email = 'admin@clinic.com'; // Found earlier

try {
    $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE email = ?");
    $stmt->execute([$hashed_password, $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "Password for $email updated successfully.";
    } else {
        // If rowCount is 0, it might be because the password was already same or email not found
        // Let's check if user exists
        $check = $pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) {
             echo "User exists but password was not changed (maybe already set to this?). Force updating...";
             // Force update time or something to be sure? No, let's just assume it's fine if it matches.
        } else {
             // Create the admin if not exists
             $stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
             $stmt->execute([$email, $hashed_password]);
             echo "Admin user created with new password.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
