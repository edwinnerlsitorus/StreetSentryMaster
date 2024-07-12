<?php
// Lakukan koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "street_sentry";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data
$sql = "SELECT * FROM jumlah_kerusakan";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'jalur' => $row['jalur'],
            'jarak' => $row['jarak'],
            'lubang' => $row['lubang'],
            'bergelombang' => $row['bergelombang'],
            'alur' => $row['alur'],
            'jembul' => $row['jembul'],
            'ambles' => $row['ambles'],
            'pelepasan_butir' => $row['pelepasan_butir'],
            'retak_buaya' => $row['retak_buaya'],
            'retak_pinggir' => $row['retak_pinggir'],
            'retak_melintang' => $row['retak_melintang'],
            'retak_memanjang' => $row['retak_memanjang'],
            'total' => $row['total']
        );
    }
    echo json_encode($data);
} else {
    echo json_encode(array()); // Kirim JSON kosong jika tidak ada data
}

$conn->close();