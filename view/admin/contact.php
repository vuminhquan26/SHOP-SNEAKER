<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$sql = "SELECT * FROM lienhe";
$result = mysqli_query($conn, $sql);

?>

<div class="container mt-4">
    <h2>Danh sách liên hệ</h2>
    <a href="contact-add.php" class="btn btn-primary mb-3">Thêm liên hệ</a>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['MA_LH'] ?></td>
                    <td><?= $row['TEN_LH'] ?></td>
                    <td>
                        <a href="contact-edit.php?MA_LH=<?= $row['MA_LH'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="contact-delete.php?MA_LH=<?= $row['MA_LH'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa liên hệ này?');">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
</div>