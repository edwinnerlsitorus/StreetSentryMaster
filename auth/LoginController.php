<?php
include 'koneksi.php';

// Menerima data dari JavaScript
$username = $_POST['username'];
$password = $_POST['password'];

// Memeriksa apakah username dan password diisi
if (empty($username) || empty($password)) {
    echo 'empty_fields';
    exit();
}

// Membuat koneksi baru menggunakan MySQLi
$koneksi = new mysqli($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Cannot connect to database: " . $koneksi->connect_error);
}

// Query untuk memeriksa apakah username terdaftar di basis data
$query = "SELECT * FROM user WHERE username = ?";
$statement = $koneksi->prepare($query);

// Bind parameter
$statement->bind_param("s", $username);

// Eksekusi query
$statement->execute();

// Mengambil hasil query
$result = $statement->get_result();

// Memeriksa apakah username ditemukan
if ($result->num_rows == 1) {
    // Username ditemukan, lanjutkan dengan memeriksa password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Jika password cocok, set session dan redirect
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $username;

        // Kirim respons sukses
        echo "success";
    } else {
        // Jika password salah, kirim respons "incorrect_password"
        echo "incorrect_password";
    }
} else {
    // Jika username tidak ditemukan, kirim respons "not_registered"
    echo "not_registered";
}

// Menutup statement
$statement->close();

// Menutup koneksi
$koneksi->close();
