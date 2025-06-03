<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM mausac";
$query = mysqli_query($conn, $sql);
?>

<body>
    <!-- Main Content -->
    <div id="page-content" class="w-100">
        <nav class="navbar navbar-light bg-light px-4">
            <span class="navbar-brand mb-0 h1">Quản lý màu sắc</span>
        </nav>

        <div class="container mt-4">
            <div class="d-flex justify-content-end mb-3">
                <a href="add-color.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Thêm màu sắc</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Màu Sắc</th>
                        <th>Tên Màu Sắc</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['MA_MS'] ?></td>
                            <td><?php echo $row['TEN_MS'] ?></td>
                            <td><?php echo $row['TRANGTHAI'] ?></td>
                            <td>
                                <a href="edit-color.php?MA_MS=<?php echo $row['MA_MS'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i> Sửa</a>
                                <a href="delete-color.php?MA_MS=<?= $row['MA_MS'] ?>" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $row['MA_MS']; ?>)">
                                    <i class="bi bi-trash3-fill"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>