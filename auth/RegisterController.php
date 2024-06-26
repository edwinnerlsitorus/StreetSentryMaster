<?php if (isset($_POST['register'])) { 

    // Connect to the database 
    $mysqli = new mysqli("localhost", "root", "", "street_sentry"); 

    $username = $_POST['username']; 
    $firstName = $_POST['first_name']; 
    $lastName = $_POST['last_name'];
    $password = $_POST['password']; 

    echo $username;

    if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } 

    $stmt = $mysqli->prepare("INSERT INTO user (`first_name`, `last_name`, `username`, `password`) VALUES (?, ?, ?, ?)"); $stmt->bind_param("ssss", $firstName, $lastName,$username, $passwordHash); 

    $username = $_POST['username']; 
    $firstName = $_POST['first_name']; 
    $lastName = $_POST['last_name'];
    $password = $_POST['password']; 

    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 

    if ($stmt->execute()) { 
        header("Location: login.php"); 
        exit; 
        echo '<script>alert("Registrasi Berhasil");</script>';
    } else { 
        echo "Error: " . $stmt->error; 
    } 

    $stmt->close(); $mysqli->close(); 
}

?>