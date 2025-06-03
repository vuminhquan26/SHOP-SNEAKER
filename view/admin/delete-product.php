<?php
require_once("../check/check_ql_kho.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$id = !empty($_GET['MA_SP']) ? intval($_GET['MA_SP']) : 0;

if ($id > 0) {
    // Xóa các bản ghi trong giohang có mã sản phẩm này
    $sql1 = "DELETE FROM giohang WHERE MA_SP = '$id'";
    mysqli_query($conn, $sql1);
    $sql = "DELETE FROM sanpham WHERE MA_SP = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('Xoa san pham thanh cong!');
            window.location.href = 'admin_product.php'; // ve trang danh sach
        </script>";
    } else {
        echo "<script>
            alert('Xoa that bai!');
            window.history.back(); // quay lai trang truoc
        </script>";
    }
} else {
    echo "<script>
        alert('Khong co ma san pham hop le!');
        window.history.back();
    </script>";
}

mysqli_close($conn);
?>
