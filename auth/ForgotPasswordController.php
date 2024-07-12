<?php
include 'koneksi.php'; // Include the database connection file

if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    
    // Generate OTP
    $otp = rand(100000, 999999);
    
    // Save OTP to database
    $stmt = $conn->prepare("INSERT INTO password_resets (email, otp) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $otp);
    $stmt->execute();
    $stmt->close();
    
    // Send OTP to user's email
    $subject = "Your Password Reset OTP";
    $message = "Your OTP for resetting your password is: $otp";
    $headers = "From: your-email@example.com";
    
    if (mail($email, $subject, $message, $headers)) {
        echo "OTP sent to your email.";
        // Redirect to OTP entry page
        header("Location: enter_otp.php?email=$email");
    } else {
        echo "Failed to send OTP.";
    }
}
