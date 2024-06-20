<?php
include 'config/conn.php';
$username = $_SESSION['username'];
// Retrieve id_user based on username
if ($_SESSION['role'] == 'user') :
    $query_user = "SELECT id_user FROM tb_user WHERE username = '$username'";
    $result_user = mysqli_query($con, $query_user);
    $user = mysqli_fetch_assoc($result_user);
    $id_user = $user['id_user'];
    $peminjaman = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_peminjaman WHERE username = '$username'"));
    $pengembalian = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_monitoring WHERE id_user = '$id_user' AND status_transaksi = 'dikembalikan'"));
else :
    $barang_masuk = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_transaksi WHERE jenis_transaksi = 'masuk'"));
    $barang_keluar = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_transaksi WHERE jenis_transaksi = 'keluar'"));
    $barang_pinjam = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_monitoring WHERE status_transaksi = 'dipinjam'"));
    $barang_kembali = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) AS total FROM tb_monitoring WHERE status_transaksi = 'dikembalikan'"));
endif;



// Dapatkan data total barang per bulan
$query_barang_per_bulan = "
    SELECT DATE_FORMAT(tanggal_barang, '%Y-%m') AS bulan, SUM(jumlah_awal) AS jumlah_bulan 
    FROM tb_barang 
    GROUP BY DATE_FORMAT(tanggal_barang, '%Y-%m')
    ORDER BY bulan";

$result_barang_per_bulan = mysqli_query($con, $query_barang_per_bulan);

$bulan = [];
$jumlah_bulan = [];

while ($row = mysqli_fetch_array($result_barang_per_bulan)) {
    $bulan[] = $row['bulan'];
    $jumlah_bulan[] = $row['jumlah_bulan'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            height: 400px;
            margin: auto;
        }

        canvas {
            display: block;
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <p class="card-text">Data Barang</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= array_sum($jumlah_bulan); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <p class="card-text">Barang Masuk</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $barang_masuk['total']; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-danger text-white">
                            <p class="card-text">Barang Keluar</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $barang_keluar['total']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <p class="card-text">Peminjaman</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $barang_pinjam['total']; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <p class="card-text">Pengembalian</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $barang_kembali['total']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['role'] == 'user') : ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <p class="card-text">Peminjaman</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $peminjaman['total']; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <p class="card-text">Pengembalian</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $pengembalian['total']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <div class="row mt-4">
                <div class="col-md-6 chart-container">
                    <canvas id="barangChart"></canvas>
                </div>
                <div class="col-md-6 chart-container">
                    <canvas id="transaksiChart"></canvas>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // General data
            const bulan = <?= json_encode($bulan); ?>;
            const jumlahBulan = <?= json_encode($jumlah_bulan); ?>;

            // Role-specific data
            <?php if ($_SESSION['role'] == 'admin') : ?>
                const barangMasukData = <?= json_encode($barang_masuk['total']); ?>;
                const barangKeluarData = <?= json_encode($barang_keluar['total']); ?>;
                const barangPinjamData = <?= json_encode($barang_pinjam['total']); ?>;
                const barangKembaliData = <?= json_encode($barang_kembali['total']); ?>;
            <?php elseif ($_SESSION['role'] == 'user') : ?>
                const barangPinjamData = <?= json_encode($peminjaman['total']); ?>;
                const barangKembaliData = <?= json_encode($pengembalian['total']); ?>;
            <?php endif; ?>

            const ctxBarang = document.getElementById('barangChart').getContext('2d');
            const ctxTransaksi = document.getElementById('transaksiChart').getContext('2d');

            // Render Barang Chart
            new Chart(ctxBarang, {
                type: 'line',
                data: {
                    labels: bulan,
                    datasets: [{
                        label: 'Total Barang per Bulan',
                        data: jumlahBulan,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: true // fill area under the line
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Render Transaksi Chart
            new Chart(ctxTransaksi, {
                type: 'bar',
                data: {
                    labels: ['Barang Masuk', 'Barang Keluar', 'Peminjaman', 'Pengembalian'],
                    datasets: [{
                        label: 'Transaksi',
                        data: [barangMasukData, barangKeluarData, barangPinjamData, barangKembaliData],
                        backgroundColor: [
                            'rgba(31, 189, 26, 0.78)',
                            'rgba(224, 18, 62, 0.78)',
                            'rgba(37, 180, 223, 0.78)',
                            'rgba(231, 191, 13, 0.78)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(134, 227, 255, 0.78)',
                            'rgba(255, 228, 138, 0.78)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>