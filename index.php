<?php
session_start();
if ($_SESSION['username'] == NULL) {
    // Haven't logged in
    header("Location:../auth/login.php");
}
require 'vendor/autoload.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "street_sentry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT lat, lng FROM lokasi_kerusakan";
$result = $conn->query($sql);

$dataMaps = array();
$lastLat = 0;
$lastLng = 0;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $dataMaps[] = array($row['lat'], $row['lng']);
        $lastLat = $row['lat'];
        $lastLng = $row['lng'];
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Street Sentry</title> 
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyAsztwGRQdp8X6iuU_FyHYDtLB-HRX_02g" 
          type="text/javascript"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Street Sentry</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/dashboard.css" type="text/css" rel="stylesheet">

    <style>
    .card-body {
        margin-left: -23px; /* Menambahkan margin atas */
        padding: 10px; /* Menambahkan padding untuk memberikan ruang di sekitar tabel */
    }

    table {
        margin-bottom: 20px; /* Menambahkan margin bawah pada tabel */
    }
    </style>

</head> 
<body id="page-top">

<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Street Sentry</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="home.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Information Table</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="additionalInformation.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Additional Information</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
<!-- End of Sidebar -->

 <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
    <div id="content">

<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo "Hi, ".$_SESSION['username'];?>
                        </span>
                        <img class="img-profile rounded-circle"
                            src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <div class="container-fluid">

                <div id="map" style="width: 100%; height: 50%;"></div>

                <script type="text/javascript">
                    var locations = <?php echo json_encode($dataMaps); ?>;
                    var lastLat = <?php echo $lastLat; ?>;
                    var lastLng = <?php echo $lastLng; ?>;
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: new google.maps.LatLng(lastLat, lastLng),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    });
                    var infowindow = new google.maps.InfoWindow();
                    var geocoder = new google.maps.Geocoder();
                    var marker, i;

                    for (i = 0; i < locations.length; i++) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                            map: map
                        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                var latlng = {lat: parseFloat(locations[i][0]), lng: parseFloat(locations[i][1])};
                                geocoder.geocode({'location': latlng}, function(results, status) {
                                    if (status === 'OK') {
                                        if (results[0]) {
                                            infowindow.setContent(results[0].formatted_address);
                                            infowindow.open(map, marker);
                                        } else {
                                            window.alert('No results found');
                                        }
                                    } else {
                                        window.alert('Geocoder failed due to: ' + status);
                                    }
                                });
                            }
                        })(marker, i));
                    }
                </script>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Jalur</th>
                                        <th scope="col">Jarak</th>
                                        <th scope="col">Lubang</th>
                                        <th scope="col">Bergelombang</th>
                                        <th scope="col">Alur</th>
                                        <th scope="col">Jembul</th>
                                        <th scope="col">Ambles</th>
                                        <th scope="col">Pelepasan Butir</th>
                                        <th scope="col">Retak Buaya</th>
                                        <th scope="col">Retak Pinggir</th>
                                        <th scope="col">Retak Melintang</th>
                                        <th scope="col">Retak Memanjang</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="data-table-body">
                                    <!-- Rows will be added dynamically here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>

</div>
<!-- End of Main Content -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
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

    <script>
        function logout() {
            // Perform any logout actions here, such as clearing session storage or cookies
            window.location.href = 'auth/login.php'; // Path to the login page in the auth folder
        }

        function fetchData() {
            fetch('get_data_jumlah.php')
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById('data-table-body');
                    tableBody.innerHTML = ''; // Clear any existing rows

                    data.forEach((row, index) => {
                        let tr = document.createElement('tr');

                        let tdIndex = document.createElement('th');
                        tdIndex.scope = "row";
                        tdIndex.textContent = index + 1;
                        tr.appendChild(tdIndex);

                        for (let key in row) {
                            let td = document.createElement('td');
                            td.textContent = row[key];
                            tr.appendChild(td);
                        }

                        tableBody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Call fetchData on page load
        window.onload = fetchData;
    </script>

    <!-- Bootstrap core JavaScript-->
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
    <script type="text/javascript" src="../js/googlemap.js"></script>

    <script>
$(document).ready(function () {
    // Fungsi untuk memuat data dari server
    function fetchData() {
        $.ajax({
            url: 'get_data_jumlah.php',  // Ganti dengan path ke file PHP yang mengembalikan data JSON
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var tableBody = $('#data-table-body');
                tableBody.empty();  // Kosongkan isi tabel sebelum mengisi dengan data baru

                // Loop data yang diterima dan tambahkan ke tabel
                data.forEach(function (item, index) {
                    var row = $('<tr>');

                    // Kolom Num diambil dari index + 1 karena index dimulai dari 0
                    var tdIndex = $('<td>').text(index + 1);
                    row.append(tdIndex);

                    // Kolom Jalur diambil dari jalur
                    var tdJalur = $('<td>').text(item.jalur);
                    row.append(tdJalur);

                    // Lanjutkan dengan kolom lain sesuai kebutuhan
                    row.append('<td>' + item.jarak + '</td>');
                    row.append('<td>' + item.lubang + '</td>');
                    row.append('<td>' + item.bergelombang + '</td>');
                    row.append('<td>' + item.alur + '</td>');
                    row.append('<td>' + item.jembul + '</td>');
                    row.append('<td>' + item.ambles + '</td>');
                    row.append('<td>' + item.pelepasan_butir + '</td>');
                    row.append('<td>' + item.retak_buaya + '</td>');
                    row.append('<td>' + item.retak_pinggir + '</td>');
                    row.append('<td>' + item.retak_melintang + '</td>');
                    row.append('<td>' + item.retak_memanjang + '</td>');
                    row.append('<td>' + item.total + '</td>');

                    tableBody.append(row);
                });
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }

    // Panggil fungsi fetchData secara otomatis setiap 5 detik (misalnya)
    setInterval(fetchData, 5000);  // Interval diatur dalam milidetik (misalnya, 5000 = 5 detik)
});
</script>

</body>
</html>