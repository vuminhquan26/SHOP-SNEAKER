<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy danh sách phân loại sản phẩm
$sql = "SELECT * FROM nhanhieu";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Danh sách nhãn hiệu</h4>
        <a href="add-brand.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm mới
        </a>
    </div>

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên nhãn hiệu</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?=  ($row['MANH_SP']) ?></td>
                        <td><?=  ($row['TEN_NH']) ?></td>
                        <td>
                            <a href="edit-brand.php?MANH_SP=<?= $row['MANH_SP'] ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-fill"></i> Sửa
                            </a>
                            <a href="delete-brand.php?MANH_SP=<?= $row['MANH_SP'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa nhãn hiệu này này?');">
                                <i class="bi bi-trash-fill"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Không có phân loại sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
