<?php
session_start();
include('../config/conn.php');
include('../config/function.php');

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
    header('Location: ../login.php');
    exit;
}
$username = $_SESSION['username'];

if (isset($_POST['kembalikan'])) {
    $id_peminjaman = isset($_POST['id_peminjaman']) ? $_POST['id_peminjaman'] : '';

    // Fetch the item details from tb_peminjaman
    $query = mysqli_query($con, "SELECT * FROM tb_peminjaman WHERE id_pinjam='$id_peminjaman' AND username='$username'") or die(mysqli_error($con));
    $peminjaman = mysqli_fetch_assoc($query);

    if ($peminjaman) {
        $id_barang = $peminjaman['id_barang'];  // Corrected from 'id_pinjam' to 'id_barang'
        $jumlah_pinjam = $peminjaman['jumlah'];
        $tanggal_kembali = $peminjaman['tanggal_kembali']; // Get the return date from the peminjaman record

        if (empty($id_barang)) {
            $_SESSION['error'] = 'ID Barang tidak ditemukan di data peminjaman';
            header('Location: ../?pengembalian');
            exit;
        }

        // Fetch the item details from tb_barang
        $barang_query = mysqli_query($con, "SELECT * FROM tb_barang WHERE id_barang='$id_barang'") or die(mysqli_error($con));
        $barang = mysqli_fetch_assoc($barang_query);

        if ($barang) {
            $nama_barang = $barang['nama_barang']; // Get the item name from the barang record
            // Update the stock in tb_barang
            $new_stock = $barang['jumlah_awal'] + $jumlah_pinjam;  // Corrected logic
            $update_stock_query = "UPDATE tb_barang SET jumlah_awal='$new_stock' WHERE id_barang='$id_barang'";  // Corrected from 'id_pinjam' to 'id_barang'
            $update_stock = mysqli_query($con, $update_stock_query);

            if ($update_stock) {
                // Update the status in tb_monitoring
                $update_monitoring_query = "UPDATE tb_monitoring SET status_transaksi='dikembalikan' WHERE id_pinjam='$id_peminjaman'";
                $update_monitoring = mysqli_query($con, $update_monitoring_query);

                // Check for late return and add notification
                $tanggal_kembali_ts = strtotime($tanggal_kembali);
                $today_ts = strtotime(date('Y-m-d'));
                if ($tanggal_kembali_ts < $today_ts) {
                    $query_late_return_notification = "INSERT INTO tb_notification (username, message, type, created_at, is_read) VALUES ('$username', 'Anda terlambat mengembalikan $nama_barang yang seharusnya dikembalikan pada tanggal $tanggal_kembali', 'pengembalian_terlambat', NOW(), 'unread')";
                    $insert_late_return_notification = mysqli_query($con, $query_late_return_notification);
                }

                if ($update_monitoring) {
                    // Delete the peminjaman record
                    $delete_query = "DELETE FROM tb_peminjaman WHERE id_pinjam='$id_peminjaman'";
                    $delete = mysqli_query($con, $delete_query);

                    if ($delete) {
                        $_SESSION['success'] = 'Barang berhasil dikembalikan dan stok diperbarui';
                    } else {
                        $_SESSION['error'] = 'Barang berhasil diperbarui di monitoring, tetapi gagal menghapus peminjaman: ' . mysqli_error($con);
                    }
                } else {
                    $_SESSION['error'] = 'Gagal memperbarui status di monitoring: ' . mysqli_error($con);
                }
            } else {
                $_SESSION['error'] = 'Gagal memperbarui stok barang: ' . mysqli_error($con);
            }
        } else {
            $_SESSION['error'] = 'Data barang tidak ditemukan';
        }
    } else {
        $_SESSION['error'] = 'Data peminjaman tidak ditemukan';
    }

    header('Location: ../?pengembalian');
    exit;
}
