<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM lienhe WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_loaisp = $_POST['ten_loaisp'];
    $trangthai = $_POST['trangthai'];
    $mal_sp = $_POST['mal_sp'];


    $sql = "UPDATE loaisanpham   SET  mal_sp='$mal_sp= ', trangthai='$trangthai',ten_loaisp ='$ten_loaisp' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location:   classify.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Sửa loại sản phẩm</h2>
    <form method="post">
        <div class="mb-3">
            <label> Mã sản phẩm</label>
            <input type="text" name="mal_sp" class="form-control" value="<?= htmlspecialchars($row['mal_sp']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Loại sản phẩm</label>
            <input type="text" name=" ten_loaisp" class="form-control" value="<?= htmlspecialchars($row['ten_loaisp']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Trạng Thái</label>
            <textarea name="trangthai" class="form-control" required><?= htmlspecialchars($row['trangthai']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>