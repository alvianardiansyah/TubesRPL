<?php
hakAkses(['admin']);
include 'config/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Peminjaman Barang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Monitoring Peminjaman Barang</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="<?= base_url(); ?>process/cetak_laporan_pinjam_today.php" method="post" target="_blank">
                    <input type="hidden" value="pinjam" name="jenis_transaksi" />
                    <input type="hidden" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>">
                    <input type="hidden" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="<?= date('Y-m-d'); ?>">
                    <button type="submit" class="btn btn-info btn-icon-split btn-sm float-right" style="height:40px;"><i class="icon text-white-50 fas fa-print"></i> Cetak
                        Laporan Peminjaman Hari Ini</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5">NO</th>
                                <th>NAMA BARANG</th>
                                <th>NAMA USER</th>
                                <th>TANGGAL PINJAM</th>
                                <th>TANGGAL KEMBALI</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            $query = mysqli_query($con, "SELECT tb_monitoring.*, tb_barang.nama_barang, tb_user.nama_user FROM tb_monitoring LEFT JOIN tb_barang ON tb_barang.id_barang = tb_monitoring.id_barang LEFT JOIN tb_user ON tb_user.id_user = tb_monitoring.id_user ORDER BY tb_monitoring.id_pinjam ASC") or die(mysqli_error($con));
                            while ($row = mysqli_fetch_array($query)) :
                            ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['nama_user']; ?></td>
                                    <td><?= $row['tanggal_pinjam']; ?></td>
                                    <td><?= $row['tanggal_kembali']; ?></td>
                                    <td><?= $row['status_transaksi'] == 'dipinjam' ? 'Dipinjam' : 'Dikembalikan'; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>