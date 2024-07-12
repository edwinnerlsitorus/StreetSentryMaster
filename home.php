<?php include_once("tamplate/header.php"); ?>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/dashboard.css" type="text/css" rel="stylesheet">

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Information Table</h1>
    </div>
</div>

<div class="card-body">
    <table id="info-table" class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">STA (KM)</th>
                <th scope="col">Posisi Kiri</th>
                <th scope="col">Posisi Kanan</th>
                <th scope="col">Kategori Kerusakan</th>
                <th scope="col">Ukuran P (m)</th>
                <th scope="col">Ukuran L (m)</th>
                <th scope="col">Ukuran D (m)</th>
                <th scope="col">Ukuran A (m2)</th>
                <th scope="col">Ukuran V (m3)</th>
                <th scope="col">Ukuran J (Buah)</th>
                <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data akan dimuat melalui AJAX -->
        </tbody>
    </table>
</div>
<!-- End of Main Content -->

<?php include_once("tamplate/footer.php"); ?>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" onclick="logout()">Logout</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        function loadData() {
            $.ajax({
                url: 'get_data.php',
                method: 'GET',
                success: function(response) {
                    $('#info-table tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading data: " + error);
                    $('#info-table tbody').html('<tr><td colspan="12">Data tidak dapat dimuat.</td></tr>');
                }
            });
        }

        // Load data initially when page is fully loaded
        loadData();

        // Reload data every 5 seconds (example)
        setInterval(function() {
            loadData();
        }, 5000);
    });

    function logout() {
        // Perform logout action here, such as clearing session or cookie
        window.location.href = 'auth/login.php'; // Path to login page
    }
</script>
