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

$query_user = "SELECT id_user FROM tb_user WHERE username = '$username'";
$result_user = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($result_user);
$id_user = $user['id_user'];

if (isset($_POST['pinjam'])) {
    $id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : '';
    $id_merek = isset($_POST['id_merek']) ? $_POST['id_merek'] : '';
    $id_kategori = isset($_POST['id_kategori']) ? $_POST['id_kategori'] : '';
    $id_kondisi = isset($_POST['id_kondisi']) ? $_POST['id_kondisi'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    $stok = isset($_POST['stok']) ? $_POST['stok'] : '';
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : '';
    $tanggal_kembali = isset($_POST['tanggal_kembali']) ? $_POST['tanggal_kembali'] : '';

    if ($jumlah > $stok) {
        $_SESSION['error'] = 'Transaksi gagal, jumlah melebihi stok yang ada saat ini!';
        header('Location: ../?peminjaman');
        exit;
    }

    $query_barang = "SELECT nama_barang FROM tb_barang WHERE id_barang = '$id_barang'";
    $result_barang = mysqli_query($con, $query_barang);
    $barang = mysqli_fetch_assoc($result_barang);
    $nama_barang = $barang['nama_barang'];

    $query_merek = "SELECT nama_merek FROM tb_merek WHERE id_merek = '$id_merek'";
    $result_merek = mysqli_query($con, $query_merek);
    $merek = mysqli_fetch_assoc($result_merek);
    $nama_merek = $merek['nama_merek'];

    $query_kategori = "SELECT nama_kategori FROM tb_kategori WHERE id_kategori = '$id_kategori'";
    $result_kategori = mysqli_query($con, $query_kategori);
    $kategori = mysqli_fetch_assoc($result_kategori);
    $nama_kategori = $kategori['nama_kategori'];

    $query_kondisi = "SELECT nama_kondisi FROM tb_kondisi WHERE id_kondisi = '$id_kondisi'";
    $result_kondisi = mysqli_query($con, $query_kondisi);
    $kondisi = mysqli_fetch_assoc($result_kondisi);
    $nama_kondisi = $kondisi['nama_kondisi'];

    $query = "INSERT INTO tb_peminjaman (id_barang, nama_barang, merek, kategori, kondisi, jumlah, tanggal_pinjam, tanggal_kembali, username) VALUES ('$id_barang','$nama_barang', '$nama_merek', '$nama_kategori', '$nama_kondisi', '$jumlah', '$tanggal_pinjam', '$tanggal_kembali', '$username')";
    $insert = mysqli_query($con, $query);

    if ($insert) {
        $id_pinjam = mysqli_insert_id($con);

        $query_monitoring = "INSERT INTO tb_monitoring (id_pinjam, id_barang, id_user, tanggal_pinjam, tanggal_kembali, jumlah, status_transaksi) VALUES ('$id_pinjam', '$id_barang', '$id_user', '$tanggal_pinjam', '$tanggal_kembali', '$jumlah', 'dipinjam')";
        $insert_monitoring = mysqli_query($con, $query_monitoring);

        if ($insert_monitoring) {
            $new_stok = $stok - $jumlah;
            $query_update_stok = "UPDATE tb_barang SET jumlah_awal = '$new_stok' WHERE id_barang = '$id_barang'";
            $update_stok = mysqli_query($con, $query_update_stok);

            if ($update_stok) {
                // Add notification for successful borrowing
                $query_notification = "INSERT INTO tb_notification (username, message, type, created_at, is_read) VALUES ('$username', 'Anda telah meminjam $nama_barang pada tanggal $tanggal_pinjam', 'peminjaman', NOW(), 'unread')";
                $insert_notification = mysqli_query($con, $query_notification);

                $_SESSION['success'] = 'Berhasil melakukan peminjaman barang dan monitoring, stok diperbarui';
            } else {
                $_SESSION['error'] = 'Berhasil melakukan peminjaman barang, tetapi gagal memperbarui stok: ' . mysqli_error($con);
            }
        } else {
            $_SESSION['error'] = 'Berhasil melakukan peminjaman barang, tetapi gagal melakukan monitoring: ' . mysqli_error($con);
        }
    } else {
        $_SESSION['error'] = 'Gagal melakukan peminjaman barang: ' . mysqli_error($con);
    }

    header('Location: ../?peminjaman');
    exit;
}
