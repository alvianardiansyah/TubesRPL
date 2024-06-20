<?php
session_start();
include('config/conn.php');
$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Enkripsi password menggunakan password_hash()

    // Periksa apakah username sudah ada dalam database
    $check_username = mysqli_query($con, "SELECT * FROM tb_user WHERE username='$username'");
    if (mysqli_num_rows($check_username) > 0) {
        $_SESSION['error'] = 'Username sudah digunakan. Silakan pilih username lain.';
    } else {
        // Jika username belum ada, lakukan penyimpanan data
        $query = "INSERT INTO tb_admin (nama_admin, username, password) VALUES ('$name','$username', '$hashed_password')";
        if (mysqli_query($con, $query)) {
            $_SESSION['success'] = 'Akun berhasil dibuat. Silakan login.';
            header("Location: " . $base_url . "login.php");
            exit;
        } else {
            $_SESSION['error'] = 'Gagal membuat akun. Silakan coba lagi.';
        }
    }
    $_SESSION['error'] = $error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrasi Akun - SIMI</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>assets/img/SIMI1.png">
    <link href="<?= $base_url; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= $base_url; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                                    </div>
                                    <?php if (isset($_SESSION['error'])) : ?>
                                        <div class="alert alert-danger">
                                            <?= $_SESSION['error']; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="name" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="register">Daftar Akun</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= $base_url; ?>login.php">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= $base_url; ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= $base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= $base_url; ?>assets/js/sb-admin-2.min.js"></script>
</body>

</html>