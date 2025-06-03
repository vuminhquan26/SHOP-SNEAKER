<?php
ob_start();
require("../check/check_user.php");
include_once("../layout/header.php");
include_once("../../config/config.php");

$user_id = $_SESSION['user_id'];

// XỬ LÝ FORM POST (CẬP NHẬT hoặc XÓA)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_sp = $_POST['ma_sp'];
    $size = $_POST['size'];
    $action = $_POST['action'];

    if ($action === 'update') {
        $soluong = (int)$_POST['soluong'];
        if ($soluong > 0) {
            $sql_update = "UPDATE giohang 
                           SET SO_LUONG = $soluong 
                           WHERE MA_SP = '$ma_sp' AND MA_KH = '$user_id' AND ma_kc = '$size'";
            if (!mysqli_query($conn, $sql_update)) {
                die("Lỗi cập nhật giỏ hàng: " . mysqli_error($conn));
            }
        }
    } elseif ($action === 'delete') {
        $sql_delete = "DELETE FROM giohang 
                       WHERE MA_SP = '$ma_sp' AND MA_KH = '$user_id' AND ma_kc = '$size'";
        if (!mysqli_query($conn, $sql_delete)) {
            die("Lỗi xóa giỏ hàng: " . mysqli_error($conn));
        }
    }
    header("Location: cart.php");
    exit;
}

// LẤY DỮ LIỆU GIỎ HÀNG ĐỂ HIỂN THỊ
$sql = "SELECT giohang.*, sanpham.TEN_SP, sanpham.ANH_GIOI_THIEU, sanpham.GIA_MOI
        FROM giohang 
        JOIN sanpham ON giohang.MA_SP = sanpham.MA_SP
        WHERE giohang.MA_KH = '$user_id'";
$result = mysqli_query($conn, $sql);
?>
<style>
    .product-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 5px;
    }
</style>

<body>

    <main>
    <div class="container mt-4">
    <h2 class="text-center">Giỏ Hàng</h2>

    <form method="post" id="cartForm">
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_price = 0;
                $ma_giohang = null;

                while ($row = mysqli_fetch_assoc($result)) {
                    $tong = $row['GIA_MOI'] * $row['SO_LUONG'];
                    $total_price += $tong;
                    if (!$ma_giohang) $ma_giohang = $row['MA_GIOHANG'];
                ?>
                    <tr>
                        <td><img src="/PRJ/<?php echo $row['ANH_GIOI_THIEU']; ?>" class="product-thumbnail" alt="Product Image"></td>
                        <td><?php echo $row['TEN_SP']; ?></td>
                        <td><?php echo $row['ma_kc']; ?></td>
                        <td>
                            <input type="hidden" name="ma_sp" value="<?php echo $row['MA_SP']; ?>">
                            <input type="hidden" name="size" value="<?php echo $row['ma_kc']; ?>">
                            <input type="number" name="soluong" value="<?php echo $row['SO_LUONG']; ?>" min="1" style="width:70px;" required>
                        </td>
                        <td><?php echo number_format($row['GIA_MOI'], 0, ',', '.') . ' VND'; ?></td>
                        <td><?php echo number_format($tong, 0, ',', '.') . ' VND'; ?></td>
                        <td>
                            <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Cập nhật</button>
                            <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>

    <div class="text-end">
        <h4 style="color: white;">Tổng cộng: <?php echo number_format($total_price, 0, ',', '.') . ' VND'; ?></h4>
        <?php if ($ma_giohang): ?>
            <a href="bill.php?MA_GIOHANG=<?= $ma_giohang ?>" class="btn btn-success">Thanh toán</a>
        <?php endif; ?>
    </div>
</div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    // Thông báo nếu có thể thêm swal thành công (nếu muốn)
    if (isset($_GET['updated'])) {
        echo "<script>Swal.fire('Thành công', 'Cập nhật giỏ hàng thành công', 'success');</script>";
    }
    if (isset($_GET['deleted'])) {
        echo "<script>Swal.fire('Thành công', 'Xóa sản phẩm khỏi giỏ hàng thành công', 'success');</script>";
    }
    ?>
</body>

</html>
<script>
    function confirmAction(form) {
        if (form.action.value === 'delete') {
            return confirm('Bạn có chắc muốn xóa?');
        }
        return true; // update không cần confirm
    }
</script>