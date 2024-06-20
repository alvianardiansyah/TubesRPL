<?php
include('config/conn.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

// Ambil ID pengguna dari sesi
$id_user = $_SESSION['id'];

// Inisialisasi variabel untuk menyimpan pesan
$success = "";
$error = "";

// Ambil data pengguna dari tabel tb_user
$query = "SELECT * FROM tb_user WHERE id_user='$id_user'";
$result = mysqli_query($con, $query);

if ($result) {
    $user_data = mysqli_fetch_assoc($result);
} else {
    $error = "Gagal mengambil data pengguna.";
}

// Proses pembaruan data
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $no_HP = mysqli_real_escape_string($con, $_POST['no_HP']);
    $username = mysqli_real_escape_string($con, $_POST['username']);

    // Validasi input
    if (empty($name) || empty($no_HP) || empty($username)) {
        $error = "Harap isi semua field.";
    } else {
        // Update data pengguna
        $update_query = "UPDATE tb_user SET nama_user='$name', no_hp_user='$no_HP', username='$username' WHERE id_user='$id_user'";
        if (mysqli_query($con, $update_query)) {
            $success = "Profil berhasil diperbarui.";
            // Perbarui data sesi
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            // Ambil data pengguna terbaru
            $user_data['nama_user'] = $name;
            $user_data['no_hp_user'] = $no_HP;
            $user_data['username'] = $username;
        } else {
            $error = "Gagal memperbarui profil. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h2 class="mb-4">Profil User</h2>

                    <?php if (!empty($success)) : ?>
                        <div class="alert alert-success"><?= $success; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="name">Nama User</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user_data['nama_user']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username (NIM)</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user_data['username']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_HP">No. Handphone</label>
                                    <input type="text" class="form-control" id="no_HP" name="no_HP" value="<?= htmlspecialchars($user_data['no_hp_user']); ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="update_profile">Update Profil</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>