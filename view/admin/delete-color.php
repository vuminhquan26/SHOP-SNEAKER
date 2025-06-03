<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if(isset($_GET["MA_MS"])) {
    $code = $_GET["MA_MS"];
    
    // Xóa tài khoản với id đó
    $sql = "DELETE FROM mausac WHERE MA_MS = '$code'";
    $query = mysqli_query($conn, $sql);
    
    if ($query) {
        echo "
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã xoá khách hàng thành công!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'color.php';
            });
        </script>";
        exit();
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Thất bại!',
                text: 'Có Dữ Liệu Không Hợp Lệ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>
