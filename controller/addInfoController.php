<?php if (isset($_POST['addInfo'])) { 

// Connect to the database 
$mysqli = new mysqli("localhost", "root", "", "street_sentry"); 

$provinsi = $_POST['provinsi']; 
$balaiBesar = $_POST['balai_besar']; 
$satker = $_POST['satker'];
$ruasJalan = $_POST['ruas_jalan']; 
$tglSurvey = $_POST['tgl_survey'];
$statusJalan = $_POST['status_jalan'];
$awal = $_POST['titik_awal'];
$akhir = $_POST['titik_akhir'];

// echo $provinsi. " ";
// echo $balaiBesar. " ";
// echo $satker. " ";
// echo $ruasJalan. " ";
// echo $tglSurvey. " ";
// echo $statusJalan. " ";
// echo $awal. " ";
// echo $akhir. " ";

if ($mysqli->connect_error) { die("Connection failed: " . $mysqli->connect_error); } 

$stmt = $mysqli->prepare("INSERT INTO information (`province`, `balai_besar`, `satker`, `ruas_jalan`, `tanggal_survey`, `status_jalan`, `awal`, `akhir`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); $stmt->bind_param("ssssssss", $provinsi, $balaiBesar,$satker, $ruasJalan, $tglSurvey, $statusJalan, $awal, $akhir); 

$provinsi = $_POST['provinsi']; 
$balaiBesar = $_POST['balai_besar']; 
$satker = $_POST['satker'];
$ruasJalan = $_POST['ruas_jalan']; 
$tglSurvey = $_POST['tgl_survey'];
$statusJalan = $_POST['status_jalan'];
$awal = $_POST['titik_awal'];
$akhir = $_POST['titik_akhir'];

if ($stmt->execute()) { 
    header("Location: ../additionalInformation.php"); 
    exit; 
    echo '<script>alert("Registrasi Berhasil");</script>';
} else { 
    echo $stmt->error; 
} 

$stmt->close(); $mysqli->close(); 
}

?>