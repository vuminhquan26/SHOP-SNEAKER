<?php
include_once("../layout/header.php");
include_once("../../config/config.php");
// Kiểm tra khi người dùng nhấn nút submit
if (isset($_SESSION['user_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
  echo "<script>
      Swal.fire({
      icon: 'warning',
      title: 'Bạn đã đăng nhập rồi!',
      text: 'Bạn muốn quay về trang chủ hay đăng xuất để đăng nhập tài khoản khác?',
      showCancelButton: true,
      confirmButtonText: 'Về trang chủ',
      cancelButtonText: 'Đăng xuất',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '../page/home.php';
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        window.location.href = '../user/logout.php';
      }
    });
  </script>";
}
if (isset($_POST['submit'])) {
  // Lấy dữ liệu từ form
  $email = $_POST['email'];
  $name = $_POST['hoten'];
  $sdt = $_POST['sdt'];  // Lấy số điện thoại
  $pass = $_POST['password'];  // Lấy mật khẩu
  $repass = $_POST['repassword'];  // Lấy mật khẩu nhập lại

  // Kiểm tra dữ liệu đầu vào
  if ($email == "" || $name == "" || $pass == "" || $repass == "" || $sdt == "") {
    echo "<script>
            Swal.fire({
            icon: 'warning',
            title: 'Thiếu thông tin!',
            text: 'Vui lòng nhập đầy đủ thông tin! Ví dụ email, mật khẩu, và số điện thoại.',
            confirmButtonText: 'OK'
            });
          </script>";
  }
  // Kiểm tra email đã tồn tại chưa
  else {
    $sql_check = "SELECT * FROM khachhang WHERE EMAIL = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if (mysqli_num_rows($result_check) > 0) {
      echo "<script>
              Swal.fire({
              icon: 'error',
              title: 'Email đã tồn tại!',
              text: 'Vui lòng sử dụng email khác.',
              confirmButtonText: 'OK'
              });
            </script>";
    }
    // Kiểm tra mật khẩu có khớp không
    else if ($pass != $repass) {
      echo "<script>
              Swal.fire({
              icon: 'error',
              title: 'Mật khẩu không khớp!',
              text: 'Vui lòng nhập lại mật khẩu chính xác.',
              confirmButtonText: 'Thử lại'
              });
            </script>";
    } 
    // Thực hiện lưu dữ liệu nếu mọi thứ hợp lệ
    else {
      // Mã hóa mật khẩu
      $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
      
      $sql_insert = "INSERT INTO khachhang (EMAIL, TEN_KH, PASS_KH, SDT_KH) VALUES ('$email', '$name', '$hashed_password', '$sdt')";
      $result_insert = mysqli_query($conn, $sql_insert);
      
      if ($result_insert) {
        echo "<script>
                Swal.fire({
                icon: 'success',
                title: 'Đăng ký thành công!',
                text: 'Bạn có thể đăng nhập ngay bây giờ.',
                confirmButtonText: 'OK'
                }).then(() => {
                  window.location.href = 'login.php'; // Điều hướng tới trang đăng nhập
                });
              </script>";
      } else {
        echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Đăng ký thất bại!',
                text: 'Có lỗi xảy ra trong quá trình xử lý.',
                confirmButtonText: 'Thử lại'
                });
              </script>";
      }
    }
  }
}
?>

<style>
  body {
    background-image: url('../../image/logo/brand_logo/backg.png');
    height: 100vh;
    margin: 0;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
  }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow p-4" style="width: 500px;">
    <h4 class="text-center mb-4">Đăng Ký</h4>
    <form method="POST" onsubmit="return validateForm()">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="hoten" class="form-label">Họ tên</label>
        <input type="text" class="form-control" id="hoten" name="hoten" required>
      </div>
      <div class="mb-3">
        <label for="sdt" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="sdt" name="sdt" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="repassword" class="form-label">Nhập Lại Mật khẩu</label>
        <input type="password" class="form-control" id="repassword" name="repassword" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-success" name="submit">Đăng Ký</button>
      </div>
    </form>
    <p class="text-center mt-3">
      Đã có tài khoản? <a href="login.php">Đăng nhập</a>
    </p>
  </div>
</div>
<script>
function validateForm() {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const rePassword = document.getElementById("repassword").value;
  const hoten = document.getElementById("hoten").value.trim();
  const sdt = document.getElementById("sdt").value.trim();

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/;
  const phonePattern = /^[0-9]{9,11}$/;
  const namePattern = /^([A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưỳỵỷỹ]+)(\s[A-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠƯỲỴÝỶỸ][a-zàáâãèéêìíòóôõùúăđĩũơưỳỵỷỹ]+)*$/;

  if (!emailPattern.test(email)) {
    alert("Email không hợp lệ.");
    return false;
  }

  if (!specialCharPattern.test(password)) {
    alert("Mật khẩu phải chứa ít nhất một ký tự đặc biệt.");
    return false;
  }

  if (password !== rePassword) {
    alert("Mật khẩu nhập lại không khớp.");
    return false;
  }

  if (!namePattern.test(hoten)) {
    alert("Họ tên phải viết hoa chữ cái đầu mỗi từ. Ví dụ: Nguyễn Văn A");
    return false;
  }

  if (!phonePattern.test(sdt)) {
    alert("Số điện thoại phải từ 9 đến 11 chữ số.");
    return false;
  }

  return true;
}
</script>
