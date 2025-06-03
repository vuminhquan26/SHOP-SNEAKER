<?php
require("../check/check_user.php");
include_once("../../config/config.php");

// Lấy mã khách hàng hiện tại từ session
$ma_kh = $_SESSION['user_id'];

// Truy vấn các hóa đơn của khách hàng
$sql = "SELECT hoadon.*, SUM(ct_hoadon.SO_LUONG * ct_hoadon.GIA) AS tong_tien
        FROM hoadon
        JOIN ct_hoadon ON hoadon.MA_HD = ct_hoadon.MA_HD
        WHERE hoadon.MA_KH = '$ma_kh'
        GROUP BY hoadon.MA_HD
        ORDER BY hoadon.NGAY_HD DESC";
$result = mysqli_query($conn, $sql);
?>

<?php include_once("../layout/header.php"); ?>
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

    <!-- Nội dung chính: Lịch sử mua hàng -->
    <main class="col-md-9 p-4">
      <h2 class="text-success mb-4">Lịch sử đơn hàng</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Ngày đặt</th>
            <th>Mã đơn</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id_hd = $row['MA_HD'];
              $ngaylap = $row['NGAY_HD'];
              $tongtien = $row['tong_tien'];
              $trangthai = $row['TRANGTHAI'];
          
              // Đặt badge theo trạng thái
              switch ($trangthai) {
                case 0:
                    $badge = '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                    break;
                case 1:
                    $badge = '<span class="badge bg-success">Hoàn thành</span>';
                    break;
                default:
                    $badge = '<span class="badge bg-secondary">Không rõ</span>';
                    break;
            }
            
          
              echo "<tr>";
              echo "<td>" . $ngaylap . "</td>";
              echo "<td>" . $id_hd . "</td>";
              echo "<td>₫" . number_format($tongtien, 0, ',', '.') . "</td>";
              echo "<td>" . $badge . "</td>";
              echo "<td><a href='status.php?MA_HD=" . $id_hd . "' class='btn btn-sm btn-outline-primary'>Xem</a></td>";
              echo "</tr>";
          }
          } else {
            echo "<tr><td colspan='5'>Bạn chưa có đơn hàng nào.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </main>
  </div>
</div>
</main>
<?php include_once("../layout/footer.php"); ?>
