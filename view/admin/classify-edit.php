<?php
require_once("../check/check_admin.php");

include_once("../../config/config.php");

// Kiểm tra tham số
if (isset($_GET['MAL_SP'])) {
    $id = (int)$_GET['MAL_SP']; // Ép kiểu tránh injection
    $sql = "SELECT * FROM loaisanpham WHERE MAL_SP = $id";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Lỗi truy vấn dữ liệu";
        exit;
    }
} else {
    echo "Mã sản phẩm không hợp lệ!";
    exit;
}

// Xử lý cập nhật
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_loaisp = $_POST['ten_loaisp'];
    $trangthai = $_POST['TRANGTHAI'];

    $sql = "UPDATE loaisanpham SET TEN_LOAISP = '$ten_loaisp', TRANGTHAI = '$trangthai' WHERE MAL_SP = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: classify.php");
        exit;
    } else {
        echo "Lỗi cập nhật dữ liệu";
    }
}
?>
<?php  include_once("../layout/sidebar.php"); ?>
<div class="container mt-4">
    <h2>Sửa loại sản phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label>Mã sản phẩm</label>
            <input type="text" class="form-control" value="<?= $row['MAL_SP'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label>Loại sản phẩm</label>
            <input type="text" name="ten_loaisp" class="form-control" value="<?php echo ($row['TEN_LOAISP']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Trạng Thái</label>
            <select name="TRANGTHAI" class="form-control" required>
                <option value="1" <?= $row['TRANGTHAI'] == 1 ? 'selected' : '' ?>>Còn Kinh Doanh</option>
                <option value="0" <?= $row['TRANGTHAI'] == 0 ? 'selected' : '' ?>>Ngừng Kinh Doanh</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>
