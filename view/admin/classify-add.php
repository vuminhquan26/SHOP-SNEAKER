<?php
require_once("../check/check_admin.php");

include_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_loaisp = $_POST['TEN_LOAISP'];
    $trangthai = $_POST['TRANGTHAI'];

    $sql = "INSERT INTO loaisanpham (TEN_LOAISP, TRANGTHAI) VALUES ('$ten_loaisp', '$trangthai')";
    mysqli_query($conn, $sql);
    header("Location: classify.php");
    exit;
}
?>
<?php include_once("../layout/sidebar.php"); ?>
<div class="container mt-4">
    <h2>Thêm loại sản phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label>Tên loại sản phẩm</label>
            <input type="text" name="TEN_LOAISP" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="TRANGTHAI" class="form-label">Trạng Thái</label>
            <select class="form-control" id="TRANGTHAI" name="TRANGTHAI" required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="1">Còn Kinh Doanh</option>
                <option value="0">Ngừng Kinh Doanh</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>
