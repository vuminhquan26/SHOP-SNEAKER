<?php
include_once "header.php";
require_once "config.php";

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sp = $_POST['ma_sp'];
    $name = $_POST['ten_sp'];
    $mota_sp = $_POST['mota_sp'];
    $thongtin_sp = $_POST['thongtin_sp'];
    $ma_ha = $_POST['ma_ha'];
    $gia_nhap = $_POST['gia_nhap'];
    $gia_cu = $_POST['gia_cu'];
    $gia_moi = $_POST['gia_moi'];
    $luot_ban = $_POST['luot_ban'];
    $ngay_capnhat = $_POST['ngay_capnhat'];
    $trang_thai = $_POST['trang_thai'];
    $mal_sp = $_POST['mal_sp'];
    $manh_sp = $_POST['manh_sp'];
    $ma_ha = $_POST['ma_ha'];

    if (empty($ma_sp)) {
        $errors[] = "Mã sản phẩm không được để trống";
    }
    if (empty($name)) {
        $errors[] = "Tên sản phẩm không được để trống";
    }
    if (empty($mota_sp)) {
        $errors[] = "Mô tả sản phẩm không được để trống";
    }
    if (empty($thongtin_sp)) {
        $errors[] = "Thông tin sản phẩm không được để trống";
    }
    if(empty($_FILES['image']['name'])) {
        $upload = 'no';
    } else {
        $file_name = $_FILES['image']['name'];
        $file_type = $_FILES['image']['type']; 
        $file_tmp = $_FILES['image']['tmp_name']; 
        $types = ['image/jpeg', 'image/png', 'image/jpg'];
        if(in_array($file_type, $types)) {
            move_uploaded_file($file_tmp, 'images/'.$file_name);
            $upload = 'ok';
            $errors[] = "Định dạng file không hợp lệ";
        }
    }
    if (empty($gia_nhap) || !is_numeric($gia_nhap)) {
        $errors[] = "Giá nhập phải là số hợp lệ";
    }
    if (empty($gia_cu) || !is_numeric($gia_cu)) {
        $errors[] = "Giá cũ phải là số hợp lệ";
    }
    if (empty($gia_moi) || !is_numeric($gia_moi)) {
        $errors[] = "Giá mới phải là số hợp lệ";
    }
    if (empty($luot_ban) || !is_numeric($luot_ban)) {
        $errors[] = "Lượt bán phải là số hợp lệ";
    }
    if (empty($ngay_capnhat)) {
        $errors[] = "Ngày cập nhật không được để trống";
    }
    if (empty($trang_thai)) {
        $errors[] = "Trạng thái không được để trống";
    }
    if (empty($mal_sp)) {
        $errors[] = "Mã loại sản phẩm không được để trống";
    }
    if (empty($manh_sp)) {
        $errors[] = "Mã nhãn sản phẩm không được để trống";
    }

    if (count($errors) == 0) {
        $sql = "INSERT INTO sanpham (ma_sp, ten_sp, thongtin_sp, ma_ha, gia_nhap, gia_cu, gia_moi, luot_ban, ngay_capnhat, trang_thai, mal_sp, manh_sp, loai_sp, thaotac) 
                VALUES ('$ma_sp', '$name','$mota_sp', '$thongtin_sp', '$ma_ha', '$gia_nhap', '$gia_cu', '$gia_moi', '$luot_ban', '$ngay_capnhat', '$trang_thai', '$mal_sp', '$manh_sp')";
         mysqli_query($conn, $sql);
         header(header: "Location: success.php");
    } else {
        header(header: "Location: fail.php");

        exit();
    }
    }
?>

<div class="container mt-5">
    <h2 class="text-center">Thêm sản phẩm</h2>
    <?php if (!empty($success)) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="ma_sp" class="form-label">Mã sản phẩm</label>
            <input type="text" class="form-control" id="ma_sp" name="ma_sp">
        </div>
        <div class="mb-3">
            <label for="ten_sp" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="ten_sp" name="ten_sp">
        </div>
        <div class="mb-3">
            <label for="ten_sp" class="form-label">Mô tả sản phẩm</label>
            <input type="text" class="form-control" id="mota_sp" name="mota_sp">    
        </div>
        <div class="mb-3">
            <label for="thongtin_sp" class="form-label">Thông tin sản phẩm</label>
            <textarea class="form-control" id="thongtin_sp" name="thongtin_sp"></textarea>
        </div>
        <div class="mb-3">
            <label for="ma_ha" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="ma_ha" name="ma_ha">
        <img src='images/<?php echo $row['ma_ha']; ?>' width='50px' height='50px'>
        </div>
        <div class="mb-3">
            <label for="gia_nhap" class="form-label">Giá nhập</label>
            <input type="text" class="form-control" id="gia_nhap" name="gia_nhap">
        </div>
        <div class="mb-3">
            <label for="gia_cu" class="form-label">Giá cũ</label>
            <input type="text" class="form-control" id="gia_cu" name="gia_cu">
        </div>
        <div class="mb-3">
            <label for="gia_moi" class="form-label">Giá mới</label>
            <input type="text" class="form-control" id="gia_moi" name="gia_moi">
        </div>
        <div class="mb-3">
            <label for="luot_ban" class="form-label">Lượt bán</label>
            <input type="text" class="form-control" id="luot_ban" name="luot_ban">
        </div>
        <div class="mb-3">
            <label for="ngay_capnhat" class="form-label">Ngày cập nhật</label>
            <input type="date" class="form-control" id="ngay_capnhat" name="ngay_capnhat">
        </div>
        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <input type="text" class="form-control" id="trang_thai" name="trang_thai">
        </div>
        <div class="mb-3">
            <label for="mal_sp" class="form-label">Mã loại sản phẩm</label>
            <input type="text" class="form-control" id="mal_sp" name="mal_sp">
        </div>
        <div class="mb-3">
            <label for="manh_sp" class="form-label">Mã nhãn sản phẩm</label>
            <input type="text" class="form-control" id="manh_sp" name="manh_sp">
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">THÊM</button>
            <a href="quanlysanpham.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
<?php
include 'footer.php';
mysqli_close($conn);
?>