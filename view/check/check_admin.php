<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Không có quyền truy cập</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Truy cập bị từ chối',
                text: 'Bạn không có quyền truy cập trang quản trị.',
                confirmButtonText: 'Quay lại'
            }).then(() => {
                window.history.back(); // Quay lại trang trước
                // Hoặc: window.location.href = '../user/login.php';
            });
        </script>
    </body>
    </html>";
    exit;
}
?>
