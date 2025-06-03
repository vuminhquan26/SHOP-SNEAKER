<?php
require_once("../check/check_admin.php");
include_once("../../config/config.php");

$id = $_GET['MAL_SP'];

// Kiểm tra nếu tồn tại id thì tiến hành xóa
if (isset($id)) {
    $sql = "DELETE FROM loaisanpham WHERE MAL_SP = $id";
    $sql_sp = "DELETE FROM sanpham WHERE MAL_SP = $id";
    mysqli_query($conn, $sql_sp);
    mysqli_query($conn, $sql);

    // Chuyển hướng sau khi xóa
    header("Location: classify.php");
    exit;
}
?>
<?php include_once("../layout/sidebar.php");?>