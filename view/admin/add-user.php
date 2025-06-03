<?php
require("../check/check_ql_tk.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$sql = "SELECT * FROM khachhang";

if (isset($_POST["submit"])) {
    // hứng dữ liệu nhập vào từ form
    $ten_kh = $_POST["TEN_KH"];
    $diachi_kh = $_POST["DIACHI_KH"];
    $sdt_kh = $_POST["SDT_KH"];
    $gioitinh_kh = $_POST["GIOITINH"];
    $ngaysinh_kh = $_POST["NGAYSINH"];
    $email_kh = $_POST["EMAIL"];
    $point = $_POST["TICHDIEM"];
    // lưu pass vào biến trung gian để mã hoá md5
    $pass_kh = $_POST["PASS_KH"];
    $pass_final = md5($pass_kh);
    // nhập dữu liệu vào database

    $sql_insert = "INSERT INTO khachhang(TEN_KH,DIACHI_KH,SDT_KH,GIOITINH,NGAYSINH,EMAIL,TICHDIEM,PASS_KH)
            VALUES('$ten_kh', '$diachi_kh', '$sdt_kh', '$gioitinh_kh', '$ngaysinh_kh', '$email_kh', '$point', '$pass_final')";
    $query = mysqli_query($conn, $sql_insert);
    
    if ($query) {
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
    }else {
        echo "
        <script>
            Swal.fire({
                title: 'Thất bại!',
                text: 'Có Dữ Liệu Không Hợp Lệ',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
    // Các icon hỗ trợ: "success", "error", "warning", "info", "question"
    // promt alert
    // Swal.fire({
    //     title: 'Nhập tên của bạn',
    //     input: 'text',
    //     inputPlaceholder: 'Tên của bạn ở đây...',
    //     showCancelButton: true
    //   }).then((result) => {
    //     if (result.isConfirmed) {
    //       Swal.fire(`Chào, ${result.value}!`);
    //     }
    //   });
    

?>
<div class="container mt-4">
    <form action="add-user.php" method="POST">
        <!-- TEN_KH -->
        <div class="mb-3">
            <label for="TEN_KH" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="TEN_KH" name="TEN_KH" required>
        </div>

        <!-- DIACHI_KH -->
        <div class="mb-3">
            <label for="DIACHI_KH" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="DIACHI_KH" name="DIACHI_KH" required>
        </div>

        <!-- SDT_KH -->
        <div class="mb-3">
            <label for="SDT_KH" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="SDT_KH" name="SDT_KH">
        </div>

        <!-- GIOITINH -->
        <div class="mb-3">
            <label for="GIOITINH" class="form-label">Giới tính</label>
            <select class="form-control" id="GIOITINH" name="GIOITINH">
                <option value="">-- Chọn giới tính --</option>
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
                <option value="2">Khác</option>
            </select>
        </div>

        <!-- NGAYSINH -->
        <div class="mb-3">
            <label for="NGAYSINH" class="form-label">Ngày sinh</label>
            <input type="date" class="form-control" id="NGAYSINH" name="NGAYSINH">
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label for="EMAIL" class="form-label">Email</label>
            <input type="email" class="form-control" id="EMAIL" name="EMAIL" required>
        </div>

        <!-- TICHDIEM -->
        <div class="mb-3">
            <label for="TICHDIEM" class="form-label">Tích điểm</label>
            <input type="number" class="form-control" id="TICHDIEM" name="TICHDIEM" value="0" min="0">
        </div>

        <!-- PASS_KH -->
        <div class="mb-3">
            <label for="PASS_KH" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="PASS_KH" name="PASS_KH" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Thêm người dùng</button>
    </form>
</div>