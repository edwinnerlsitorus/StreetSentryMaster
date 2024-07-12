
<?php 
    include_once("tamplate/header.php");
    $serverName = 'localhost';
    $username = "root";
    $password = "";
    $database = "street_sentry";

    $conn = new mysqli($serverName, $username, $password, $database);

    if($conn->connect_error){
        die($conn->connect_error);
    }

    $sql = "SELECT * FROM information";
    $result = $conn->query($sql);

    if(!$result){
        die($conn->connect_error);
    }
?>

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/dashboard.css" type="text/css" rel="stylesheet">

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Additional Information</h1>
                    </div>
                    <a href="additionalInformationForm.php" class="btn btn-primary">Add Information</a>
                    <a href="generate_pdf.php" class="btn btn-primary">Download PDF</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Balai Besar/Balai</th>
                            <th scope="col">Satuan Kerja</th>
                            <th scope="col">PPK</th>
                            <th scope="col">Nomor Ruas Jalan</th>
                            <th scope="col">Nama Ruas Jalan</th>
                            <th scope="col">Tanggal Survey</th>
                            <th scope="col">Cuaca</th>
                            <th scope="col">Status Jalan</th>
                            <th scope="col">Km Awal</th>
                            <th scope="col">Km Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = $result->fetch_assoc()){
                            ?>

                                <tr>
                                    <th scope="row"><?php echo $row['id'] ?></th>
                                    <td><?php echo $row['province']; ?></td>
                                    <td><?php echo $row['balai_besar']; ?></td>
                                    <td><?php echo $row['satker']; ?></td>
                                    <td><?php echo $row['ppk']; ?></td>
                                    <td><?php echo $row['nomor_ruas_jalan']; ?></td>
                                    <td><?php echo $row['nama_ruas_jalan']; ?></td>
                                    <td><?php echo $row['tanggal_survey']; ?></td>
                                    <td><?php echo $row['cuaca']; ?></td>
                                    <td><?php echo $row['status_jalan']; ?></td>
                                    <td><?php echo $row['awal']; ?></td>
                                    <td><?php echo $row['akhir']; ?></td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>


<?php include_once("tamplate/footer.php");?>