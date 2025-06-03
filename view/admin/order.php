<?php
require("../check/check_ql_don.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM hoadon";
$query = mysqli_query($conn, $sql);
?>
<style>
table {
    width: 100%;
    max-width: 1500px;
    overflow-x: auto;
    white-space: nowrap;
}
</style>
<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="add-donhang.php" class="btn btn-success">+ Thêm đơn hàng</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Mã Đơn Hàng</th>
                    <th>Mã Khách hàng</th>
                    <th>Tên Khách hàng</th>
                    <th>Ngày Đặt</th>
                    <th>Địa Chỉ</th>
                    <th>Phương Thức Thanh Toán</th>
                    <th>Phương Thức Vận Chuyển</th>
                    <th>Trạng Thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="orderTable">
                <?php while ($acc = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td><?php echo $acc['MA_HD'] ?></td>
                        <td><?php echo $acc['MA_KH'] ?></td>
                        <td><?php echo $acc['TEN_NN'] ?></td>
                        <td><?php echo $acc['NGAY_HD'] ?></td>
                        <td><?php echo $acc['DIACHI_NN'] ?></td>

                        <td>
                            <?=
                            ($acc['MA_PTVC'] == 1) ? 'Giao hàng tiêu chuẩn' : (($acc['MA_PTVC'] == 2) ? 'Giao hàng nhanh' : (($acc['MA_PTVC'] == 3) ? 'Giao hàng tiết kiệm' : (($acc['MA_PTVC'] == 4) ? 'Giao hàng quốc tế' : 'Không xác định')))
                            ?>
                        </td>
                        <td>
                            <?= ($acc['MA_PTTT'] == 1) ? 'Giao hàng tiêu chuẩn' : 'LỖI' ?>
                        </td>
                        <td>
                            <?=
                            $acc['TRANGTHAI'] == 1 ? 'Chờ Xử Lý' : ($acc['TRANGTHAI'] == 2 ? 'Đang Giao' : ($acc['TRANGTHAI'] == 3 ? 'Hoàn Tất' : ($acc['TRANGTHAI'] == 4 ? 'Đã Huỷ' : 'Không xác định')))
                            ?>
                        <td>
                            <a href="edit-donhang.php?MA_HD=<?php echo $acc['MA_HD'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i> Sửa</a>
                            <a href="delete-donhang.php?MA_HD=<?php echo $acc['MA_HD'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash3-fill"></i> Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>