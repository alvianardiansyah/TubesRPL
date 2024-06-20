<?php
require_once 'config/conn.php';
require_once 'config/function.php'; 

hakAkses(['user']);
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags and other head content -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Barang</title>
    <!-- Include Bootstrap, jQuery, and other necessary CSS and JS files -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Pinjam Barang</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Header buttons if needed -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="name-colom">
                                <th width="5">NO</th>
                                <th>NAMA</th>
                                <th>MEREK</th>
                                <th>KATEGORI</th>
                                <th>RUANGAN</th>
                                <th>KONDISI</th>
                                <th>JUMLAH</th>
                                <th>PINJAM</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            $query = mysqli_query($con, "SELECT tb_barang.*, tb_merek.nama_merek, tb_kategori.nama_kategori, tb_kondisi.nama_kondisi, tb_ruangan.nama_ruangan, 
                                (tb_barang.jumlah_awal + COALESCE(SUM(CASE WHEN tb_transaksi.jenis_transaksi = 'masuk' THEN tb_transaksi.jumlah WHEN tb_transaksi.jenis_transaksi = 'keluar' OR (tb_transaksi.jenis_transaksi = 'pinjam' AND tb_transaksi.status = 'belum') THEN -tb_transaksi.jumlah ELSE 0 END), 0)) AS total_jumlah 
                                FROM tb_barang 
                                LEFT JOIN tb_merek ON tb_merek.id_merek = tb_barang.id_merek 
                                LEFT JOIN tb_kategori ON tb_kategori.id_kategori = tb_barang.id_kategori 
                                LEFT JOIN tb_ruangan ON tb_ruangan.id_ruangan = tb_barang.id_ruangan 
                                LEFT JOIN tb_kondisi ON tb_kondisi.id_kondisi = tb_barang.id_kondisi 
                                LEFT JOIN tb_transaksi ON tb_transaksi.id_barang = tb_barang.id_barang 
                                WHERE tb_barang.status = 'available'
                                GROUP BY tb_barang.id_barang 
                                ORDER BY tb_barang.id_barang ASC") or die(mysqli_error($con));
                            while ($row = mysqli_fetch_array($query)) :
                            ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_barang']; ?></td>
                                    <td><?= $row['nama_merek']; ?></td>
                                    <td><?= $row['nama_kategori']; ?></td>
                                    <td><?= $row['nama_ruangan']; ?></td>
                                    <td><?= $row['nama_kondisi']; ?></td>
                                    <td><?= $row['total_jumlah']; ?></td> <!-- Updated to show total_jumlah -->
                                    <td>
                                        <div class="center-icon">
                                            <a href="#barangkeluarModal" data-toggle="modal" data-id-transaksi="<?= $row['id_barang']; ?>" data-id-barang="<?= $row['id_barang']; ?>" data-nama-barang="<?= $row['nama_barang']; ?>" class="btn btn-sm btn-circle btn-info pinjam-barang"><i class="fas fa-book"></i></a>
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

    <!-- Modal Tambah barang_keluar -->
    <div class="modal fade" id="barangkeluarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url(); ?>process/process_peminjaman.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Peminjaman Barang</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Pinjam<span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" class="form-control">
                                    <input type="hidden" name="id_kasir" value="<?= $_SESSION['id'] ?>" class="form-control">
                                    <input type="date" class="form-control" id="tanggal" name="tanggal_pinjam" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Kembali<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal_kembali" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_barang">Barang<span class="text-danger">*</span></label>
                                    <select name="id_barang" id="id_barang" class="form-control select2" style="width:100%;">
                                        <?= list_barang(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_merek">Merek<span class="text-danger">*</span></label>
                                    <select name="id_merek" id="id_merek" class="form-control select2" style="width:100%;">
                                        <?= list_merek(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kategori">Kategori<span class="text-danger">*</span></label>
                                    <select name="id_kategori" id="id_kategori" class="form-control select2" style="width:100%;">
                                        <?= list_kategori(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kondisi">Kondisi<span class="text-danger">*</span></label>
                                    <select name="id_kondisi" id="id_kondisi" class="form-control select2" style="width:100%;">
                                        <?= list_kondisi(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control uang" id="jumlah" name="jumlah" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah">Stok</label>
                                    <input type="text" class="form-control" name="stok_display" readonly>
                                    <input type="hidden" name="stok">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" name="pinjam" class="btn btn-primary">Pinjam Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap, jQuery, and other necessary JS files -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.full.min.js"></script>
    <script>
        function setAllProperty(id_barang) {
            let selectedOption = $('#id_barang').find("option[value='" + id_barang + "']");
            if (!selectedOption.length) return;

            let idMerek = selectedOption.data("id-merek");
            let idKategori = selectedOption.data("id-kategori");
            let idKondisi = selectedOption.data("id-kondisi");
            let stok = selectedOption.data("stok");

            $('[name="id_merek"]').val(idMerek).trigger('change');
            $('[name="id_kategori"]').val(idKategori).trigger('change');
            $('[name="id_kondisi"]').val(idKondisi).trigger('change');

            $('[name="stok"]').val(stok);
            $('[name="stok_display"]').val(stok);
        }

        $(document).ready(function() {
            $(".pinjam-barang").on("click", function() {
                let idTransaksi = $(this).data("id-transaksi");
                let idBarang = $(this).data("id-barang");
                let namaBarang = $(this).data("nama-barang");

                $('#barangkeluarModal .modal-title').html('Peminjaman Barang');
                $('[name="id"]').val(idTransaksi);
                $('#id_barang').val(idBarang).trigger('change');

                setAllProperty(idBarang);
            });

            $('.select2').select2({
                theme: 'bootstrap4',
                width: 'resolve'
            });

            $('#id_barang').on('change', function() {
                setAllProperty($(this).val());
            });
        });
    </script>
</body>

</html>