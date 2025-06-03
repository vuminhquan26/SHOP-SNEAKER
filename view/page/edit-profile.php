<?php 
require("../check/check_user.php");

include_once("../../config/config.php");

// Lấy mã khách hàng từ session
$MA_KH = $_SESSION['user_id'] ?? null;

// Khởi tạo biến trống
$TEN_KH = $EMAIL = $SDT_KH = $DIACHI_KH = $GIOITINH = $NGAYSINH = "";

// Nếu có mã khách hàng -> lấy thông tin
if ($MA_KH) {
  $sql = "SELECT TEN_KH, EMAIL, SDT_KH, DIACHI_KH, GIOITINH, NGAYSINH FROM khachhang WHERE MA_KH = $MA_KH";
  $result = mysqli_query($conn, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $TEN_KH = $row['TEN_KH'];
    $EMAIL = $row['EMAIL'];
    $SDT_KH = $row['SDT_KH'];
    $DIACHI_KH = $row['DIACHI_KH'];
    $GIOITINH = $row['GIOITINH'];
    $NGAYSINH = $row['NGAYSINH'];
  }
}

// Xử lý cập nhật khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $TEN_KH = $_POST['hoten'];
  $EMAIL = $_POST['email'];
  $SDT_KH = $_POST['sdt'];
  $DIACHI_KH = $_POST['diachi'];
  $GIOITINH = $_POST['gender'];
  $NGAYSINH = $_POST['ngaysinh'];

  $update_sql = "UPDATE khachhang 
    SET TEN_KH = '$TEN_KH', EMAIL = '$EMAIL', SDT_KH = '$SDT_KH', DIACHI_KH = '$DIACHI_KH', 
        GIOITINH = '$GIOITINH', NGAYSINH = '$NGAYSINH' 
    WHERE MA_KH = $MA_KH";
  mysqli_query($conn, $update_sql);

  // Reload lại dữ liệu sau khi cập nhật
  header("Location: profile.php");
  exit();
}
?>
<?php include_once("../layout/header.php");  ?>
<div class="container my-5 bg-white rounded shadow-sm">
  <div class="row">
    <!-- Form thông tin cá nhân -->
    <main class="col-md-9 p-4">
      <h2 class="text-success mb-4">Sửa thông tin cá nhân</h2>
      <form method="post" action="">
        <div class="mb-3">
          <label class="form-label">Họ và tên</label>
          <input type="text" name="hoten" class="form-control" value="<?php echo $TEN_KH; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $EMAIL; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Số điện thoại</label>
          <input type="text" name="sdt" class="form-control" value="<?php echo $SDT_KH; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Địa chỉ</label>
          <input type="text" name="diachi" class="form-control" value="<?php echo $DIACHI_KH; ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Giới tính</label>
          <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gtNam" value="Nam" <?php if ($GIOITINH == 'Nam') echo 'checked'; ?>>
              <label class="form-check-label" for="gtNam">Nam</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gtNu" value="Nữ" <?php if ($GIOITINH == 'Nữ') echo 'checked'; ?>>
              <label class="form-check-label" for="gtNu">Nữ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gtKhac" value="Khác" <?php if ($GIOITINH == 'Khác') echo 'checked'; ?>>
              <label class="form-check-label" for="gtKhac">Khác</label>
            </div>
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label">Ngày sinh</label>
          <input type="date" name="ngaysinh" class="form-control" value="<?php echo $NGAYSINH; ?>">
        </div>
        <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Lưu Thay Đổi</button>
      </form>
    </main>
  </div>
</div>
<?php include_once("../layout/footer.php"); ?>
