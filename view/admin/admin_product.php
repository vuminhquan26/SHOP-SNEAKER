<?php
require("../check/check_ql_kho.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
// $id = $_GET['MA_SP'];
$sql = "SELECT * FROM sanpham";
$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
?>

<!-- Main content -->
<div id="page-content">
    <nav class="navbar navbar-light bg-light px-4">
        <span class="navbar-brand mb-0 h1">Quản lý sản phẩm</span>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            <a href="add-product.php" class="btn btn-success">+ Thêm sản phẩm</a>
        </div>

        <?php if (mysqli_num_rows($query) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                <form class="border p-3 mb-4 bg-light rounded">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label>Mã sản phẩm</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['MA_SP']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['TEN_SP']; ?>">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label>Thông tin sản phẩm</label>
                        <textarea class="form-control" rows="2" readonly><?php echo $row['THONGTIN_SP']; ?></textarea>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Ảnh giới thiệu</label><br>
                            <img src="<?php echo $row['ANH_GIOI_THIEU']; ?>" width="100">
                        </div>
                        <div class="col-md-4">
                            <label>Ảnh hover</label><br>
                            <img src="<?php echo $row['ANH_HOVER']; ?>" width="100">
                        </div>
                        <div class="col-md-4">
                            <label>Ảnh chi tiết 1</label><br>
                            <img src="<?php echo $row['ANH_CHI_TIET_1']; ?>" width="100">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Ảnh chi tiết 2</label><br>
                            <img src="<?php echo $row['ANH_CHI_TIET_2']; ?>" width="100">
                        </div>
                        <div class="col-md-4">
                            <label>Ảnh chi tiết 3</label><br>
                            <img src="<?php echo $row['ANH_CHI_TIET_3']; ?>" width="100">
                        </div>
                        <div class="col-md-4">
                            <label>Ảnh chi tiết 4</label><br>
                            <img src="<?php echo $row['ANH_CHI_TIET_4']; ?>" width="100">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Giá nhập</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['GIA_NHAP']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Giá cũ</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['GIA_CU']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Giá mới</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['GIA_MOI']; ?>">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label>Lượt bán</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['LUOT_BAN']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Ngày cập nhật</label>
                            <input type="text" class="form-control" readonly value="<?php echo $row['NGAY_CAPNHAT']; ?>">
                        </div>
                        <div class="col-md-4">
                            <label>Loại / Nhãn</label>
                            <input type="text" class="form-control" readonly value="Loại: <?php echo $row['MAL_SP']; ?> | Nhãn: <?php echo $row['MANH_SP']; ?>">
                        </div>
                    </div>
                </form>
                <td><a href="edit-product.php?MA_SP=<?php echo $row['MA_SP'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Sửa</a></td>
                <td><a href="delete-product.php?MA_SP=<?php echo $row['MA_SP'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Xoá</a></td>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-danger text-center">Không có dữ liệu</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
