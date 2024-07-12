<?php
include 'db.php'; // Include the database connection file

if (isset($_POST['verify_otp'])) {
    $email = $_POST['email'];
    $enteredOtp = $_POST['otp'];
    
    // Retrieve OTP from database
    $stmt = $conn->prepare("SELECT otp FROM password_resets WHERE email = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($storedOtp);
    $stmt->fetch();
    $stmt->close();
    
    if ($enteredOtp == $storedOtp) {
        // OTP is correct, allow user to reset password
        header("Location: reset_password.php?email=$email");
    } else {
        echo "Invalid OTP. Please try again.";
    }
}