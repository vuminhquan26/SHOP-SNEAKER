<?php
require("../check/check_user.php");
include_once("../../config/config.php");
include_once("../layout/header.php"); // Header có import SweetAlert rồi
?>
<main>
<div class="container my-5 bg-white rounded shadow-sm">
  <div class="row">
    <!-- Sidebar -->
    <aside class="col-md-3 border-end">
      <h5 class="mt-4">Tài khoản của tôi</h5>
      <div class="list-group mt-3">
        <a href="profile.php" class="list-group-item list-group-item-action"><i class="bi bi-person-circle"></i> Hồ sơ</a>
        <a href="order_history.php" class="list-group-item list-group-item-action"><i class="bi bi-check-circle"></i> Lịch sử đơn hàng</a>
        <a href="repass.php?MA_KH=<?php echo $ma_kh  ?>" class="list-group-item list-group-item-action"><i class="bi bi-key"></i> Đổi mật khẩu</a>
        <a href="../user/logout.php" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
      </div>
    </aside>

    <!-- Form Đổi mật khẩu -->
    <main class="col-md-9 p-4">
      <h2 class="text-success mb-4">Đổi mật khẩu</h2>
      <form method="post" action="">
        <div class="mb-3">
          <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
          <input type="password" id="currentPassword" name="current_password" class="form-control" placeholder="Nhập mật khẩu hiện tại" required>
        </div>
        <div class="mb-3">
          <label for="newPassword" class="form-label">Mật khẩu mới</label>
          <input type="password" id="newPassword" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới" required>
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
          <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
      </form>
    </main>
  </div>
</div>
</main>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_kh = $_SESSION['user_id'] ?? null;
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$ma_kh || !$current_password || !$new_password || !$confirm_password) {
        echo "<script>
          Swal.fire({
            icon: 'warning',
            title: 'Thiếu thông tin',
            text: 'Vui lòng nhập đầy đủ thông tin.'
          }).then(() => { history.back(); });
        </script>";
        exit();
    }

    if ($new_password !== $confirm_password) {
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Mật khẩu không khớp',
            text: 'Xác nhận mật khẩu mới không đúng.'
          }).then(() => { history.back(); });
        </script>";
        exit();
    }

    // Lấy mật khẩu đã mã hóa từ database
    $sql = "SELECT PASS_KH FROM khachhang WHERE MA_KH = $ma_kh";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $hashed_current_password = $row['PASS_KH'];

        if (!password_verify($current_password, $hashed_current_password)) {
            echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Sai mật khẩu',
                text: 'Mật khẩu hiện tại không đúng.'
              }).then(() => { history.back(); });
            </script>";
            exit();
        }

        // Mã hóa mật khẩu mới
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE khachhang SET PASS_KH = '$hashed_new_password' WHERE MA_KH = $ma_kh";

        if (mysqli_query($conn, $update_sql)) {
            echo "<script>
              Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: 'Mật khẩu đã được cập nhật!'
              }).then(() => {
                window.location.href = 'profile.php';
              });
            </script>";
        } else {
            echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Lỗi hệ thống',
                text: 'Không thể cập nhật mật khẩu.'
              }).then(() => { history.back(); });
            </script>";
        }
    } else {
        echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Không tìm thấy người dùng',
            text: 'Vui lòng thử lại sau.'
          }).then(() => { history.back(); });
        </script>";
    }
}
?>

<?php include_once("../layout/footer.php"); ?>
