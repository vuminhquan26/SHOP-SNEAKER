<div class="menu">
    <ul>
        <li><a href="index.php">TRANG CHỦ</a></li>
        <li><a href="giay.php">GIÀY THỂ THAO</a></li>
        <li><a href="brand_list.php">THƯƠNG HIỆU</a></li>
        <li><a href="color_list.php">MÀU SẮC</a></li>
        <li><a href="gioithieu.php">GIỚI THIỆU</a></li>
        <li><a href="canhan.php">CÁ NHÂN</a></li>
        <li><a href="login.php">ĐĂNG NHẬP</a></li>
        <li><a href="register.php">ĐĂNG KÝ</a></li>
    </ul>
</div>
<hr>
<?php
include 'connect.php';
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM colors WHERE id=$id");
$row = mysqli_fetch_assoc($result);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $code = $_POST['code'];
    mysqli_query($conn, "UPDATE colors SET name='$name', code='$code' WHERE id=$id");
    header("Location: color_list.php");
}
?>
<h2>Sửa Màu sắc</h2>
<form method="POST">
    Tên màu: <input type="text" name="name" value="<?= $row['name'] ?>" required><br>
    Mã màu: <input type="color" name="code" value="<?= $row['code'] ?>" required><br>
    <button type="submit">Cập nhật</button>
</form>