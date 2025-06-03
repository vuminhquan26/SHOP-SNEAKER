<?php
require_once("../check/check_ql_don.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if (isset($_GET["MA_HD"])) {
    $ma_hd = $_GET["MA_HD"];

    // Xoá chi tiết hóa đơn trước (do có ràng buộc khóa ngoại)
    $sql_ct = "DELETE FROM ct_hoadon WHERE MA_HD = '$ma_hd'";
    $query_ct = mysqli_query($conn, $sql_ct);

    // Nếu xóa ct_hoadon thành công, tiếp tục xóa hoadon
    if ($query_ct) {
        $sql_hd = "DELETE FROM hoadon WHERE MA_HD = '$ma_hd'";
        $query_hd = mysqli_query($conn, $sql_hd);

        if ($query_hd) {
            echo "
            <script>
                Swal.fire({
                    title: 'Thành công!',
                    text: 'Đã xoá đơn hàng thành công!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'order.php';
                });
            </script>";
            exit();
        } else {
            echo "
            <script>
                Swal.fire({
                    title: 'Thất bại!',
                    text: 'Không thể xoá đơn hàng!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: 'Không thể xoá chi tiết đơn hàng!',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>
