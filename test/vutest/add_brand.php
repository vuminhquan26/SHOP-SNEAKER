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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    mysqli_query($conn, "INSERT INTO brands (name) VALUES ('$name')");
    header("Location: brand_list.php");
}
?>
<h2>Thêm Thương hiệu</h2>
<form method="POST">
    Tên thương hiệu: <input type="text" name="name" required>
    <button type="submit">Lưu</button>
</form>