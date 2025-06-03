<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if(isset($_GET["MANH_SP"])) {
    $ma_kh = $_GET["MANH_SP"];
    // Xóa tài khoản với id đó
    $sql = "DELETE FROM nhanhieu WHERE MANH_SP = $ma_kh";
    $sql_product = "DELETE FROM sanpham WHERE MANH_SP = $ma_kh";
    $query_product = mysqli_query($conn, $sql_product);
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã xoá nhãn hiệu thành công!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'brand.php';
            });
        </script>";
        exit();
    }else {
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
}?>