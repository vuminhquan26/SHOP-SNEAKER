<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 1 && $_SESSION['role'] != 2)) {
    echo "<!DOCTYPE html>
    <html lang='vi'>
    <head>
        <meta charset='UTF-8'>
        <title>Không có quyền truy cập</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Bạn Không Có Quyền Truy Cập',
                text: 'Bạn muốn quay về trang trước hay đăng xuất để đăng nhập tài khoản khác?',
                showCancelButton: true,
                confirmButtonText: 'Về trang trước',
                cancelButtonText: 'Đăng xuất',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '../user/logout.php';
                }
                });
        </script>
    </body>
    </html>";
    exit;
}
?>
