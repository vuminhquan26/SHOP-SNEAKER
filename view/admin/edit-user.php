<?php
require("../check/check_ql_tk.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Khởi tạo biến mặc định
$ma_kh = "";
$ten_kh = "";
$diachi_kh = "";
$sdt_kh = "";
$gioitinh_kh = "";
$ngaysinh_kh = "";
$email_kh = "";
$tichdiem_kh = 0;

// Lấy mã khách từ GET hoặc POST
if (isset($_GET["MA_KH"])) {
    $ma_kh = $_GET["MA_KH"];
} elseif (isset($_POST["MA_KH"])) {
    $ma_kh = $_POST["MA_KH"];
}

// Nếu có mã khách thì lấy dữ liệu từ DB
if ($ma_kh != "") {
    $sql = "SELECT * FROM khachhang WHERE MA_KH = $ma_kh";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Gán dữ liệu ra từng biến
        $ten_kh = $row['TEN_KH'];
        $diachi_kh = $row['DIACHI_KH'];
        $sdt_kh = $row['SDT_KH'];
        $gioitinh_kh = $row['GIOITINH'];
        $ngaysinh_kh = $row['NGAYSINH'];
        $email_kh = $row['EMAIL'];
        $tichdiem_kh = $row['TICHDIEM'];
    }
}

// Nếu submit form thì tiến hành cập nhật
if (isset($_POST["submit"])) {
    $ten_kh = $_POST["TEN_KH"];
    $diachi_kh = $_POST["DIACHI_KH"];
    $sdt_kh = $_POST["SDT_KH"];
    $gioitinh_kh = $_POST["GIOITINH"];
    $ngaysinh_kh = $_POST["NGAYSINH"];
    $email_kh = $_POST["EMAIL"];
    $tichdiem_kh = $_POST["TICHDIEM"];

    $sql_edit = "UPDATE khachhang 
        SET TEN_KH = '$ten_kh',
            DIACHI_KH = '$diachi_kh',
            SDT_KH = '$sdt_kh',
            GIOITINH = '$gioitinh_kh',
            NGAYSINH = '$ngaysinh_kh',
            EMAIL = '$email_kh',
            TICHDIEM = $tichdiem_kh
        WHERE MA_KH = $ma_kh";

    $query_edit = mysqli_query($conn, $sql_edit);
    if ($query_edit) {
        echo "
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã sửa khách hàng thành công!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'user.php';
            });
        </script>";
        exit();
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Thất bại!',
                text: 'Có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<div class="container mt-4">
    <form action="edit-user.php" method="POST">
        <!-- MA_KH -->
        <div class="mb-3">
            <label for="MA_KH" class="form-label">Mã Khách Hàng</label>
            <input type="text" class="form-control" id="MA_KH" name="MA_KH" value="<?php echo $ma_kh ?>" readonly>
        </div>

        <!-- TEN_KH -->
        <div class="mb-3">
            <label for="TEN_KH" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="TEN_KH" name="TEN_KH" value="<?php echo $ten_kh ?>" required>
        </div>

        <!-- DIACHI_KH -->
        <div class="mb-3">
            <label for="DIACHI_KH" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="DIACHI_KH" name="DIACHI_KH" value="<?php echo $diachi_kh ?>" required>
        </div>

        <!-- SDT_KH -->
        <div class="mb-3">
            <label for="SDT_KH" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="SDT_KH" name="SDT_KH" value="<?php echo $sdt_kh ?>">
        </div>

        <!-- GIOITINH -->
        <div class="mb-3">
            <label for="GIOITINH" class="form-label">Giới tính</label>
            <select class="form-control" id="GIOITINH" name="GIOITINH">
                <option value="">-- Chọn giới tính --</option>
                <option value="1" <?php if ($gioitinh_kh == '1') echo 'selected'; ?>>Nam</option>
                <option value="0" <?php if ($gioitinh_kh == '0') echo 'selected'; ?>>Nữ</option>
                <option value="2" <?php if ($gioitinh_kh == '2') echo 'selected'; ?>>Khác</option>
            </select>
        </div>

        <!-- NGAYSINH -->
        <div class="mb-3">
            <label for="NGAYSINH" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="NGAYSINH" name="NGAYSINH" value="<?php echo $ngaysinh_kh ?>">
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label for="EMAIL" class="form-label">Email</label>
            <input type="email" class="form-control" id="EMAIL" name="EMAIL" value="<?php echo $email_kh ?>" required>
        </div>

        <!-- TICHDIEM -->
        <div class="mb-3">
            <label for="TICHDIEM" class="form-label">Tích điểm</label>
            <input type="number" class="form-control" id="TICHDIEM" name="TICHDIEM" value="<?php echo $tichdiem_kh ?>" min="0">
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Xác Nhận</button>
    </form>
</div>
