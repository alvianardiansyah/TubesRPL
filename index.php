<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) :
    header("Location:" . $base_url . "login.php");
    exit();
else :
    include('config/header.php');
    session_timeout();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="icon" type="image/png" href="assets/img/SIMI1.png">
    </head>


    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php include "config/page.php"; ?>
            <?php include "config/sidebar.php"; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">
                    <?php include "config/topbar.php"; ?>

                    <?php if (isset($_SESSION['success'])) : ?>
                        <div class="flash-data-berhasil" data-berhasil="<?= $_SESSION['success']; ?>"></div>
                    <?php endif;
                    unset($_SESSION['success']); ?>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="flash-data-gagal" data-gagal="<?= $_SESSION['error']; ?>"></div>
                    <?php endif;
                    unset($_SESSION['error']); ?>
                    <?php include($views); ?>
                </div>
                <!-- End of Main Content -->
                <?php include "config/footer.php"; ?>

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->
    <?php endif; ?>
    </body>

    </html>