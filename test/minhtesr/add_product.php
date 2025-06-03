<?php
include_once "header.php";
require_once "config.php";
// Kết nối đến cơ sở dữ liệu

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sp = $_POST['ma_sp'];
    $name = $_POST['ten_sp'];
    $mota_sp = $_POST['mota_sp'];
    $thongtin_sp = $_POST['thongtin_sp'];
    $gia_nhap = $_POST['gia_nhap'];
    $gia_cu = $_POST['gia_cu'];
    $gia_moi = $_POST['gia_moi'];
    $luot_ban = $_POST['luot_ban'];
    $ngay_capnhat = $_POST['ngay_capnhat'];
    $trang_thai = $_POST['trang_thai'];
    $mal_sp = $_POST['mal_sp'];
    $manh_sp = $_POST['manh_sp'];
    // Kiểm tra xem các trường bắt buộc có được điền hay không

    // Thư mục lưu ảnh
    $target_dir = "images/";
    if (!is_dir($target_dir)) {
        //Hàm mkdir() được sử dụng để tạo thư mục
        //0777: Quyền truy cập cho thư mục (đọc, ghi, thực thi cho tất cả người dùng)
        // cái này đừng thằng l nào động vào hay chỉnh sửa vì t cx méo hiểu lắm
        mkdir($target_dir, 0777, true);
    }

    // Danh sách định dạng ảnh được phép
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    // Xử lý upload ảnh giới thiệu
    //pathinfo($file_name, PATHINFO_EXTENSION):
//Hàm pathinfo() trả về thông tin về đường dẫn tệp.
//Tham số PATHINFO_EXTENSION chỉ định rằng bạn muốn lấy phần mở rộng của tệp (ví dụ: jpg, png, gif).
//Hàm strtolower() chuyển chuỗi thành chữ thường.
    $anh_gioi_thieu = "";
    if (!empty($_FILES['anh_gioi_thieu']['name'])) {
        $file_name = $_FILES['anh_gioi_thieu']['name'];
        $file_tmp = $_FILES['anh_gioi_thieu']['tmp_name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $file_type;

        if (in_array($file_type, $allowed_types) && $_FILES['anh_gioi_thieu']['size'] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                $anh_gioi_thieu = $target_file;
            } else {
                $errors[] = "Lỗi khi upload ảnh giới thiệu.";
            }
        } else {
            $errors[] = "Ảnh giới thiệu không đúng định dạng ";
        }
    }

    // Xử lý upload ảnh HOVER
    $anh_hover = "";
    if (!empty($_FILES['anh_hover']['name'])) {
        $file_name = $_FILES['anh_hover']['name'];
        $file_tmp = $_FILES['anh_hover']['tmp_name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $file_type;

        if (in_array($file_type, $allowed_types) && $_FILES['anh_hover']['size'] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                $anh_hover = $target_file;
            } else {
                $errors[] = "Lỗi khi upload ảnh HOVER.";
            }
        } else {
            $errors[] = "Ảnh HOVER không đúng định dạng ";
        }
    }

    // Xử lý upload ảnh chi tiết 1
    $anh_chi_tiet_1 = "";
    if (!empty($_FILES['anh_chi_tiet_1']['name'])) {
        $file_name = $_FILES['anh_chi_tiet_1']['name'];
        $file_tmp = $_FILES['anh_chi_tiet_1']['tmp_name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $file_type;

        if (in_array($file_type, $allowed_types) && $_FILES['anh_chi_tiet_1']['size'] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                $anh_chi_tiet_1 = $target_file;
            } else {
                $errors[] = "Lỗi khi upload ảnh chi tiết 1.";
            }
        } else {
            $errors[] = "Ảnh chi tiết 1 không đúng định dạng ";
        }
    }

    // Xử lý upload ảnh chi tiết 2
    $anh_chi_tiet_2 = "";
    if (!empty($_FILES['anh_chi_tiet_2']['name'])) {
        $file_name = $_FILES['anh_chi_tiet_2']['name'];
        $file_tmp = $_FILES['anh_chi_tiet_2']['tmp_name'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $file_type;

        if (in_array($file_type, $allowed_types) && $_FILES['anh_chi_tiet_2']['size'] <= 2 * 1024 * 1024) {
            if (move_uploaded_file($file_tmp, $target_file)) {
                $anh_chi_tiet_2 = $target_file;
            } else {
                $errors[] = "Lỗi khi upload ảnh chi tiết 2.";
            }
        } else {
            $errors[] = "Ảnh chi tiết 2 không đúng định dạng ";
        }
    }

    // Kiểm tra dữ liệu đầu vào
    if (empty($ma_sp)) {
        $errors[] = "Mã sản phẩm không được để trống";
    }
    if (empty($name)) {
        $errors[] = "Tên sản phẩm không được để trống";
    }
    if (empty($mota_sp)) {
        $errors[] = "Mô tả sản phẩm không được để trống";
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

    // Nếu không có lỗi, thêm sản phẩm vào cơ sở dữ liệu
    if (count($errors) == 0) {
        $sql = "INSERT INTO sanpham (ma_sp, ten_sp, mota_sp, thongtin_sp, gia_nhap, gia_cu, gia_moi, luot_ban, ngay_capnhat, trang_thai, mal_sp, manh_sp, anh_gioi_thieu, anh_hover, anh_chi_tiet_1, anh_chi_tiet_2) 
                VALUES ('$ma_sp', '$name', '$mota_sp', '$thongtin_sp', '$gia_nhap', '$gia_cu', '$gia_moi', '$luot_ban', '$ngay_capnhat', '$trang_thai', '$mal_sp', '$manh_sp', '$anh_gioi_thieu', '$anh_hover', '$anh_chi_tiet_1', '$anh_chi_tiet_2')";

        if (mysqli_query($conn, $sql)) {
            $success = "Thêm sản phẩm thành công!";
        } else {
            $errors[] = "Lỗi khi thêm sản phẩm: " . mysqli_error($conn);
        }
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
            <label for="mota_sp" class="form-label">Mô tả sản phẩm</label>
            <input type="text" class="form-control" id="mota_sp" name="mota_sp">
        </div>
        <div class="mb-3">
            <label for="thongtin_sp" class="form-label">Thông tin sản phẩm</label>
            <textarea class="form-control" id="thongtin_sp" name="thongtin_sp"></textarea>
        </div>
        <div class="mb-3">
            <label for="anh_gioi_thieu" class="form-label">Hình ảnh giới thiệu</label>
            <input type="file" class="form-control" id="anh_gioi_thieu" name="anh_gioi_thieu">
        </div>
        <div class="mb-3">
            <label for="anh_hover" class="form-label">Hình ảnh HOVER</label>
            <input type="file" class="form-control" id="anh_hover" name="anh_hover">
        </div>
        <div class="mb-3">
            <label for="anh_chi_tiet_1" class="form-label">Hình ảnh chi tiết 1</label>
            <input type="file" class="form-control" id="anh_chi_tiet_1" name="anh_chi_tiet_1" >
        </div>
        <div class="mb-3">
            <label for="anh_chi_tiet_2" class="form-label">Hình ảnh chi tiết 2</label>
            <input type="file" class="form-control" id="anh_chi_tiet_2" name="anh_chi_tiet_2">
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