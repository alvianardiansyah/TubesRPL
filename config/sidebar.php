<?php
// Definisikan base_url
$base_url = '/inventory/';
?>
<style>
    .bg-gray {
        background-color: #6c757d;
        /* Warna abu-abu */
        background-image: none;
        /* Menghapus gradient */
    }

    .nav-item {
        margin-bottom: 2px;
        /* Atur jarak antar item menu */
    }

    .nav-link {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .collapse-inner .collapse-item {
        padding: 3px 10px;
    }
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-gray sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $base_url; ?>index.php">
        <div class="sidebar-brand-text mt-4">
            <img src="<?= $base_url; ?>assets/img/logo_TI3.png" alt="logo" style="height: 90px;">
        </div>
    </a>
    <br>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item <?= isset($home) ? 'active' : ''; ?>">
        <a class="nav-link" href="<?= $base_url; ?>index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <?php if (isset($_SESSION['role'])) : ?>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <!-- Nav Item - Notifikasi -->
            <li class="nav-item <?= isset($notifikasi) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>?notifikasi">
                    <i class="fas fa-bell fa-fw"></i>
                    <span>Notifikasi</span>
                </a>
            </li>
            <!-- Admin Specific Items -->
            <li class="nav-item <?= isset($inventaris) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>?barang">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Inventaris</span>
                </a>
            </li>

            <li class="nav-item <?= isset($transaksi) ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="transaksi" class="collapse <?= isset($transaksi) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= isset($barang_masuk) ? 'active' : ''; ?>" href="<?= $base_url; ?>?barang_masuk">Barang Masuk</a>
                        <a class="collapse-item <?= isset($barang_keluar) ? 'active' : ''; ?>" href="<?= $base_url; ?>?barang_keluar">Barang Keluar</a>
                        <a class="collapse-item <?= isset($monitoring) ? 'active' : ''; ?>" href="<?= $base_url; ?>?pinjam">Monitoring Peminjaman</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?= isset($laporan) ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Laporan</span>
                </a>
                <div id="laporan" class="collapse <?= isset($laporan) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= isset($lap_barang_masuk) ? 'active' : ''; ?>" href="<?= $base_url; ?>?lap_barang_masuk">Laporan Barang Masuk</a>
                        <a class="collapse-item <?= isset($lap_barang_keluar) ? 'active' : ''; ?>" href="<?= $base_url; ?>?lap_barang_keluar">Laporan Barang Keluar</a>
                        <a class="collapse-item <?= isset($lap_pinjam) ? 'active' : ''; ?>" href="<?= $base_url; ?>?lap_pinjam">Laporan Peminjaman</a>
                        <a class="collapse-item <?= isset($lap_barang) ? 'active' : ''; ?>" href="<?= $base_url; ?>?lap_barang">Laporan Data Inventaris</a>
                    </div>
                </div>
            </li>

        <?php elseif ($_SESSION['role'] == 'user') : ?>
            <!-- Nav Item - Notifikasi -->
            <li class="nav-item <?= isset($notifikasi) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>?notifikasi">
                    <i class="fas fa-bell fa-fw"></i>
                    <span>Notifikasi</span>
                </a>
            </li>
            <!-- User Specific Items -->
            <li class="nav-item <?= isset($profil) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>?profil">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>

            <li class="nav-item <?= isset($inventaris) ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= $base_url; ?>?barang">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Inventaris</span>
                </a>
            </li>

            <li class="nav-item <?= isset($transaksi) ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="transaksi" class="collapse <?= isset($transaksi) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= isset($pinjam) ? 'active' : ''; ?>" href="<?= $base_url; ?>?peminjaman">Peminjaman Barang</a>
                        <a class="collapse-item <?= isset($kembali) ? 'active' : ''; ?>" href="<?= $base_url; ?>?pengembalian">Pengembalian Barang</a>
                    </div>
                </div>
            </li>

        <?php endif; ?>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->