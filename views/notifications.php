<?php
// Definisikan base_url
$base_url = '/inventory/';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Notifikasi</h2>
        <div id="notificationContent">
            <?php
            if ($_SESSION['role'] == 'user') {
                $username = $_SESSION['username'];
                $query = mysqli_query($con, "SELECT message, type FROM tb_notification WHERE username='$username' ORDER BY created_at DESC") or die(mysqli_error($con));
                $notifications = mysqli_fetch_all($query, MYSQLI_ASSOC);

                if ($notifications) {
                    foreach ($notifications as $notification) {
                        if ($notification['type'] == 'peminjaman') {
                            echo "<div class='alert alert-info'>" . htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') . "</div>";
                        } elseif ($notification['type'] == 'pengembalian_terlambat') {
                            echo "<div class='alert alert-danger'>" . htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') . "</div>";
                        } else {
                            echo "<div class='alert alert-warning'>" . htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') . "</div>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-warning'>Tidak ada notifikasi</div>";
                }
            } else {
                $query_stok_habis = mysqli_query($con, "SELECT tb_barang.*, tb_ruangan.nama_ruangan FROM tb_barang LEFT JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_barang.id_ruangan WHERE jumlah_awal <= 0") or die(mysqli_error($con));
                $notifications = mysqli_fetch_all($query_stok_habis, MYSQLI_ASSOC);
                if ($notifications) {
                    foreach ($notifications as $notification) {
                        echo "<div class='alert alert-danger'>Perhatian! Ada barang yang stoknya habis: " . htmlspecialchars($notification['nama_barang'], ENT_QUOTES, 'UTF-8') . ", di " . htmlspecialchars($notification['nama_ruangan'], ENT_QUOTES, 'UTF-8') . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Tidak ada notifikasi</div>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>