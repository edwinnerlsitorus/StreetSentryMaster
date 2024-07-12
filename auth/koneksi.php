<?php
$host ='192.168.132.68';
$user ='root';
$pass ='';
$db = 'street_sentry'; // Anda perlu menentukan nama database yang akan digunakan

// Membuat koneksi baru menggunakan MySQLi
$koneksi = new mysqli($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if($koneksi->connect_error){
    die("Cannot connect to database: " . $koneksi->connect_error);
}

// Memilih database yang akan digunakan
if (!mysqli_select_db($koneksi, $db)) {
    die("Cannot select database: " . mysqli_error($koneksi));
}

