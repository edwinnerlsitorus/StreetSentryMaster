<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/dashboard.css" type="text/css" rel="stylesheet">

    <style>
        .custom-checkbox-group-1,
        .custom-checkbox-group-2 {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        .custom-control-input {
            display: none; /* Hide the default checkbox */
        }
        .custom-control-label {
            position: relative;
            cursor: pointer;
            padding-left: 35px; /* Space for custom checkbox */
        }
        .custom-control-label::before,
        .custom-control-label::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            transition: all 0.2s ease;
        }
        .custom-control-label::after {
            display: none;
            content: '✓';
            font-size: 16px;
            color: #080f00;
            text-align: center;
            line-height: 20px;
        }
        .custom-control-input:checked + .custom-control-label::before {
            background-color: #080f00;
            border-color: #080f00;
        }
        .custom-control-input:checked + .custom-control-label::after {
            display: block;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img style="margin:50px;" src="../img/logo.png" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="loginForm" action="LoginController.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group custom-checkbox-group-2">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" onclick="togglePasswordVisibility()" id="customCheck-2">
                                                <label class="custom-control-label" for="customCheck-2">Show Password</label>
                                            </div>
                                        </div>
                                        <div class="form-group custom-checkbox-group-1">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block"/>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot_password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

    <!-- Show/hide password script -->
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        // Handle form submission
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent default form submission

            // Validate inputs
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Silahkan masukkan username terlebih dahulu!'
                });
                return;
            }

            if (password === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Silahkan masukkan password terlebih dahulu!'
                });
                return;
            }

            // Perform AJAX request to LoginController.php
            var form = this;
            var formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: form.action,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle response based on the returned message
                    console.log("Response from server: ", response);
                    switch (response) {
                        case "success":
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Berhasil',
                                text: 'Anda akan dialihkan ke halaman utama.'
                            }).then(function() {
                                window.location.href = '../index.php'; // Path to your homepage
                            });
                            break;
                        case "incorrect_password":
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: 'Username atau Password Salah'
                            });
                            break;
                        case "not_registered":
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: 'Akun belum terdaftar, Silahkan registrasi terlebih dahulu!'
                            });
                            break;
                        case "empty_fields":
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: 'Silahkan isi semua bidang yang diperlukan.'
                            });
                            break;
                        default:
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Gagal',
                                text: 'Terjadi kesalahan saat login. Silahkan coba lagi.'
                            });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengirim data login.'
                    });
                }
            });
        });
    </script>
</body>

</html>
