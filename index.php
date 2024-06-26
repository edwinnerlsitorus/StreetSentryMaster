
<?php include_once("tamplate/header.php");?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Street Sentry Dashboard</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">GPS Tracking System</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <iframe class="chart-area" width="100%" height="33 0" src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Total Road Detection Count</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div id="card-total-road">
                                        <h1 id="total-road" class="display-1">46</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
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
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>IT Del - Balige</td>
                                <td>10 KM</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>3</td>
                                <td>33</td>
                            </tr>
                    </table>
                </div>
                <!-- /.container-fluid -->

            <!-- Footer -->
<?php include_once("tamplate/footer.php");?>