<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy tài khoản cần sửa từ URL
$id = $_GET['TAIKHOAN'] ?? '';

$sql = "SELECT * FROM quantri WHERE TAIKHOAN = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Nếu submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tk = $_POST['TAIKHOAN'];
    $vaitro = $_POST['VAITRO'];

    $sql_update = "UPDATE quantri SET VAITRO = '$vaitro' WHERE TAIKHOAN = '$tk'";
    $query_update = mysqli_query($conn, $sql_update);

    if ($query_update) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã cập nhật vai trò!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'list_admin.php'; // Đổi về trang danh sách admin phù hợp
            });
        </script>";
        exit();
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: 'Không thể cập nhật vai trò.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<div class="container mt-4">
    <h4 class="mb-3">Sửa Vai Trò Quản Trị</h4>
    <form method="POST">
        <table class="table table-bordered w-50">
            <tr>
                <th class="text-end align-middle">Tài khoản (email):</th>
                <td>
                    <input type="text" class="form-control" name="TAIKHOAN" value="<?= $row['TAIKHOAN'] ?>" readonly>
                </td>
            </tr>
            <tr>
                <th class="text-end align-middle">Vai trò:</th>
                <td>
                    <select name="VAITRO" class="form-control" required>
                        <option value="1" <?= $row['VAITRO'] == '1' ? 'selected' : '' ?>>Tổng Admin</option>
                        <option value="2" <?= $row['VAITRO'] == '2' ? 'selected' : '' ?>>Quản lý kho</option>
                        <option value="3" <?= $row['VAITRO'] == '3' ? 'selected' : '' ?>>Quản lý đơn hàng</option>
                        <option value="4" <?= $row['VAITRO'] == '4' ? 'selected' : '' ?>>Quản lý tài khoản</option>
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
