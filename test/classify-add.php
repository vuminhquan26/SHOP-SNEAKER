<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_loaisp = $_POST['ten_loaisp'];
    $trangthai = $_POST['trangthai'];
    $mal_sp = $_POST['mal_sp'];

    $sql = "INSERT INTO  loaisanpham (mal_sp, ten_loaisp, trangthai) VALUES ('$mal_sp', '$ten_loáip', '$trangthai')";
    mysqli_query($conn, $sql);
    header("Location:  classify.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Thêm loại sản phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label>Mã sản phẩm</label>
            <input type="text" name="mal_sp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tên loại sản phẩm</label>
            <input type="text" name=" ten_loaisp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>trạng thái</label>
            <textarea name="trangthai" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>