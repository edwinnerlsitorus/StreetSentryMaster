<?php 
if (isset($_POST['addInfo'])) { 

    // Connect to the database 
    $mysqli = new mysqli("localhost", "root", "", "street_sentry"); 

    // Check connection
    if ($mysqli->connect_error) { 
        die("Connection failed: " . $mysqli->connect_error); 
    } 

    // Retrieve form data
    $provinsi = isset($_POST['provinsi']) ? $_POST['provinsi'] : ''; 
    $balaiBesar = isset($_POST['balai_besar']) ? $_POST['balai_besar'] : ''; 
    $satker = isset($_POST['satker']) ? $_POST['satker'] : '';
    $ppk = isset($_POST['ppk']) ? $_POST['ppk'] : '';
    $nomorruasjalan = isset($_POST['nomor_ruas_jalan']) ? $_POST['nomor_ruas_jalan'] : ''; 
    $namaruasjalan = isset($_POST['nama_ruas_jalan']) ? $_POST['nama_ruas_jalan'] : ''; 
    $tglSurvey = isset($_POST['tgl_survey']) ? $_POST['tgl_survey'] : '';
    $cuaca = isset($_POST['cuaca']) ? $_POST['cuaca'] : '';
    $statusJalan = isset($_POST['status_jalan']) ? $_POST['status_jalan'] : '';
    $awal = isset($_POST['titik_awal']) ? $_POST['titik_awal'] : '';
    $akhir = isset($_POST['titik_akhir']) ? $_POST['titik_akhir'] : '';

    // Debugging: Print form data
    echo "Provinsi: $provinsi<br>";
    echo "Balai Besar: $balaiBesar<br>";
    echo "Satker: $satker<br>";
    echo "PPK: $ppk<br>";
    echo "Nomor Ruas Jalan: $nomorruasjalan<br>";
    echo "Nama Ruas Jalan: $namaruasjalan<br>";
    echo "Tanggal Survey: $tglSurvey<br>";
    echo "Cuaca: $cuaca<br>";
    echo "Status Jalan: $statusJalan<br>";
    echo "Titik Awal: $awal<br>";
    echo "Titik Akhir: $akhir<br>";

    // Check if mandatory fields are filled
    if(empty($nomorruasjalan) || empty($namaruasjalan)) {
        echo "Nomor Ruas Jalan dan Nama Ruas Jalan tidak boleh kosong.";
        exit;
    }

    // Prepare SQL statement
    $stmt = $mysqli->prepare("INSERT INTO information (`province`, `balai_besar`, `satker`, `ppk`, `nomor_ruas_jalan`, `nama_ruas_jalan`, `tanggal_survey`, `cuaca`, `status_jalan`, `awal`, `akhir`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("sssssssssss", $provinsi, $balaiBesar, $satker, $ppk, $nomorruasjalan, $namaruasjalan, $tglSurvey, $cuaca, $statusJalan, $awal, $akhir); 

    // Execute statement
    if ($stmt->execute()) { 
        // Redirect to additionalInformation.php after successful insertion
        header("Location: ../additionalInformation.php"); 
        exit; 
    } else { 
        // Display error if insertion fails
        echo "Error: " . $stmt->error; 
    } 

    // Close statement and connection
    $stmt->close(); 
    $mysqli->close(); 
}
