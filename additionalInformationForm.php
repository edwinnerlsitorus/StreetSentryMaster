<?php include_once("tamplate/header.php");?>

                <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create Information</h1>
                            </div>
                            <form action="controller/addInfoController.php" method="post" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="provinsi" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Provinsi">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="balai_besar" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Balai Besar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="satker" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Satuan Kerja">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="ruas_jalan" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Ruas Jalan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="tgl_survey" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Tanggal Survey">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="status_jalan" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Status Jalan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="titik_awal" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Titik Awal">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="titik_akhir" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Titik Akhir">
                                    </div>
                                </div>
                                <input class="btn btn-primary btn-user btn-block" name="addInfo" type="submit" value="Submit" />
                            </form>
                        </div>
            <!-- End of Main Content -->

            <!-- Footer -->
<?php include_once("tamplate/footer.php");?>