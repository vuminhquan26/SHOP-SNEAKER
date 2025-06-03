<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $repass = $_POST['repassword'];
    $phanquyen = $_POST['phanquyen'];

    // Kiểm tra mật khẩu khớp nhau
    if ($pass !== $repass) {
        echo "<div class='alert alert-danger text-center'>Mật khẩu và nhập lại mật khẩu không khớp!</div>";
    } else {


        // Thêm tài khoản admin
        $sql = "INSERT INTO quantri (TAIKHOAN, MATKHAU, VAITRO)
                VALUES ('$email', '$pass', $phanquyen)";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center'>Thêm quản trị viên thành công!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Lỗi: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!-- Giao diện form thêm tài khoản admin -->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="width: 500px;">
        <div class="form-admin">

            <h2 class="mb-3">Thêm tài khoản admin</h2>
            
            <form method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">Email / Tài khoản</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="repassword" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" required>
                </div>
                
                <div class="mb-3">
                    <label for="phanquyen" class="form-label">Phân quyền</label>
                    <select name="phanquyen" id="phanquyen" class="form-control" required>
                        <option value="1">Tổng Admin</option>
                        <option value="2">Quản lý kho</option>
                        <option value="3">Quản lý đơn hàng</option>
                        <option value="4">Quản lý tài khoản</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>
