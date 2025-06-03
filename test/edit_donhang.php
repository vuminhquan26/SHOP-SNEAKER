<?php
include 'header.php';
include 'db.php';   
$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM donhang WHERE id = ?";
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);


$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_code = $_POST['ma_dh'];
    $name = $_POST['ten_kh'];
    $address = $_POST['dia_chi'];
    $phone = $_POST['so_dien_thoai'];
    $order_date = $_POST['ngay_dat_hang'];
    $status = $_POST['trang_thai'];
    $total_amount = $_POST['tong_tien'];
    $sql2 = "UPDATE donhang 
             SET ma_dh = '$order_code', ten_kh = '$name', dia_chi = '$address', 
                 so_dien_thoai = '$phone', ngay_dat_hang = '$order_date', 
                 trang_thai = '$status', tong_tien = '$total_amount'
             WHERE id = $id";
    $result = mysqli_query($conn, $sql2);

    if ($result) {
        header("Location: success.php");
        exit();
    } else {
        $errors[] = "Cập nhật đơn hàng thất bại: " . mysqli_error($conn);
    }
}

?>

<div class="container mt-5">
    <h2 class="text-center">Sửa đơn hàng</h2>
    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
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
            <input type="text" class="form-control" id="ma_dh" name="ma_dh" value="<?php echo htmlspecialchars($row['ma_dh']); ?>">
        </div>
        <div class="mb-3">
            <label for="ten_kh" class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" id="ten_kh" name="ten_kh" value="<?php echo htmlspecialchars($row['ten_kh']); ?>">
        </div>
        <div class="mb-3">
            <label for="dia_chi" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="<?php echo htmlspecialchars($row['dia_chi']); ?>">
        </div>
        <div class="mb-3">
            <label for="so_dien_thoai" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" value="<?php echo htmlspecialchars($row['so_dien_thoai']); ?>">
        </div>
        <div class="mb-3">
            <label for="ngay_dat_hang" class="form-label">Ngày đặt hàng</label>
            <input type="date" class="form-control" id="ngay_dat_hang" name="ngay_dat_hang" value="<?php echo htmlspecialchars($row['ngay_dat_hang']); ?>">
        </div>
        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <input type="text" class="form-control" id="trang_thai" name="trang_thai" value="<?php echo htmlspecialchars($row['trang_thai']); ?>">
        </div>
        <div class="mb-3">
            <label for="tong_tien" class="form-label">Tổng tiền</label>
            <input type="text" class="form-control" id="tong_tien" name="tong_tien" value="<?php echo htmlspecialchars($row['tong_tien']); ?>">
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="quanlydonhang.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
<?php
include 'footer.php';
mysqli_close($conn);
?>
