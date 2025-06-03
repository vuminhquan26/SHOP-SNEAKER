<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM quantri";
$query = mysqli_query($conn, $sql);
?>

<body>
    <!-- Main Content -->
    <div id="page-content" class="w-100">
        <nav class="navbar navbar-light bg-light px-4">
            <span class="navbar-brand mb-0 h1">Quản lý Admin</span>
        </nav>

        <div class="container mt-4">
            <div class="d-flex justify-content-end mb-3">
                <a href="add-admin.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Thêm Admin</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Tài Khoản</th>
                        <th>Vai Trò</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['TAIKHOAN'] ?></td>
                            <td><?php echo $row['VAITRO'] ?></td>
                            <td><?php echo $row['TRANGTHAI'] ?></td>
                            <td>
                                <a href="edit-admin.php?TAIKHOAN=<?php echo $row['TAIKHOAN'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i> Sửa</a>
                                <a href="delete-admin.php?TAIKHOAN=<?= $row['TAIKHOAN'] ?>" class="btn btn-danger btn-sm">
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