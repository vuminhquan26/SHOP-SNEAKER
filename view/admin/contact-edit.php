<?php
require_once("../check/check_admin.php");
include_once("../../config/config.php");

// Kiểm tra nếu có ID và là số hợp lệ (cột MA_LH là khóa chính)
if (isset($_GET['MA_LH']) && is_numeric($_GET['MA_LH'])) {
    $id = $_GET['MA_LH']; // Lấy ID từ URL

    // Truy vấn dữ liệu từ bảng lienhe theo MA_LH
    $sql = "SELECT * FROM lienhe WHERE MA_LH = $id";
    $result = mysqli_query($conn, $sql);

    // Nếu có dữ liệu
    if ($row = mysqli_fetch_assoc($result)) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_lh = $_POST['TEN_LH']; // Lấy dữ liệu từ form

            // Cập nhật cột TEN_LH
            $update_sql = "UPDATE lienhe SET TEN_LH = '$ten_lh' WHERE MA_LH = $id";
            if (mysqli_query($conn, $update_sql)) {
                header("Location: contact.php");
                exit;
            } else {
                echo "Có lỗi xảy ra trong quá trình cập nhật.";
            }
        }
    } else {
        echo "Không tìm thấy liên hệ với ID $id.";
        exit;
    }
} else {
    echo "ID không hợp lệ.";
    exit;
}
?>
<?php include_once("../layout/sidebar.php");?>
<div class="container mt-4">
    <h2>Sửa liên hệ</h2>
    <form method="post">
        <div class="mb-3">
            <label for="TEN_LH" class="form-label">Tên liên hệ</label>
            <input type="text" id="TEN_LH" name="TEN_LH" class="form-control" value="<?= $row['TEN_LH'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>
