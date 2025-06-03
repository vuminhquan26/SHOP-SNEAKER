<?php
session_start();
include_once("../layout/header.php");
include_once("../../config/config.php");
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
  $email = $_POST['email'];
  $pass = $_POST['password'];

  // ===== KIỂM TRA TÀI KHOẢN ADMIN =====
  $sql_admin = "SELECT * FROM quantri WHERE TAIKHOAN = '$email'";
  $result_admin = mysqli_query($conn, $sql_admin);

  if (mysqli_num_rows($result_admin) > 0) {
    $admin = mysqli_fetch_assoc($result_admin);
    // So sánh chuỗi thường
    if ($pass == $admin['MATKHAU']) {
      $_SESSION['user_id'] = $admin['TAIKHOAN'];
      $_SESSION['email'] = $admin['TAIKHOAN'];
      $_SESSION['role'] = $admin['VAITRO']; 
      switch($_SESSION['role']){
        case 1:
          echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              text: 'Xin chào Admin.',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = '../admin/admin.php';
            });
          </script>";
          break;
        case 2:
          echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              text: 'Xin chào Quản Lý Kho.',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = '../admin/admin_product.php';
            });
          </script>";
          break;
        case 3:
          echo "<script>
            Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              text: 'Xin chào Quản Lý Đơn.',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location.href = '../admin/order.php';
            });
          </script>";
          break;
        case 4:
            echo "<script>
              Swal.fire({
                icon: 'success',
                title: 'Đăng nhập thành công!',
                text: 'Xin chào Quản Lý Tài Khoản.',
                confirmButtonText: 'OK'
              }).then(() => {
                window.location.href = '../admin/user.php';
              });
            </script>";
            break;
      }
      
      exit;
    } else {
      echo "❌ Sai mật khẩu admin<br>";
    }
  }

  // ===== KIỂM TRA TÀI KHOẢN KHÁCH HÀNG =====
  $sql_user = "SELECT * FROM khachhang WHERE EMAIL = '$email'";
  $result_user = mysqli_query($conn, $sql_user);

  if (mysqli_num_rows($result_user) > 0) {
    $user = mysqli_fetch_assoc($result_user);
    if (password_verify($pass, $user['PASS_KH'])) {
      $_SESSION['user_id'] = $user['MA_KH'];
      $_SESSION['email'] = $user['EMAIL'];
      $_SESSION['role'] = 'user';
      echo "<script>
        Swal.fire({
          icon: 'success',
          title: 'Đăng nhập thành công!',
          text: 'Xin chào khách hàng.',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location.href = '../page/home.php';
        });
      </script>";
      exit;
    }
  }

  // ===== ĐĂNG NHẬP THẤT BẠI =====
  echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Đăng nhập thất bại!',
      text: 'Email hoặc mật khẩu không đúng.',
      confirmButtonText: 'Thử lại'
    });
  </script>";
}
?>



<style>
  body {
    background-image: url('../../image/logo/brand_logo/backg.png');
    /* đường dẫn tới ảnh */
    height: 100vh;
    /* chiều cao đúng bằng màn hình */
    margin: 0;
    background-size: cover;
    /* phủ kín mà không méo ảnh */
    background-position: center;
    background-repeat: no-repeat;
    overflow: hidden;
  }
</style>
<?php include_once("../layout/header.php"); ?>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow p-4" style="width: 400px;">
    <h4 class="text-center mb-4">Đăng Nhập</h4>
    <form method="post" action="login.php">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="submit">Đăng Nhập</button>
      </div>
    </form>
    <p class="text-center mt-3">
      Chưa có tài khoản? <a href="res.php">Đăng ký</a>
    </p>
  </div>
</div>