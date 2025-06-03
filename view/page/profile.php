<?php
require("../check/check_user.php");
include_once("../layout/header.php");
include_once("../../config/config.php");

// Lấy mã khách hàng từ session
$MA_KH = $_SESSION['user_id'] ?? null;

// Khởi tạo biến thông tin người dùng mặc định
$user = [
  'TEN_KH' => '',
  'EMAIL' => '',
  'SDT_KH' => '',
  'DIACHI_KH' => '',
  'GIOITINH' => '',
  'NGAYSINH' => ''
];

// Nếu có mã khách hàng thì truy vấn thông tin
if ($MA_KH) {
  $sql = "SELECT TEN_KH, EMAIL, SDT_KH, DIACHI_KH, GIOITINH, NGAYSINH FROM KHACHHANG WHERE MA_KH = $MA_KH";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $user['TEN_KH'] = $row['TEN_KH'];
    $user['EMAIL'] = $row['EMAIL'];
    $user['SDT_KH'] = $row['SDT_KH'];
    $user['DIACHI_KH'] = $row['DIACHI_KH'];
    $user['GIOITINH'] = $row['GIOITINH'];
    $user['NGAYSINH'] = $row['NGAYSINH'];
  }
}
?>

<div class="container my-5 bg-white rounded shadow-sm">
  <div class="row">
    <!-- Sidebar -->
    <aside class="col-md-3 border-end">
      <h5 class="mt-4">Tài khoản của tôi</h5>
      <div class="list-group mt-3">
        <a href="profile.php" class="list-group-item list-group-item-action"><i class="bi bi-person-circle"></i> Hồ sơ</a>
        <a href="order_history.php" class="list-group-item list-group-item-action"><i class="bi bi-check-circle"></i> Lịch sử đơn hàng</a>
        <a href="repass.php?MA_KH=<?php echo $MA_KH ?>" class="list-group-item list-group-item-action"><i class="bi bi-key"></i> Đổi mật khẩu</a>
        <a href="../user/logout.php" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
      </div>
    </aside>
    <main class="col-md-9 p-4">
      <h2 class="text-success mb-4">Thông tin cá nhân</h2>
      <form method="post" action="#">
        <div class="mb-3">
          <label class="form-label">Họ và tên</label>
          <input type="text" name="TEN_KH" class="form-control" value="<?php echo($user['TEN_KH']); ?>" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="EMAIL" class="form-control" value="<?php echo($user['EMAIL']); ?>" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Số điện thoại</label>
          <input type="text" name="SDT_KH" class="form-control" value="<?php echo($user['SDT_KH']); ?>" readonly>
        </div>
        <div class="mb-3">
          <label class="form-label">Địa chỉ</label>
          <input type="text" name="DIACHI" class="form-control" value="<?php echo($user['DIACHI_KH']); ?>" readonly>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="GIOITINH" id="gtNam" value="0"
            <?php if ($user['GIOITINH'] === '0') echo 'checked'; ?> disabled>
          <label class="form-check-label" for="gtNam">Nam</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="GIOITINH" id="gtNu" value="1"
            <?php if ($user['GIOITINH'] === '1') echo 'checked'; ?> disabled>
          <label class="form-check-label" for="gtNu">Nữ</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="GIOITINH" id="gtKhac" value="2"
            <?php if ($user['GIOITINH'] === '2') echo 'checked'; ?> disabled>
          <label class="form-check-label" for="gtKhac">Khác</label>
        </div>


        <div class="mb-4">
          <label class="form-label">Ngày sinh</label>
          <input type="date" name="NGAYSINH" class="form-control" value="<?php echo($user['NGAYSINH']); ?>" readonly>
        </div>
        <a href="edit-profile.php" class="btn btn-warning"><i class="bi bi-pencil"></i> Sửa Thông Tin</a>
      </form>
    </main>
  </div>
</div>
<?php
include_once("../layout/footer.php");
?>