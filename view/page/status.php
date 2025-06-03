<?php
require("../check/check_user.php");
include_once("../../config/config.php");

// Kiểm tra tham số mã hóa đơn truyền qua URL
if (!isset($_GET['MA_HD']) || empty($_GET['MA_HD'])) {
  echo "Mã đơn hàng không hợp lệ.";
  exit;
}
$ma_hd = $_GET['MA_HD'];

// Lấy mã khách hàng từ session
$ma_kh = $_SESSION['user_id'] ?? '';

if (empty($ma_kh)) {
  echo "Bạn chưa đăng nhập hoặc mã khách hàng không hợp lệ.";
  exit;
}

// Lấy thông tin hóa đơn thuộc về khách hàng này
$sql_hd = "SELECT * FROM hoadon WHERE MA_HD = '$ma_hd' AND MA_KH = '$ma_kh'";
$result_hd = mysqli_query($conn, $sql_hd);
if (!$result_hd || mysqli_num_rows($result_hd) == 0) {
  echo "Không tìm thấy đơn hàng hoặc đơn hàng không thuộc về bạn.";
  exit;
}
$donhang = mysqli_fetch_assoc($result_hd);

// Lấy tên phương thức thanh toán
$ma_pttt = $donhang['MA_PTTT'] ?? '';
$ten_pttt = "Chưa rõ phương thức thanh toán";
if ($ma_pttt !== '') {
  $sql_pttt = "SELECT TEN_PTTT FROM phuongthuc_tt WHERE MA_PTTT = '$ma_pttt'";
  $result_pttt = mysqli_query($conn, $sql_pttt);
  if ($result_pttt && mysqli_num_rows($result_pttt) > 0) {
    $row_pttt = mysqli_fetch_assoc($result_pttt);
    $ten_pttt = $row_pttt['TEN_PTTT'];
  }
}

// Lấy danh sách sản phẩm trong đơn hàng
$sql_sp = "SELECT ct.MA_SP, sp.TEN_SP, sp.ANH_GIOI_THIEU, ct.SO_LUONG, ct.SIZE_SP, ct.GIA 
           FROM ct_hoadon ct 
           JOIN sanpham sp ON ct.MA_SP = sp.MA_SP 
           WHERE ct.MA_HD = '$ma_hd'";

$result_sp = mysqli_query($conn, $sql_sp);

// Tính tổng tiền đơn hàng
$sql_tong = "SELECT SUM(ct.GIA * ct.SO_LUONG) AS tong_tien
             FROM ct_hoadon ct
             JOIN hoadon hd ON ct.MA_HD = hd.MA_HD
             WHERE ct.MA_HD = '$ma_hd' AND hd.MA_KH = '$ma_kh'";
$result_tong = mysqli_query($conn, $sql_tong);
$row_tong = mysqli_fetch_assoc($result_tong);
$tong_tien = $row_tong['tong_tien'] ?? 0;

// Hàm định dạng tiền VNĐ
function formatTien($tien)
{
  return number_format($tien, 0, ",", ".") . "₫";
}
?>
<?php include_once("../layout/header.php"); ?>
<main>

  <body class="bg-light">
    <div class="container mt-2">
      <h3 class="mb-4">Chi tiết đơn hàng #<?php echo($ma_hd); ?></h3>

      <table class="table bg-white shadow">
        <tbody>
          <tr>
            <th>Mã đơn hàng</th>
            <td>#<?php echo($donhang['MA_HD']); ?></td>
          </tr>
          <tr>
            <th>Ngày đặt</th>
            <td><?php echo(date("d/m/Y", strtotime($donhang['NGAY_HD']))); ?></td>
          </tr>
          <tr>
            <th>Ngày nhận dự kiến</th>
            <td>
              <?php
              echo !empty($donhang['NGAYNHAN']) ? date("d/m/Y", strtotime($donhang['NGAYNHAN'])) : "Chưa cập nhật";
              ?>
            </td>
          </tr>
          <tr>
            <th>Trạng thái</th>
            <td>
              <?php
              $tt = $donhang['TRANGTHAI'];
              if ($tt == 0) {
                echo '<span class="badge bg-warning text-dark">Đang xử lý</span>';
              } elseif ($tt == 1 || $tt == 2) {
                echo '<span class="badge bg-success">Hoàn thành</span>';
              } else {
                echo '<span class="badge bg-info">Trạng thái không xác định</span>';
              }
              ?>
            </td>
          </tr>
          <tr>
            <th>Hình thức thanh toán</th>
            <td>
              <?php
              if ($ten_pttt == "Thanh toán khi nhận hàng (COD)") {
                echo '<span class="text-primary">' . $ten_pttt . '</span>';
              } elseif ($ten_pttt == "Chuyển khoản") {
                echo '<span class="text-success">Đã thanh toán (' . $ten_pttt . ')</span>';
              } else {
                echo($ten_pttt);
              }
              ?>
            </td>
          </tr>
          <tr>
            <th>Sản phẩm</th>
            <td>
              <?php
              if ($result_sp && mysqli_num_rows($result_sp) > 0) {
                while ($sp = mysqli_fetch_assoc($result_sp)) {
              ?>
                  <div class="d-flex mb-3">
                    <img src="/PRJ/<?php echo($sp['ANH_GIOI_THIEU']); ?>" width="100" class="me-3 border rounded" alt="product">
                    <div>
                      <strong><?php echo($sp['TEN_SP']); ?></strong><br>
                      Giá: <?php echo formatTien($sp['GIA']); ?><br>
                      Số lượng: <?php echo($sp['SO_LUONG']); ?><br>
                      Size: <?php echo($sp['SIZE_SP']); ?><br>
                    </div>
                  </div>
              <?php
                }
              } else {
                echo "Chưa có sản phẩm nào trong đơn hàng.";
              }
              ?>
            </td>
          </tr>
          <tr>
            <th>Tổng cộng</th>
            <td><strong><?php echo formatTien($tong_tien); ?></strong></td>
          </tr>
          <tr>
            <th>Người nhận</th>
            <td><?php echo($donhang['TEN_NN']); ?></td>
          </tr>
          <tr>
            <th>Địa chỉ giao hàng</th>
            <td><?php echo($donhang['DIACHI_NN']); ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once("../layout/footer.php"); ?>
