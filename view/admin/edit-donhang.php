<?php
require("../check/check_ql_don.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy mã đơn từ GET
$id = !empty($_GET['MA_HD']) ? intval($_GET['MA_HD']) : 0;

// Lấy dữ liệu đơn hàng từ DB
$sql = "SELECT * FROM hoadon WHERE MA_HD = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Xử lý cập nhật
$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_code = $_POST['ma_dh'];
    $customer_id = $_POST['ten_kh'];
    $address = $_POST['dia_chi'];
    $order_date = $_POST['ngay_dat_hang'];
    $status = $_POST['trang_thai'];

    $sql2 = "UPDATE hoadon 
             SET MA_HD = '$order_code', MA_KH = '$customer_id', DIACHI_NN = '$address', 
                 NGAY_HD = '$order_date', TRANGTHAI = '$status'
             WHERE MA_HD = $id";

    $result2 = mysqli_query($conn, $sql2);

    if ($result2) {
        $success = "Cập nhật đơn hàng thành công!";
        // Cập nhật lại $row để hiển thị dữ liệu mới
        $row = [
            'MA_HD' => $order_code,
            'MA_KH' => $customer_id,
            'DIACHI_NN' => $address,
            'NGAY_HD' => $order_date,
            'TRANGTHAI' => $status
        ];
    } else {
        $errors[] = "Cập nhật đơn hàng thất bại: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Sửa đơn hàng</h2>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="ma_dh" class="form-label">Mã đơn hàng</label>
            <input type="text" class="form-control" id="ma_dh" name="ma_dh" 
                   value="<?php echo ($row['MA_HD']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ten_kh" class="form-label">Mã khách hàng</label>
            <input type="text" class="form-control" id="ten_kh" name="ten_kh" 
                   value="<?php echo ($row['MA_KH']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="dia_chi" class="form-label">Địa chỉ nhận hàng</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" 
                   value="<?php echo ($row['DIACHI_NN']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="ngay_dat_hang" class="form-label">Ngày đặt hàng</label>
            <input type="date" class="form-control" id="ngay_dat_hang" name="ngay_dat_hang" 
                   value="<?php echo ($row['NGAY_HD']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select" id="trang_thai" name="trang_thai" required>
                <option value="1" <?php if ($row['TRANGTHAI'] == 1) echo 'selected'; ?>>Chờ xử lý</option>
                <option value="2" <?php if ($row['TRANGTHAI'] == 2) echo 'selected'; ?>>Đang giao</option>
                <option value="3" <?php if ($row['TRANGTHAI'] == 3) echo 'selected'; ?>>Hoàn tất</option>
                <option value="4" <?php if ($row['TRANGTHAI'] == 4) echo 'selected'; ?>>Đã hủy</option>
            </select>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="order.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
                    