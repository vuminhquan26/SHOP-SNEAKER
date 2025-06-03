<?php
require("../check/check_ql_kho.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy mã sản phẩm từ URL
$id = !empty($_GET['MA_SP']) ? intval($_GET['MA_SP']) : 0;

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM SANPHAM WHERE MA_SP = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger text-center'>Không tìm thấy sản phẩm với mã: $id</div>";
    exit;
}
$row = mysqli_fetch_assoc($result);

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TEN_SP = $_POST['TEN_SP'];
    $THONGTIN_SP = $_POST['THONGTIN_SP'];
    $GIA_NHAP = $_POST['GIA_NHAP'];
    $GIA_CU = $_POST['GIA_CU'];
    $GIA_MOI = $_POST['GIA_MOI'];
    $LUOT_BAN = $_POST['LUOT_BAN'];
    $NGAY_CAPNHAT = $_POST['NGAY_CAPNHAT'];
    $MAL_SP = $_POST['MAL_SP'];
    $MANH_SP = $_POST['MANH_SP'];

    $TARGET_DIR = "image/product/";
    if (!is_dir($TARGET_DIR)) mkdir($TARGET_DIR, 0777, true);
    $ALLOWED_TYPES = ['jpg', 'jpeg', 'png', 'gif'];

    function handle_upload($field_name, $old_file) {
        global $ALLOWED_TYPES, $TARGET_DIR, $errors;
        if (!empty($_FILES[$field_name]['name'])) {
            $filename = $_FILES[$field_name]['name'];
            $tmp = $_FILES[$field_name]['tmp_name'];
            $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $new_file = $TARGET_DIR . basename($TARGET_DIR . $filename);
            if (in_array($type, $ALLOWED_TYPES) && $_FILES[$field_name]['size'] <= 2 * 1024 * 1024) {
                if (move_uploaded_file($tmp, $new_file)) {
                    return $new_file;
                } else {
                    $errors[] = "Lỗi khi upload ảnh $field_name.";
                }
            } else {
                $errors[] = "Ảnh $field_name không đúng định dạng hoặc quá lớn.";
            }
        }
        return $old_file;
    }

    $ANH_GIOI_THIEU = handle_upload('ANH_GIOI_THIEU', $row['ANH_GIOI_THIEU']);
    $ANH_HOVER = handle_upload('ANH_HOVER', $row['ANH_HOVER']);
    $ANH_CHI_TIET_1 = handle_upload('ANH_CHI_TIET_1', $row['ANH_CHI_TIET_1']);
    $ANH_CHI_TIET_2 = handle_upload('ANH_CHI_TIET_2', $row['ANH_CHI_TIET_2']);

    if (count($errors) == 0) {
        $sql_update = "UPDATE SANPHAM SET 
            TEN_SP = '$TEN_SP', THONGTIN_SP = '$THONGTIN_SP', 
            GIA_NHAP = $GIA_NHAP, GIA_CU = $GIA_CU, GIA_MOI = $GIA_MOI, LUOT_BAN = $LUOT_BAN, 
            NGAY_CAPNHAT = '$NGAY_CAPNHAT', MAL_SP = '$MAL_SP', MANH_SP = '$MANH_SP',
            ANH_GIOI_THIEU = '$ANH_GIOI_THIEU', ANH_HOVER = '$ANH_HOVER', 
            ANH_CHI_TIET_1 = '$ANH_CHI_TIET_1', ANH_CHI_TIET_2 = '$ANH_CHI_TIET_2'
            WHERE MA_SP = $id";
        if (mysqli_query($conn, $sql_update)) {
            $success = "Cập nhật sản phẩm thành công!";
            $row = array_merge($row, $_POST, [
                'ANH_GIOI_THIEU' => $ANH_GIOI_THIEU,
                'ANH_HOVER' => $ANH_HOVER,
                'ANH_CHI_TIET_1' => $ANH_CHI_TIET_1,
                'ANH_CHI_TIET_2' => $ANH_CHI_TIET_2
            ]);
        } else {
            $errors[] = "Lỗi cập nhật: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Sửa sản phẩm</h2>
    <?php if (!empty($success)) : ?>
        <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="TEN_SP" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="TEN_SP" name="TEN_SP" value="<?php echo $row['TEN_SP']; ?>">
        </div>
        <div class="mb-3">
            <label for="THONGTIN_SP" class="form-label">Thông tin sản phẩm</label>
            <textarea class="form-control" id="THONGTIN_SP" name="THONGTIN_SP"><?php echo $row['THONGTIN_SP']; ?></textarea>
        </div>
        <?php
        $fields = [
            'ANH_GIOI_THIEU' => 'Ảnh giới thiệu',
            'ANH_HOVER' => 'Ảnh hover',
            'ANH_CHI_TIET_1' => 'Ảnh chi tiết 1',
            'ANH_CHI_TIET_2' => 'Ảnh chi tiết 2'
        ];
        foreach ($fields as $name => $label) {
            echo "<div class='mb-3'>
                    <label for='$name' class='form-label'>$label</label>
                    <input type='file' class='form-control' id='$name' name='$name'>";
            if (!empty($row[$name])) {
                echo "<img src='{$row[$name]}' class='img-thumbnail mt-2' width='150'>";
            }
            echo "</div>";
        }
        ?>
        <div class="mb-3"><label class="form-label">Giá nhập</label>
            <input type="text" class="form-control" name="GIA_NHAP" value="<?php echo $row['GIA_NHAP']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Giá cũ</label>
            <input type="text" class="form-control" name="GIA_CU" value="<?php echo $row['GIA_CU']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Giá mới</label>
            <input type="text" class="form-control" name="GIA_MOI" value="<?php echo $row['GIA_MOI']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Lượt bán</label>
            <input type="text" class="form-control" name="LUOT_BAN" value="<?php echo $row['LUOT_BAN']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Ngày cập nhật</label>
            <input type="date" class="form-control" name="NGAY_CAPNHAT" value="<?php echo $row['NGAY_CAPNHAT']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Mã loại sản phẩm</label>
            <input type="text" class="form-control" name="MAL_SP" value="<?php echo $row['MAL_SP']; ?>">
        </div>
        <div class="mb-3"><label class="form-label">Mã nhãn hiệu</label>
            <input type="text" class="form-control" name="MANH_SP" value="<?php echo $row['MANH_SP']; ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </form>
</div>
