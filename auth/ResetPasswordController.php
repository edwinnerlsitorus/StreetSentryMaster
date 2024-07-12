<?php
include 'db.php'; // Include the database connection file

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
    // Update user's password in the database
    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute()) {
        echo "Password reset successful. Redirecting to login page...";
        header("refresh:2; url=login.php");
    } else {
        echo "Error resetting password.";
    }
    $stmt->close();
}