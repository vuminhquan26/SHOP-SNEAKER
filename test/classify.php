<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy danh sách phân loại sản phẩm
$sql = "SELECT * FROM loaisanpham";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <h2>Danh sách phân loại sản phẩm</h2>
    <a href="classify-add.php" class="btn btn-primary mb-3">+ Thêm mới</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên phân loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>

                        <td><?= isset($row['id']) ? htmlspecialchars($row['id']) : 'Không có ID' ?></td>
                        <td><?= isset($row['ten_loaisp']) ? htmlspecialchars($row['ten_loaisp']) : 'Không có tên phân loại' ?></td>
                        <td>

                            <a href="classify-edit.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="classify-delete.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa phân loại này?');">Xóa</a>
                        </td>
                    </tr>
                <?php }
            } else { ?>

                <tr>
                    <td colspan="3" class="text-center">Không có phân loại sản phẩm nào.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>