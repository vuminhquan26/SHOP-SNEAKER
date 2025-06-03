<?php
require_once("../check/check_admin.php");
include_once("../../config/config.php");

$errors = [];
$success = "";

// Tạo thư mục nếu chưa tồn tại
$target_dir = "image/logo/brand_logo/";
if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
$allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

// Hàm xử lý upload ảnh
function upload_image($field, &$errors, $target_dir, $allowed_types) {
    if (!empty($_FILES[$field]['name'])) {
        $file_name = $_FILES[$field]['name'];
        $file_tmp = $_FILES[$field]['tmp_name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($file_name);

        if (in_array($file_type, $allowed_types) && $_FILES[$field]['size'] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                return $target_file;
            } else {
                $errors[] = "Lỗi khi upload $field.";
            }
        } else {
            $errors[] = "$field không đúng định dạng hoặc quá lớn.";
        }
    } else {
        $errors[] = "Chưa chọn $field.";
    }
    return "";
}

// Xử lý submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TEN_NH = $_POST['TEN_NH'];
    $TRANGTHAI = $_POST['TRANGTHAI'];
    $LOGO = upload_image('LOGO', $errors, $target_dir, $allowed_types);

    // Kiểm tra dữ liệu
    if (empty($TEN_NH)) $errors[] = "Tên nhãn hiệu không được để trống.";
    if ($TRANGTHAI !== "0" && $TRANGTHAI !== "1") $errors[] = "Trạng thái không hợp lệ.";

    if (count($errors) == 0) {
        $sql = "INSERT INTO nhanhieu (LOGO, TEN_NH, TRANGTHAI) VALUES ('$LOGO', '$TEN_NH', '$TRANGTHAI')";
        if (mysqli_query($conn, $sql)) {
            $success = "Thêm nhãn hiệu thành công!";
            header("Location: brand.php");
            exit;
        } else {
            $errors[] = "Lỗi khi thêm nhãn hiệu: " . mysqli_error($conn);
        }
    }
}
?>
<?php include_once("../layout/sidebar.php");?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Nhãn Hiệu</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $err) echo "<li>$err</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="LOGO">Logo Nhãn Hiệu</label>
                <input type="file" name="LOGO" class="form-control mb-3">
                <label for="TEN_NH" class="form-label">Tên Nhãn Hiệu</label>
                <input type="text" class="form-control" id="TEN_NH" name="TEN_NH" required>
            </div>
            <div class="mb-3">
                <label for="TRANGTHAI" class="form-label">Trạng Thái</label>
                <select class="form-control" id="TRANGTHAI" name="TRANGTHAI" required>
                    <option value="">-- Chọn trạng thái --</option>
                    <option value="1">Còn hợp tác</option>
                    <option value="0">Ngừng hợp tác</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Nhãn Hiệu</button>
        </form>
    </div>
</body>

