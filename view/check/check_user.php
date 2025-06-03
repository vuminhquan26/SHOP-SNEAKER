<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <title>Thông báo</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Yêu Cầu Đăng Nhập',
                text: 'Bạn cần đăng nhập để truy cập trang này. Bạn muốn quay lại hay chuyển đến trang đăng nhập?',
                showCancelButton: true,
                confirmButtonText: 'Về trang trước',
                cancelButtonText: 'Đăng nhập',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '../user/login.php';
                }
            });
        </script>
    </body>
    </html>";
    exit;
}
