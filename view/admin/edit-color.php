<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy mã màu từ GET
$id = $_GET['MA_MS'] ?? '';

$sql = "SELECT * FROM mausac WHERE MA_MS = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Nếu form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_ms = $_POST['MA_MS'];
    $ten_ms = $_POST['TEN_MS'];

    $sql_update = "UPDATE mausac SET TEN_MS = '$ten_ms' WHERE MA_MS = '$ma_ms'";
    $query_update = mysqli_query($conn, $sql_update);

    if ($query_update) {
        echo "
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Đã cập nhật màu sắc!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'color.php';
            });
        </script>";
        exit();
    } else {
        echo "
        <script>
            Swal.fire({
                title: 'Lỗi!',
                text: 'Không thể cập nhật màu sắc.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>

<div class="container mt-4">
    <h4 class="mb-3">Sửa Màu Sắc</h4>
    <form method="POST">
        <table class="table table-bordered w-50">
            <tr>
                <th class="text-end align-middle">Mã màu:</th>
                <td>
                    <input type="text" class="form-control" name="MA_MS" value="<?= $row['MA_MS'] ?>" readonly>
                </td>
            </tr>
            <tr>
                <th class="text-end align-middle">Tên màu:</th>
                <td>
                    <input type="text" class="form-control" name="TEN_MS" value="<?= $row['TEN_MS'] ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="btn btn-primary"> Cập nhật</button>
                </td>
            </tr>
        </table>
    </form>
</div>
