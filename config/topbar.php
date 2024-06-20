<!-- Topbar -->
<?php
include 'conn.php';
$username = $_SESSION['username'];

?>

<style>
    /* Style for marquee effect */
    .marquee-container {
        position: relative;
        overflow: hidden;
        height: 50px;
        width: 100%;
    }

    .marquee {
        display: inline-block;
        position: absolute;
        white-space: nowrap;
        will-change: transform;
        animation: marquee 15s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    .badge-counter {
        display: none;
    }
</style>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="marquee-container">
        <div class="navbar-brand font-weight-bold text-gray-800 marquee" style="font-size: 1.5rem;">
            SELAMAT DATANG DI SIMI - SISTEM INFORMASI MANAJEMEN INVENTARIS
        </div>
    </div>

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600 small"><?= strtoupper($_SESSION['username']); ?></span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php if ($_SESSION['role'] == 'user') : ?>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#gantiPasswordModal">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Ganti Password
                    </a>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                </a>
            </div>
        </li>

    </ul>
    <!-- Change Password Modal-->
    <div class="modal fade" id="gantiPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../process/ganti_password.php">
                        <div class="form-group">
                            <label for="currentPassword">Password Lama</label>
                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="ganti">Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</nav>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBell = document.getElementById('notificationBell');
        const badgeCounter = document.querySelector('.badge-counter');

        function fetchNotificationsCount() {
            fetch('get_notifications_count.php')
                .then(response => response.json())
                .then(data => {
                    badgeCounter.textContent = data.count;
                    if (data.count > 0) {
                        badgeCounter.style.display = 'inline-block';
                    } else {
                        badgeCounter.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching notification count:', error));
        }

        function markNotificationsAsRead() {
            fetch('mark_notifications_as_read.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        badgeCounter.style.display = 'none';
                        fetchNotificationsCount();
                    } else {
                        console.error('Error marking notifications as read');
                    }
                })
                .catch(error => console.error('Error marking notifications as read:', error));
        }

        fetchNotificationsCount();
        setInterval(fetchNotificationsCount, 60000);

        notificationBell.addEventListener('click', function() {
            markNotificationsAsRead();
        });
    });
</script>
<!-- End of Topbar -->