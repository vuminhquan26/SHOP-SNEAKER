<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if (isset($_GET['TAIKHOAN'])) {
    $taikhoan = $_GET['TAIKHOAN'];

    // Kiểm tra tài khoản có tồn tại
    $check = mysqli_query($conn, "SELECT * FROM quantri WHERE TAIKHOAN = '$taikhoan'");
    if (mysqli_num_rows($check) > 0) {
        $sql_delete = "DELETE FROM quantri WHERE TAIKHOAN = '$taikhoan'";
        if (mysqli_query($conn, $sql_delete)) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Đã xoá!',
                    text: 'Tài khoản đã được xoá thành công.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'list_admin.php';
                });
            </script>";
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Lỗi!',
                    text: 'Không thể xoá tài khoản.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Không tồn tại!',
                text: 'Tài khoản không tồn tại trong hệ thống.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'admin_list.php';
            });
        </script>";
    }
}
?>
