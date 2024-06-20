<?php
// session_start();
include('../config/conn.php');
include('../config/function.php');
$base_url = '/inventory/';

?>
<html>

<head>
    <style>
        h2 {
            padding: 0px;
            margin: 0px;
            font-size: 14pt;
        }

        h4 {
            font-size: 12pt;
        }

        text {
            padding: 0px;
        }

        table {
            border-collapse: collapse;
            border: 1px solid #000;
            font-size: 11pt;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        table.tab {
            table-layout: auto;
            width: 100%;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 100px;
            height: auto;
        }

        .kop-surat h1 {
            font-size: 16pt;
            margin: 0;
        }

        .kop-surat p {
            margin: 0;
            font-size: 10pt;
        }
    </style>
    <title>Cetak Laporan</title>
</head>

<body>
    <?php
    $now = date('Y-m-d');
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $query = mysqli_query($con, "SELECT * FROM tb_monitoring LEFT JOIN tb_barang ON tb_monitoring.id_barang = tb_barang.id_barang LEFT JOIN tb_user ON tb_user.id_user = tb_monitoring.id_user WHERE status_transaksi = 'dipinjam' OR status_transaksi = 'dikembalikan'  AND tb_monitoring.tanggal_pinjam >= '$tanggal_pinjam' AND tb_monitoring.tanggal_kembali <= '$tanggal_kembali' ORDER BY tb_monitoring.tanggal_pinjam ASC") or die(mysqli_error($con));

    ?>
    <div class="kop-surat">
        <img src="<?= $base_url; ?>assets/img/kop.png" alt="Logo" style="width: auto;">
    </div>
    <div style="page-break-after:always;text-align:center;margin-top:5%;">
        <div style="line-height:5px;">
            <h2>LAPORAN PEMINJAMAN DATA INVENTARIS</h2>
            <h4><?= date('d-m-Y', strtotime($tanggal_pinjam)); ?> - <?= date('d-m-Y', strtotime($tanggal_kembali)); ?></h4>
        </div>
        <hr style="border-color:black;">
        <table class="tab">
            <tr>
                <th width="20">NO</th>
                <th>NAMA BARANG</th>
                <th>NAMA USER</th>
                <th>TGL PINJAM</th>
                <th>TGL KEMBALI</th>
                <th>STATUS TRANSAKSI</th>
            </tr>
            <?php $n = 1;
            $total = 0;
            while ($row = mysqli_fetch_array($query)) : ?>
                <tr>
                    <td align="center"><?= $n++ . '.'; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['nama_user']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_pinjam'])); ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_kembali'])); ?></td>
                    <td><?= $row['status_transaksi']; ?></td>
                </tr>
            <?php
                $total += $row['jumlah'];
            endwhile; ?>
            <tr>
                <td colspan="7" align="center"><b>TOTAL SEMUA BARANG DIPINJAM</b></td>
                <td><?= $total; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>

<script>
    window.print();
</script>