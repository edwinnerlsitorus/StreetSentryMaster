
<?php 
    include_once("tamplate/header.php");
    $serverName = 'localhost';
    $username = "root";
    $password = "";
    $database = "street_sentry";

    $conn = new mysqli($serverName, $username, $password, $database);

    if($conn->connection_error){
        die($conn->connection_error);
    }

    $sql = "SELECT * FROM information";
    $result = $conn->query($sql);

    if(!$result){
        die($conn->connection_error);
    }
?>
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Additional Information</h1>
                    </div>
                    <a href="additionalInformationForm.php" class="btn btn-primary">Add Information</a>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Balai Besar</th>
                            <th scope="col">Satuan Kerja</th>
                            <th scope="col">Ruas Jalan</th>
                            <th scope="col">Tanggal Survey</th>
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
                                    <td><?php echo $row['ruas_jalan']; ?></td>
                                    <td><?php echo $row['tanggal_survey']; ?></td>
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
<?php include_once("tamplate/footer.php");?>