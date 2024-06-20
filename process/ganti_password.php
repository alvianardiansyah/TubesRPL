<?php
session_start();
include '../config/conn.php';
$base_url = '/inventory/';

if (!isset($_SESSION['username'])) {
    header('Location:../login.php');
    exit();
}

if (isset($_POST['ganti'])) {
    $username = $_SESSION['username'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Fetch the current password from the database
    $stmt = $con->prepare("SELECT password FROM tb_user WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($currentPassword, $user['password'])) {
        if ($newPassword == $confirmPassword) {
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the new password in the database
            $updateStmt = $con->prepare("UPDATE tb_user SET password = ? WHERE username = ?");
            $updateStmt->bind_param('ss', $hashedNewPassword, $username);

            if ($updateStmt->execute()) {
                $_SESSION['success'] = 'Password berhasil diubah.';
            } else {
                $_SESSION['error'] = 'Gagal mengubah password. Silakan coba lagi.';
            }
            $updateStmt->close();
        } else {
            $_SESSION['error'] = 'Password baru dan konfirmasi password tidak cocok.';
        }
    } else {
        $_SESSION['error'] = 'Password lama salah.';
    }
}

header('Location:../?home');
exit();
?>
<script src="<?= $base_url; ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= $base_url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base_url; ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= $base_url; ?>assets/js/sb-admin-2.min.js"></script>