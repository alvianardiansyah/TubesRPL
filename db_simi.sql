-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Jun 2024 pada 11.20
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(0, 'Alvian ardiansyah', 'admin1', '$2y$10$zibmd5TCfK3N/U1mK2ZbDOpQdvn12jWU9iPgL2vKCbvdxu3z8XlWu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `id_merek` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `id_kondisi` int(11) NOT NULL,
  `jumlah_awal` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `keterangan_barang` varchar(255) NOT NULL,
  `tanggal_barang` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `id_merek`, `id_kategori`, `id_ruangan`, `id_kondisi`, `jumlah_awal`, `nama_barang`, `keterangan_barang`, `tanggal_barang`, `status`) VALUES
(94, 17, 2, 14, 1, '20', 'Komputer', 'Barang lama', '2019-01-01', 'unavailable'),
(95, 15, 2, 14, 1, '2', 'Infocus', 'Barang lama', '2019-01-01', 'available'),
(96, 10, 3, 17, 1, '2', 'Meja Rapat', 'Barang lama', '2019-04-01', 'unavailable'),
(97, 10, 14, 11, 1, '70', 'Kursi Mahasiswa', 'Barang lama', '2019-04-01', 'available'),
(98, 10, 14, 11, 1, '0', 'Meja Dosen', 'Barang lama', '2019-04-01', 'available'),
(99, 10, 14, 12, 2, '70', 'Kursi Mahasiswa', 'Beberapa kursi sudah tidak memiliki dudukan', '2019-04-01', 'available'),
(100, 10, 14, 12, 1, '1', 'Meja Dosen', 'Barang lama', '2019-04-01', 'available'),
(101, 10, 14, 13, 1, '40', 'Kursi Mahasiswa', 'Barang lama', '2019-04-01', 'available'),
(102, 10, 14, 13, 1, '1', 'Meja Dosen', 'Barang lama', '2019-04-01', 'available'),
(103, 21, 2, 11, 2, '1', 'AC', 'AC nya kurang dingin', '2019-01-01', 'unavailable'),
(104, 21, 2, 12, 3, '2', 'AC', 'Satu AC masih nyala namun kurang dingin\r\nsatunya kadang mau nyala kadang juga mati', '2019-01-01', 'unavailable'),
(105, 10, 7, 19, 1, '8', 'Sapu ', 'Barang lama', '2019-03-01', 'available'),
(106, 10, 7, 19, 1, '8', 'Alat Pel', 'Barang lama', '2019-03-01', 'available'),
(107, 24, 2, 19, 2, '2', 'Vacuum Cleaner', 'Kadang mati sendiri', '2019-01-01', 'available'),
(108, 17, 2, 15, 1, '20', 'Komputer', 'Barang lama', '2019-01-01', 'unavailable'),
(109, 17, 2, 16, 2, '20', 'Komputer', 'Ada barang yang baru', '2019-01-01', 'unavailable'),
(110, 7, 2, 15, 2, '1', 'Printer', 'Tintanya bocor', '2019-01-01', 'unavailable'),
(111, 7, 2, 14, 1, '1', 'Printer', 'Barang lama', '2019-01-01', 'unavailable'),
(112, 7, 2, 16, 1, '1', 'Printer', 'Barang lama', '2019-01-01', 'unavailable'),
(113, 17, 2, 17, 1, '1', 'Komputer', 'Barang lama', '2019-01-01', 'unavailable'),
(114, 17, 2, 20, 1, '1', 'Komputer', 'Barang lama', '2019-01-01', 'unavailable'),
(115, 10, 4, 17, 1, '5', 'Stapler', 'Barang lama', '2019-02-01', 'available'),
(116, 10, 14, 20, 1, '2', 'Kursi Panjang', 'Barang lama', '2019-04-01', 'available'),
(117, 23, 14, 17, 1, '2', 'Sofa', 'Barang lama', '2019-04-01', 'available'),
(118, 13, 2, 11, 2, '6', 'Lampu Ruangan', '2 buah lampu tidak menyala', '2019-01-01', 'unavailable'),
(119, 13, 2, 12, 2, '6', 'Lampu Ruangan', '2 buah lampu mati', '2019-01-01', 'unavailable'),
(120, 15, 2, 15, 2, '2', 'Infocus', 'Satu infocus tidak bisa menampilkan gambar', '2019-01-01', 'available'),
(121, 15, 2, 16, 1, '2', 'Infocus', 'Barang lama', '2019-01-01', 'available'),
(122, 12, 2, 17, 1, '1', 'Jam Dinding', 'Barang lama', '2019-01-01', 'unavailable'),
(123, 9, 4, 17, 2, '15', 'Spidol', 'yang tersisa tinggal 7, sisanya sudah tidak bisa di gunakan', '2019-02-01', 'unavailable'),
(124, 22, 4, 17, 1, '7', 'Kertas HVS', 'Tersisa 3 Rim', '2019-02-01', 'unavailable'),
(125, 22, 4, 17, 1, '8', 'Kertas Folio', 'Tersisa 4 Pak', '2019-02-01', 'unavailable'),
(126, 7, 2, 17, 1, '2', 'Printer', 'Barang lama', '2019-01-01', 'unavailable'),
(127, 14, 2, 17, 1, '1', 'TV', 'Barang lama', '2019-01-01', 'unavailable'),
(128, 11, 2, 20, 2, '1', 'Kipas Angin', 'Sudah tidak kencang putarannya', '2019-01-01', 'available'),
(129, 16, 2, 17, 2, '1', 'Speaker', 'Suaranya putus-putus', '2019-01-01', 'available'),
(130, 9, 4, 17, 1, '8', 'Pulpen', 'Tersisa 3 pak saja', '2019-02-01', 'unavailable'),
(131, 20, 2, 17, 1, '1', 'Wifi', 'Barang lama', '2019-01-01', 'unavailable'),
(132, 20, 2, 15, 1, '1', 'Wifi', 'Barang lama', '2019-01-01', 'unavailable'),
(133, 20, 2, 14, 1, '1', 'Wifi', 'Barang lama', '2019-01-01', 'unavailable'),
(134, 20, 2, 16, 1, '1', 'Wifi', 'Barang lama', '2019-01-01', 'unavailable'),
(135, 21, 2, 17, 1, '1', 'AC', 'Barang lama', '2019-01-01', 'unavailable'),
(136, 21, 2, 15, 2, '4', 'AC', '1 AC kurang dingin', '2020-01-01', 'unavailable'),
(137, 21, 2, 14, 2, '3', 'AC', '2 AC kurang dingin', '2020-01-01', 'unavailable'),
(138, 21, 2, 16, 3, '3', 'AC', '1 AC mati dan 2 AC kurang dingin', '2020-01-01', 'unavailable'),
(139, 15, 2, 14, 1, '2', 'Infocus', 'Barang lama', '2019-01-01', 'available');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `keterangan`) VALUES
(2, 'Alat Elektronik', 'barang barang eletronik'),
(3, 'Mebel', 'barang yang terbuat dari kayu'),
(4, 'ATK', 'alat-alat untuk keperluan ATK'),
(7, 'Alat Kebersihan', 'barang yang digunakan untuk bersih-bersih'),
(14, 'furniture', 'perabotan tambahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kondisi`
--

CREATE TABLE `tb_kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `nama_kondisi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kondisi`
--

INSERT INTO `tb_kondisi` (`id_kondisi`, `nama_kondisi`, `keterangan`) VALUES
(1, 'Baik', 'Barang bagus'),
(2, 'Rusak Ringan', 'barang barang rusak namun masih bisa dipake'),
(3, 'Rusak Berat', 'barang tidak dapat dipakai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_merek`
--

CREATE TABLE `tb_merek` (
  `id_merek` int(11) NOT NULL,
  `nama_merek` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_merek`
--

INSERT INTO `tb_merek` (`id_merek`, `nama_merek`, `keterangan`) VALUES
(7, 'Epson', 'merek printer'),
(9, 'Snowman', 'merek spidol dan pulpen'),
(10, 'Tidak Bermerek', 'tidak ada merek barang'),
(11, 'Cosmos', 'merek kipas angin'),
(12, 'Quartz', 'merek jam dinding'),
(13, 'Philip', 'merek lampu'),
(14, 'Lg', 'Merek tv'),
(15, 'Accer', 'merek infocus'),
(16, 'Advance', 'merek spiker'),
(17, 'Lenovo', 'merek komputer'),
(18, 'Robot', 'merek mouse'),
(20, 'indihome', 'merek wifi'),
(21, 'panasonic', 'merek ac'),
(22, 'SIDU', 'merek kertas HVS & folio'),
(23, 'Archipta', 'merek sofa'),
(24, 'Sharp', 'merek vacuum cleaner');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_monitoring`
--

CREATE TABLE `tb_monitoring` (
  `id_pinjam` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status_transaksi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_monitoring`
--

INSERT INTO `tb_monitoring` (`id_pinjam`, `id_barang`, `id_user`, `username`, `tanggal_pinjam`, `tanggal_kembali`, `jumlah`, `status_transaksi`) VALUES
(89, 95, 13, '', '2024-06-15', '2024-06-15', 1, 'dikembalikan'),
(90, 95, 12, '', '2024-06-15', '2024-06-15', 1, 'dikembalikan'),
(91, 98, 12, '', '2024-06-16', '2024-06-16', 1, 'dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_notification`
--

CREATE TABLE `tb_notification` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `is_read` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_notification`
--

INSERT INTO `tb_notification` (`id`, `username`, `message`, `type`, `created_at`, `is_read`) VALUES
(49, 'alvian12', 'Anda telah meminjam Sapu  pada tanggal 2024-06-15', 'peminjaman', '2024-06-15', 'unread'),
(50, 'E1E122129', 'Anda telah meminjam Infocus pada tanggal 2024-06-15', 'peminjaman', '2024-06-16', 'unread'),
(51, 'E1E122039', 'Anda telah meminjam Infocus pada tanggal 2024-06-15', 'peminjaman', '2024-06-16', 'unread'),
(52, 'E1E122039', 'Anda terlambat mengembalikan Infocus yang seharusnya dikembalikan pada tanggal 2024-06-15', 'pengembalian_terlambat', '2024-06-16', 'unread'),
(53, 'E1E122039', 'Anda telah meminjam Meja Dosen pada tanggal 2024-06-16', 'peminjaman', '2024-06-16', 'unread'),
(54, 'E1E122129', 'Anda terlambat mengembalikan Infocus yang seharusnya dikembalikan pada tanggal 2024-06-15', 'pengembalian_terlambat', '2024-06-16', 'unread');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `merek` varchar(25) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `kondisi` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_pinjam`, `id_barang`, `nama_barang`, `merek`, `kategori`, `kondisi`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `username`) VALUES
(91, 98, 'Meja Dosen', 'Tidak Bermerek', 'furniture', 'Baik', 1, '2024-06-16', '2024-06-16', 'E1E122039');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruangan`, `nama_ruangan`, `keterangan`) VALUES
(11, 'Ruang IT 1', 'ruangan belajar 1'),
(12, 'Ruang IT 2', 'ruangan belajar 2'),
(13, 'Ruang IT 3', 'ruangan belajar 3'),
(14, 'Lab Jaringan', 'ruangan laboratorium komputasi berbasis jaringan'),
(15, 'Lab CS & AI', 'ruangan laboratorium computer science & artificial inteligent'),
(16, 'Lab SE', 'laboratorium software enggineering'),
(17, 'Ruang Jurusan', 'untuk ruangan khusus dosen'),
(18, 'Ruang Aula', 'ruangan untuk pertemuan'),
(19, 'Gudang', 'Alat alat sarana dan prasarana'),
(20, 'Sekretariat HMTI', 'ruangan himpunan mahasiswa teknik informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jenis_transaksi` enum('masuk','keluar','pinjam') NOT NULL,
  `status` enum('belum','selesai') NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan_transaksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_barang`, `jenis_transaksi`, `status`, `jumlah`, `tanggal`, `keterangan_transaksi`) VALUES
(45, 96, 'masuk', 'selesai', '1', '2020-06-10', 'Pembelian baru'),
(46, 124, 'masuk', 'selesai', '12', '2020-02-01', 'Pembelian baru'),
(47, 109, 'masuk', 'selesai', '10', '2020-06-01', 'Barang hibah dari Lab Kom pusat'),
(48, 109, 'keluar', 'selesai', '8', '2020-06-01', 'Kondisinya jadi parah dimana rusak berat, tidak bisa menyala');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `no_hp_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `no_hp_user`, `username`, `password`) VALUES
(12, 'Alvian ardiansyah', '08123456789', 'E1E122039', '$2y$10$HzvaOpm7Fz469eJ7jVMpj.erB7sVOZwFXrokT5uUPN3QemT.poZmi'),
(13, 'Ngawal Muhamad', '08123456780', 'E1E122129', '$2y$10$j.DSrpcnac.ODuK/2VLiXu/WF9sIxTkYYnO5W0kfTpvG2exac65cm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_kondisi` (`id_kondisi`),
  ADD KEY `id_merek` (`id_merek`),
  ADD KEY `id_ruangan` (`id_ruangan`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_kondisi`
--
ALTER TABLE `tb_kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indeks untuk tabel `tb_merek`
--
ALTER TABLE `tb_merek`
  ADD PRIMARY KEY (`id_merek`);

--
-- Indeks untuk tabel `tb_monitoring`
--
ALTER TABLE `tb_monitoring`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indeks untuk tabel `tb_notification`
--
ALTER TABLE `tb_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_kondisi`
--
ALTER TABLE `tb_kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_merek`
--
ALTER TABLE `tb_merek`
  MODIFY `id_merek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_monitoring`
--
ALTER TABLE `tb_monitoring`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `tb_notification`
--
ALTER TABLE `tb_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD CONSTRAINT `tb_barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`),
  ADD CONSTRAINT `tb_barang_ibfk_2` FOREIGN KEY (`id_kondisi`) REFERENCES `tb_kondisi` (`id_kondisi`),
  ADD CONSTRAINT `tb_barang_ibfk_3` FOREIGN KEY (`id_merek`) REFERENCES `tb_merek` (`id_merek`),
  ADD CONSTRAINT `tb_barang_ibfk_4` FOREIGN KEY (`id_ruangan`) REFERENCES `tb_ruangan` (`id_ruangan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
