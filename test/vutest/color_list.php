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
$result = mysqli_query($conn, "SELECT * FROM colors");
?>
<h2>Danh sách Màu sắc</h2>
<a href="add_color.php">+ Thêm màu sắc</a>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Tên màu</th>
        <th>Mã màu</th>
        <th>Hành động</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><div style="width:20px;height:20px;background:<?= $row['code'] ?>"></div> <?= $row['code'] ?></td>
        <td>
            <a href="edit_color.php?id=<?= $row['id'] ?>">Sửa</a> | 
            <a href="delete_color.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá?')">Xoá</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>