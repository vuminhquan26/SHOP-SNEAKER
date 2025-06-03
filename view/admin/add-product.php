<?php
require("../check/check_ql_kho.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$errors = [];
$success = "";

// Lấy danh sách nhãn hiệu cho combobox
$sql_nh = "SELECT * FROM nhanhieu";
$sql_ml = "SELECT * FROM loaisanpham";
$result_ml = mysqli_query($conn, $sql_ml);
$result_nh = mysqli_query($conn, $sql_nh);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MA_SP = $_POST['MA_SP'];
    $TEN_SP = $_POST['TEN_SP'];
    $THONGTIN_SP = $_POST['THONGTIN_SP'];
    $GIA_NHAP = $_POST['GIA_NHAP'];
    $GIA_CU = $_POST['GIA_CU'];
    $GIA_MOI = $_POST['GIA_MOI'];
    $LUOT_BAN = $_POST['LUOT_BAN'];
    $NGAY_CAPNHAT = $_POST['NGAY_CAPNHAT'];
    $MAL_SP = $_POST['MAL_SP'];
    $MANH_SP = $_POST['MANH_SP'];
    $TRANG_THAI = 1;

    // Kiểm tra dữ liệu
    if (empty($MA_SP)) $errors[] = "Mã sản phẩm không được để trống";
    if (empty($TEN_SP)) $errors[] = "Tên sản phẩm không được để trống";
    if (empty($GIA_NHAP) || !is_numeric($GIA_NHAP)) $errors[] = "Giá nhập phải là số hợp lệ";
    if (empty($GIA_CU) || !is_numeric($GIA_CU)) $errors[] = "Giá cũ phải là số hợp lệ";
    if (empty($GIA_MOI) || !is_numeric($GIA_MOI)) $errors[] = "Giá mới phải là số hợp lệ";
    if (empty($MAL_SP)) $errors[] = "Mã loại sản phẩm không được để trống";
    if (empty($MANH_SP)) $errors[] = "Mã nhãn sản phẩm không được để trống";

    
    // Kiểm tra mã loại sản phẩm có tồn tại
    $check_mal_sp = "SELECT COUNT(*) AS count FROM LOAISANPHAM WHERE MAL_SP = '$MAL_SP'";
    $result_check = mysqli_query($conn, $check_mal_sp);
    $row_check = mysqli_fetch_assoc($result_check);
    if ($row_check['count'] == 0) $errors[] = "Mã loại sản phẩm không tồn tại.";

    $target_dir = "image/product/";
    if (!is_dir(filename: $target_dir)) mkdir($target_dir, 0777, true);
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    function upload_image($field, &$errors, $target_dir, $allowed_types) {
        if (!empty($_FILES[$field]['name'])) {
            $file_name = $_FILES[$field]['name'];
            $file_tmp = $_FILES[$field]['tmp_name'];
            $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $target_file = $target_dir . basename($file_name);
            if (in_array($file_type, $allowed_types) && $_FILES[$field]['size'] <= 2 * 1024 * 1024) {
                if (move_uploaded_file($file_tmp, $target_file)) return $target_file;
                else $errors[] = "Lỗi khi upload $field.";
            } else $errors[] = "$field không đúng định dạng hoặc quá lớn.";
        }
        return $file_name;
    }

    // Láy tên file ảnh
    // $file_name = $_FILES["ANH_GIOI_THIEU"]["name"];
    // echo $file_name;

    $ANH_GIOI_THIEU = upload_image('ANH_GIOI_THIEU', $errors, $target_dir, $allowed_types);
    $ANH_HOVER = upload_image('ANH_HOVER', $errors, $target_dir, $allowed_types);
    $ANH_CHI_TIET_1 = upload_image('ANH_CHI_TIET_1', $errors, $target_dir, $allowed_types);
    $ANH_CHI_TIET_2 = upload_image('ANH_CHI_TIET_2', $errors, $target_dir, $allowed_types);
    $ANH_CHI_TIET_3 = upload_image('ANH_CHI_TIET_3', $errors, $target_dir, $allowed_types);
    $ANH_CHI_TIET_4 = upload_image('ANH_CHI_TIET_4', $errors, $target_dir, $allowed_types);

    if (count($errors) == 0) {
        $sql_insert = "INSERT INTO sanpham (MA_SP, TEN_SP, THONGTIN_SP, GIA_NHAP, GIA_CU, GIA_MOI, LUOT_BAN, NGAY_CAPNHAT, MAL_SP, MANH_SP, ANH_GIOI_THIEU, ANH_HOVER, ANH_CHI_TIET_1, ANH_CHI_TIET_2,ANH_CHI_TIET_3,ANH_CHI_TIET_4)
                       VALUES ('$MA_SP', '$TEN_SP', '$THONGTIN_SP', '$GIA_NHAP', '$GIA_CU', '$GIA_MOI', '$LUOT_BAN', '$NGAY_CAPNHAT', '$MAL_SP', '$MANH_SP', '$ANH_GIOI_THIEU', '$ANH_HOVER', '$ANH_CHI_TIET_1', '$ANH_CHI_TIET_2','$ANH_CHI_TIET_3','$ANH_CHI_TIET_4')";
        if (mysqli_query($conn, $sql_insert)) $success = "Thêm sản phẩm thành công!";
        else $errors[] = "Lỗi khi thêm sản phẩm: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Thêm sản phẩm</h2>
    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger"><ul><?php foreach ($errors as $e) echo "<li>$e</li>"; ?></ul></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <!-- Thông tin sản phẩm -->
        <input type="text" name="MA_SP" placeholder="Mã sản phẩm" class="form-control mb-3">
        <input type="text" name="TEN_SP" placeholder="Tên sản phẩm" class="form-control mb-3">
        <textarea name="THONGTIN_SP" placeholder="Thông tin sản phẩm" class="form-control mb-3"></textarea>

        <!-- Hình ảnh -->
        <label>Hình ảnh giới thiệu</label><input type="file" name="ANH_GIOI_THIEU" class="form-control mb-3">
        <label>Hình ảnh hover</label><input type="file" name="ANH_HOVER" class="form-control mb-3">
        <label>Chi tiết 1</label><input type="file" name="ANH_CHI_TIET_1" class="form-control mb-3">
        <label>Chi tiết 2</label><input type="file" name="ANH_CHI_TIET_2" class="form-control mb-3">
        <label>Chi tiết 3</label><input type="file" name="ANH_CHI_TIET_3" class="form-control mb-3">
        <label>Chi tiết 4</label><input type="file" name="ANH_CHI_TIET_4" class="form-control mb-3">

        <!-- Giá -->
        <input type="text" name="GIA_NHAP" placeholder="Giá nhập" class="form-control mb-3">
        <input type="text" name="GIA_CU" placeholder="Giá cũ" class="form-control mb-3">
        <input type="text" name="GIA_MOI" placeholder="Giá mới" class="form-control mb-3">

        <!-- Khác -->
        <input type="number" name="LUOT_BAN" value="0" placeholder="Lượt bán" class="form-control mb-3">
        <input type="date" name="NGAY_CAPNHAT" class="form-control mb-3" value="<?php echo date('Y-m-d'); ?>">
        <label for="MAL_SP">Loại Sản Phẩm</label>
        <select name="MAL_SP" id="MAL_SP" class="form-select mb-3">
            <?php while ($row = mysqli_fetch_assoc($result_ml)) :?>
                <option value="<?php echo $row['MAL_SP']; ?>"><?php echo $row['TEN_LOAISP'] ?></option>
            <?php endwhile; ?>
        </select>

        <!-- Nhãn hiệu -->
        <label for="MANH_SP">Nhãn Hiệu</label>
        <select name="MANH_SP" class="form-select mb-3">
            <?php while ($row = mysqli_fetch_assoc($result_nh)) : ?>
                <option value="<?php echo $row['MANH_SP']; ?>"><?php echo $row['TEN_NH']; ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
</div>
