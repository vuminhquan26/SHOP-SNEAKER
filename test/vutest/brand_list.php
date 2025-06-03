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
$result = mysqli_query($conn, "SELECT * FROM brands");
?>
<h2>Danh sách Thương hiệu</h2>
<a href="add_brand.php">+ Thêm thương hiệu</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Tên thương hiệu</th>
        <th>Hành động</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td>
            <a href="edit_brand.php?id=<?= $row['id'] ?>">Sửa</a> | 
            <a href="delete_brand.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>