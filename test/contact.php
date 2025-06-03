<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$sql = "SELECT * FROM lienhe  ";
$result = mysqli_query($conn, $sql);

?>

<div class="container mt-4">
    <h2>Danh sách liên hệ</h2>
    <a href="contact-add.php" class="btn btn-primary mb-3">Thêm liên hệ</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nội dung</th>
                <th>Thời gian</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ten']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['noidung'])) ?></td>
                    <td><?= $row['thoigian'] ?></td>
                    <td>
                        <a href="contact-edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="contact-delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa liên hệ này?');">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
</div>