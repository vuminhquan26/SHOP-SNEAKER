<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Kiểm tra tham số MANH_SP hợp lệ
if (isset($_GET['MANH_SP']) && $_GET['MANH_SP'] != '') {
    $id = $_GET['MANH_SP'];
} else {
    echo "Mã thương hiệu không hợp lệ!";
    exit;
}

// Truy vấn dữ liệu hiện tại
$sql = "SELECT * FROM nhanhieu WHERE MANH_SP = $id";
$result = mysqli_query($conn, $sql);

// Kiểm tra dữ liệu
if ($result) {
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "Không tìm thấy thương hiệu!";
        exit;
    }
} else {
    echo "Lỗi truy vấn!";
    exit;
}


// Xử lý cập nhật khi submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_nh = $_POST['TEN_NH'];
    $trangthai = $_POST['TRANGTHAI'];

    $sql_update = "UPDATE nhanhieu SET TEN_NH = '$ten_nh', TRANGTHAI = '$trangthai' WHERE MANH_SP = $id";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>
            alert('Cập nhật thành công!');
            window.location.href = 'brand.php';
        </script>";
        exit;
    } else {
        echo "Lỗi cập nhật!";
    }
}
?>

<!-- Giao diện -->
<div class="container mt-4">
    <h4 class="mb-3">Sửa Thương Hiệu</h4>
    <form method="POST">
        <table class="table table-bordered w-50">
            <tr>
                <th class="text-end">Mã thương hiệu:</th>
                <td><input type="text" class="form-control" value="<?= $row['MANH_SP'] ?>" disabled></td>
            </tr>
            <tr>
                <th class="text-end">Tên thương hiệu:</th>
                <td><input type="text" class="form-control" name="TEN_NH" value="<?= $row['TEN_NH'] ?>" required></td>
            </tr>
            <tr>
                <th class="text-end">Trạng thái:</th>
                <td>
                    <select class="form-control" name="TRANGTHAI" required>
                        <option value="1" <?= $row['TRANGTHAI'] == 1 ? 'selected' : '' ?>>Còn hoạt động</option>
                        <option value="0" <?= $row['TRANGTHAI'] == 0 ? 'selected' : '' ?>>Ngừng hoạt động</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </td>
            </tr>
        </table>
    </form>
</div>
