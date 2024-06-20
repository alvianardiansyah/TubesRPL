<?php
include 'config/conn.php';
hakAkses(['user']);

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
    header('Location: ../login.php');
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags and other head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Barang</title>
    <!-- Include Bootstrap, jQuery, and other necessary CSS and JS files -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        .center-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengembalian Barang</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Header buttons if needed -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5">NO</th>
                                <th>NAMA BARANG</th>
                                <th>MEREK</th>
                                <th>KATEGORI</th>
                                <th>KONDISI</th>
                                <th>JUMLAH</th>
                                <th>TANGGAL PINJAM</th>
                                <th>TANGGAL KEMBALI</th>
                                <th>KEMBALIKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            $query = mysqli_query($con, "
                                SELECT * FROM tb_peminjaman
                                WHERE username='$username'
                                ORDER BY id_pinjam ASC
                            ") or die(mysqli_error($con));
                            while ($row = mysqli_fetch_array($query)) :
                            ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['merek']; ?></td>
                                    <td><?= $row['kategori']; ?></td>
                                    <td><?= $row['kondisi']; ?></td>
                                    <td><?= $row['jumlah']; ?></td>
                                    <td><?= $row['tanggal_pinjam']; ?></td>
                                    <td><?= $row['tanggal_kembali']; ?></td>
                                    <td>
                                        <div class="center-icon">
                                            <a href="#pengembalianModal" data-toggle="modal" data-id-peminjaman="<?= $row['id_pinjam']; ?>" class="btn btn-sm btn-circle btn-info kembalikan-barang"><i class="fas fa-undo"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pengembalian barang -->
    <div class="modal fade" id="pengembalianModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="process/process_pengembalian.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengembalian Barang</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_peminjaman" class="form-control">
                        <p>Apakah anda yakin ingin mengembalikan barang ini?</p>
                        <hr class="sidebar-divider">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                        <button class="btn btn-primary float-right" type="submit" name="kembalikan"><i class="fas fa-undo"></i> Kembalikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".kembalikan-barang").on("click", function() {
                let id_peminjaman = $(this).data("id-peminjaman");
                $('[name="id_peminjaman"]').val(id_peminjaman);
            });
        });
    </script>
</body>

</html>