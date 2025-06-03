<?php
require("../check/check_ql_tk.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM khachhang";
$query = mysqli_query($conn, $sql);
?>
<style>
    body {
        overflow-x: hidden;
    }

    #wrapper {
        min-height: 100vh;
    }

    #sidebar {
        min-width: 250px;
    }

    .nav-link.active {
        background-color: #0d6efd;
        color: white !important;
    }
</style>

<body>

    <!-- Main Content -->
    <div id="page-content" class="w-100">
        <nav class="navbar navbar-light bg-light px-4">
            <span class="navbar-brand mb-0 h1">Quản lý người dùng</span>
        </nav>

        <div class="container mt-4">
            <div class="d-flex justify-content-end mb-3">
                <a href="add-user.php" class="btn btn-success"><i class="bi bi-plus-lg"></i> Thêm người dùng</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Giới tính</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php while ($acc = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $acc['MA_KH'] ?></td>
                            <td><?php echo $acc['TEN_KH'] ?></td>
                            <td><?php echo $acc['DIACHI_KH'] ?></td>
                            <td><?php echo $acc['SDT_KH'] ?></td>
                            <td><?php echo $acc['EMAIL'] ?></td>
                            <td><?php echo $acc['GIOITINH'] == 1 ? "Nam" : "Nu" ?></td>
                            <td>
                                <a href="edit-user.php?MA_KH=<?php echo $acc['MA_KH'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i> Sửa</a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $acc['MA_KH']; ?>)">
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

</html>
<script>
    function confirmDelete(ma_kh) {
        Swal.fire({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Hành động này không thể hoàn tác!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa"
        }).then((result) => {
            if (result.isConfirmed) {
                // Chuyển trang để thực hiện xóa
                window.location.href = "delete-user.php?MA_KH=" + ma_kh;
            }
        });
    }
</script>