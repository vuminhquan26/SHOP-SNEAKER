<?php
require("../check/check_ql_don.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy dữ liệu từ bảng phương thức vận chuyển và phương thức thanh toán
$sql_ptvc = "SELECT * FROM pt_vanchuyen";
$sql_pttt = "SELECT * FROM phuongthuc_tt";
$result_ptvc = mysqli_query($conn, $sql_ptvc);
$result_pttt = mysqli_query($conn, $sql_pttt);

// Khi người dùng bấm nút submit
if (isset($_POST["SUBMIT"])) {
    $TEN_NN = $_POST["TEN_NN"];
    $DIACHI_NN = $_POST["DIACHI_NN"];
    $TRANGTHAI = $_POST["TRANGTHAI"];
    $MA_KH = $_POST["MA_KH"];
    $SDT_KH = $_POST["SDT_KH"];
    $MA_PTVC = $_POST["MA_PTVC"];
    $MA_PTTT = $_POST["MA_PTTT"];

    // Câu truy vấn thêm vào bảng hoadon
    $SQL_INSERT = "INSERT INTO hoadon (NGAY_HD, TEN_NN, DIACHI_NN, TRANGTHAI, MA_KH, SDT_KH, MA_PTVC, MA_PTTT)
                   VALUES (NOW(), '$TEN_NN', '$DIACHI_NN', '$TRANGTHAI', '$MA_KH', '$SDT_KH', '$MA_PTVC', '$MA_PTTT')";

    $QUERY = mysqli_query($conn, $SQL_INSERT);

    if ($QUERY) {
        echo "
        <script>
            Swal.fire({
                title: 'THÀNH CÔNG!',
                text: 'ĐÃ THÊM ĐƠN HÀNG THÀNH CÔNG!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'order.php';
            });
        </script>";
        exit();
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'THẤT BẠI!',
                text: 'LỖI: " . mysqli_error($conn) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm Đơn Hàng</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="TEN_NN" class="form-label">TÊN NGƯỜI NHẬN:</label>
            <input type="text" class="form-control" id="TEN_NN" name="TEN_NN" required>
        </div>
        <div class="mb-3">
            <label for="DIACHI_NN" class="form-label">ĐỊA CHỈ NGƯỜI NHẬN:</label>
            <input type="text" class="form-control" id="DIACHI_NN" name="DIACHI_NN" required>
        </div>
        <div class="mb-3">
            <label for="TRANGTHAI" class="form-label">TRẠNG THÁI:</label>
            <select class="form-select" id="TRANGTHAI" name="TRANGTHAI" required>
                <option value="1">Chờ xử lý</option>
                <option value="2">Đang giao</option>
                <option value="3">Hoàn tất</option>
                <option value="4">Đã hủy</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="MA_KH" class="form-label">MÃ KHÁCH HÀNG:</label>
            <input type="text" class="form-control" id="MA_KH" name="MA_KH" required>
        </div>
        <div class="mb-3">
            <label for="SDT_KH" class="form-label">SỐ ĐIỆN THOẠI:</label>
            <input type="text" class="form-control" id="SDT_KH" name="SDT_KH" required>
        </div>
        <div class="mb-3">
            <label for="MA_PTVC" class="form-label">PHƯƠNG THỨC VẬN CHUYỂN:</label>
            <select class="form-select" id="MA_PTVC" name="MA_PTVC" required>
                <?php while ($row = mysqli_fetch_assoc($result_ptvc)) : ?>
                    <option value="<?php echo $row['MA_PTVC']; ?>"><?php echo $row['TEN_PTVC']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="MA_PTTT" class="form-label">PHƯƠNG THỨC THANH TOÁN:</label>
            <select class="form-select" id="MA_PTTT" name="MA_PTTT" required>
                <?php while ($row = mysqli_fetch_assoc($result_pttt)) : ?>
                    <option value="<?php echo $row['MA_PTTT']; ?>"><?php echo $row['TEN_PTTT']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" name="SUBMIT">THÊM ĐƠN HÀNG</button>
        </div>
    </form>
</div>
</body>
</html>
