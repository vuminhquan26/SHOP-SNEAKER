<?php
require("../check/check_ql_tk.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if(isset($_GET["MA_KH"])) {
    $ma_kh = $_GET["MA_KH"];
    // Xóa tài khoản với id đó
    $sql = "DELETE FROM khachhang WHERE MA_KH = $ma_kh";
    $sql_fb = "DELETE FROM feedback WHERE MA_KH = $ma_kh";

    $query = mysqli_query($conn, $sql_fb);
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
                window.location.href = 'user.php';
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