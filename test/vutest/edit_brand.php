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
$result = mysqli_query($conn, "SELECT * FROM brands WHERE id=$id");
$row = mysqli_fetch_assoc($result);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    mysqli_query($conn, "UPDATE brands SET name='$name' WHERE id=$id");
    header("Location: brand_list.php");
}
?>
<h2>Sửa Thương hiệu</h2>
<form method="POST">
    Tên thương hiệu: <input type="text" name="name" value="<?= $row['name'] ?>" required>
    <button type="submit">Cập nhật</button>
</form>