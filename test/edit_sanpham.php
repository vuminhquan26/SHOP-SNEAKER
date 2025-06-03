<?php
include 'header.php';
include 'config.php';   
$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM sanpham WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$errors = [];
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['ten_sp'];
    $ma_sp = $_POST['ma_sp'];
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
    $anh_gioi_thieu = $row['anh_gioi_thieu']; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
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
    $anh_hover = $row['anh_hover']; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
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
    $anh_chi_tiet_1 = $row['anh_chi_tiet_1']; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
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
    $anh_chi_tiet_2 = $row['anh_chi_tiet_2']; // Giữ nguyên ảnh cũ nếu không upload ảnh mới
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

    // Nếu không có lỗi, cập nhật sản phẩm
    if (count($errors) == 0) {
        $sql2 = "UPDATE sanpham 
                 SET ten_sp = '$name', ma_sp = '$ma_sp', mota_sp = '$mota_sp', thongtin_sp = '$thongtin_sp', 
                     gia_nhap = $gia_nhap, gia_cu = $gia_cu, gia_moi = $gia_moi, luot_ban = $luot_ban, 
                     ngay_capnhat = '$ngay_capnhat', trang_thai = '$trang_thai', mal_sp = '$mal_sp', manh_sp = '$manh_sp',
                     anh_gioi_thieu = '$anh_gioi_thieu', anh_hover = '$anh_hover', 
                     anh_chi_tiet_1 = '$anh_chi_tiet_1', anh_chi_tiet_2 = '$anh_chi_tiet_2'
                 WHERE id = $id";

        $result = mysqli_query($conn, $sql2);

        if ($result) {
            header("Location: success.php");
            exit();
        } else {
            $errors[] = "Cập nhật sản phẩm thất bại: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Sửa sản phẩm</h2>
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
            <input type="text" class="form-control" id="ma_sp" name="ma_sp" value="<?php echo htmlspecialchars($row['ma_sp']); ?>">
        </div>
        <div class="mb-3">
            <label for="ten_sp" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="ten_sp" name="ten_sp" value="<?php echo htmlspecialchars($row['ten_sp']); ?>">
        </div>
        <div class="mb-3">
            <label for="mota_sp" class="form-label">Mô tả sản phẩm</label>
            <input type="text" class="form-control" id="mota_sp" name="mota_sp" value="<?php echo htmlspecialchars($row['mota_sp']); ?>">
        </div>
        <div class="mb-3">
            <label for="thongtin_sp" class="form-label">Thông tin sản phẩm</label>
            <textarea class="form-control" id="thongtin_sp" name="thongtin_sp"><?php echo htmlspecialchars($row['thongtin_sp']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="anh_gioi_thieu" class="form-label">Hình ảnh giới thiệu</label>
            <input type="file" class="form-control" id="anh_gioi_thieu" name="anh_gioi_thieu">
            <?php if (!empty($row['anh_gioi_thieu'])) : ?>
                <img src="<?php echo $row['anh_gioi_thieu']; ?>" alt="Hình ảnh giới thiệu" class="img-thumbnail mt-2" width="150">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="anh_hover" class="form-label">Hình ảnh HOVER</label>
            <input type="file" class="form-control" id="anh_hover" name="anh_hover">
            <?php if (!empty($row['anh_hover'])) : ?>
                <img src="<?php echo $row['anh_hover']; ?>" alt="Hình ảnh HOVER" class="img-thumbnail mt-2" width="150">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="anh_chi_tiet_1" class="form-label">Hình ảnh chi tiết 1</label>
            <input type="file" class="form-control" id="chi_tiet_1" name="anh_chi_tiet_1">
            <?php if (!empty($row['anh_chi_tiet_1'])) : ?>
                <img src="<?php echo $row['anh_chi_tiet_1']; ?>" alt="Hình ảnh chi tiết 1" class="img-thumbnail mt-2" width="150">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="anh_chi_tiet_2" class="form-label">Hình ảnh chi tiết 2</label>
            <input type="file" class="form-control" id="anh_chi_tiet_2" name="anh_chi_tiet_2">
            <?php if (!empty($row['anh_chi_tiet_2'])) : ?>
                <img src="<?php echo $row['anh_chi_tiet_2']; ?>" alt="Hình ảnh chi tiết 2" class="img-thumbnail mt-2" width="150">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="gia_nhap" class="form-label">Giá nhập</label>
            <input type="text" class="form-control" id="gia_nhap" name="gia_nhap" value="<?php echo htmlspecialchars($row['gia_nhap']); ?>">
        </div>
        <div class="mb-3">
            <label for="gia_cu" class="form-label">Giá cũ</label>
            <input type="text" class="form-control" id="gia_cu" name="gia_cu" value="<?php echo htmlspecialchars($row['gia_cu']); ?>">
        </div>
        <div class="mb-3">
            <label for="gia_moi" class="form-label">Giá mới</label>
            <input type="text" class="form-control" id="gia_moi" name="gia_moi" value="<?php echo htmlspecialchars($row['gia_moi']); ?>">
        </div>
        <div class="mb-3">
            <label for="luot_ban" class="form-label">Lượt bán</label>
            <input type="text" class="form-control" id="luot_ban" name="luot_ban" value="<?php echo htmlspecialchars($row['luot_ban']); ?>">
        </div>
        <div class="mb-3">
            <label for="ngay_capnhat" class="form-label">Ngày cập nhật</label>
            <input type="date" class="form-control" id="ngay_capnhat" name="ngay_capnhat" value="<?php echo htmlspecialchars($row['ngay_capnhat']); ?>">
        </div>
        <div class="mb-3">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <input type="text" class="form-control" id="trang_thai" name="trang_thai" value="<?php echo htmlspecialchars($row['trang_thai']); ?>">
        </div>
        <div class="mb-3">
            <label for="mal_sp" class="form-label">Mã loại sản phẩm</label>
            <input type="text" class="form-control" id="mal_sp" name="mal_sp" value="<?php echo htmlspecialchars($row['mal_sp']); ?>">
        </div>
        <div class="mb-3">
            <label for="manh_sp" class="form-label">Mã nhãn sản phẩm</label>
            <input type="text" class="form-control" id="manh_sp" name="manh_sp" value="<?php echo htmlspecialchars($row['manh_sp']); ?>">
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="quanlysanpham.php" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
<?php
include 'footer.php';
mysqli_close($conn);
?>