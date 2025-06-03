<?php
require("../check/check_user.php");
include_once("../../config/config.php");

$ma_kh = $_SESSION['user_id'];

// Thông tin khách hàng
$sql_kh = "SELECT * FROM khachhang WHERE MA_KH = $ma_kh";
$result_kh = mysqli_query($conn, $sql_kh);
$row_kh = mysqli_fetch_assoc($result_kh);

// Thông tin giỏ hàng
$sql_giohang = "
    SELECT giohang.MA_SP, giohang.SO_LUONG, giohang.ma_kc, sanpham.TEN_SP, sanpham.GIA_MOI
    FROM giohang
    JOIN sanpham ON giohang.MA_SP = sanpham.MA_SP
    WHERE giohang.MA_KH = $ma_kh
";
$result_giohang = mysqli_query($conn, $sql_giohang);
$ds_sanpham = [];
$total_price = 0;

while ($row = mysqli_fetch_assoc($result_giohang)) {
    $ds_sanpham[] = $row;
    $total_price += $row['SO_LUONG'] * $row['GIA_MOI'];
}

// Phương thức thanh toán
$sql_tt = "SELECT * FROM phuongthuc_tt";
$result_tt = mysqli_query($conn, $sql_tt);
$ds_tt = [];
while ($row = mysqli_fetch_assoc($result_tt)) {
    $ds_tt[] = $row;
}

// Phương thức vận chuyển
$sql_vc = "SELECT * FROM pt_vanchuyen";
$result_vc = mysqli_query($conn, $sql_vc);
$ds_vc = [];
while ($row = mysqli_fetch_assoc($result_vc)) {
    $ds_vc[] = $row;
}

// Xử lý submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ten_nguoinhan = $_POST['fullName'];
    $sdt = $_POST['phoneNumber'];
    $diachi = $_POST['address'];
    $ma_pttt = $_POST['pttt'];
    $ma_ptvc = $_POST['ptvc'];
    $ngaylap = date("Y-m-d H:i:s");

    // Thêm hóa đơn
    $sql_insert_hd = "INSERT INTO hoadon (NGAY_HD, TEN_NN, DIACHI_NN, SDT_KH, TRANGTHAI, MA_KH, MA_PTVC, MA_PTTT)
                      VALUES ('$ngaylap', '$ten_nguoinhan', '$diachi', '$sdt', 'Chờ xử lý', $ma_kh, $ma_ptvc, $ma_pttt)";
    mysqli_query($conn, $sql_insert_hd);
    $ma_hd = mysqli_insert_id($conn);

    // Thêm chi tiết hóa đơn
    foreach ($ds_sanpham as $sp) {
        $ma_sp = $sp['MA_SP'];
        $soluong = $sp['SO_LUONG'];
        $gia = $sp['GIA_MOI'];
        $size = $sp['ma_kc'];
        $thanhtien = $gia * $soluong;

        $sql_insert_cthd = "INSERT INTO ct_hoadon (MA_HD, MA_SP, SO_LUONG, SIZE_SP, GIA)
                            VALUES ($ma_hd, $ma_sp, $soluong, $size, $thanhtien)";
        mysqli_query($conn, $sql_insert_cthd);
    }

    // Xóa giỏ hàng
    mysqli_query($conn, "DELETE FROM giohang WHERE MA_KH = $ma_kh");

    header("Location: thankyou.php");
    exit();
}
?>

<?php include "../layout/header.php"; ?>
<style>
    form label{
        color: white;
    }
    form h4{
        color: white;
    }
</style>
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Thông tin thanh toán</h2>
    <form action="" method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fullName" class="form-label">Họ tên người nhận</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required value="<?php echo $row_kh['TEN_KH']; ?>">
            </div>
            <div class="col-md-6">
                <label for="phoneNumber" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required value="<?php echo $row_kh['SDT_KH']; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ giao hàng</label>
            <input type="text" class="form-control" id="address" name="address" required value="<?php echo $row_kh['DIACHI_KH']; ?>">
        </div>
        <div class-"mb-3">
            <label for="phonenumber" class="form-label">số điện thoại</label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" required value="
        </div>

        <h4 class="mt-4">Đơn hàng của bạn</h4>
        <ul class="list-group mb-3">
            <?php foreach ($ds_sanpham as $sp): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <?php echo $sp['TEN_SP']; ?> - Size <?php echo $sp['ma_kc']; ?> (x<?php echo $sp['SO_LUONG']; ?>)
                    </div>
                    <div>
                        <?php echo number_format($sp['SO_LUONG'] * $sp['GIA_MOI'], 0, ',', '.') . "đ"; ?>
                    </div>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between fw-bold">
                <span>Tổng cộng:</span>
                <span><?php echo number_format($total_price, 0, ',', '.') . "đ"; ?></span>
            </li>
        </ul>

        <h4 class="mt-4">Phương thức thanh toán</h4>
        <?php foreach ($ds_tt as $tt): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pttt" id="pttt_<?php echo $tt['MA_PTTT']; ?>" value="<?php echo $tt['MA_PTTT']; ?>" required>
                <label class="form-check-label" for="pttt_<?php echo $tt['MA_PTTT']; ?>">
                    <?php echo $tt['TEN_PTTT']; ?>
                </label>
            </div>
        <?php endforeach; ?>

        <h4 class="mt-4">Phương thức vận chuyển</h4>
        <?php foreach ($ds_vc as $vc): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="ptvc" id="ptvc_<?php echo $vc['MA_PTVC']; ?>" value="<?php echo $vc['MA_PTVC']; ?>" required>
                <label class="form-check-label" for="ptvc_<?php echo $vc['MA_PTVC']; ?>">
                    <?php echo $vc['TEN_PTVC']; ?>
                </label>
            </div>
        <?php endforeach; ?>

     

        <button type="submit" class="btn btn-primary mt-4 w-100">Xác nhận và thanh toán</button>
    </form>
</div>

<?php include "../layout/footer.php"; ?>
