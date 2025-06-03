<?php
session_start();
include_once("../../config/config.php");

// --- XỬ LÝ KHI SUBMIT THÊM VÀO GIỎ HÀNG ---
if (isset($_GET['submit'])) {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        echo "
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        
        <body></body>

        <script>
            Swal.fire({
                icon: 'info',
                title: 'Yêu Cầu Đăng Nhập',
                text: 'Bạn cần đăng nhập để truy cập trang này. Bạn muốn quay lại hay chuyển đến trang đăng nhập?',
                showCancelButton: true,
                confirmButtonText: 'Về trang trước',
                cancelButtonText: 'Đăng nhập',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = '../user/login.php';
                }
            });
        </script>
        ";
        
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $size = intval($_GET['size']);
    $ma_sp = intval($_GET['MA_SP']);
    $soluong = intval($_GET['soluong']);

    if ($ma_sp > 0 && $size > 0 && $soluong > 0) {
        $sql_insert = "INSERT INTO giohang (MA_SP, MA_KH, SO_LUONG, ma_kc)
                       VALUES ('$ma_sp', '$user_id', '$soluong', '$size')";
        if (mysqli_query($conn, $sql_insert)) {
            // Thêm thành công, xuất javascript Swal thông báo
            echo "
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>

            <body></body>

            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Sản phẩm đã được thêm vào giỏ hàng',
                    confirmButtonText: 'OK'
                });
            </script>
            ";
        } else {
            die("Lỗi thêm vào giỏ: " . mysqli_error($conn));
        }
    }
}
// --- LOAD THÔNG TIN SẢN PHẨM ---
if (!isset($_GET['MA_SP'])) {
    die("Không có mã sản phẩm được cung cấp.");
}
$id = intval($_GET['MA_SP']);
$sql = "SELECT * FROM sanpham WHERE MA_SP = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    die("Không tìm thấy sản phẩm.");
}
$row = mysqli_fetch_assoc($result);

// Danh sách kích cỡ
$sql_size = "SELECT * FROM kichco";
$result_size = mysqli_query($conn, $sql_size);

// Sản phẩm liên quan
$sql_lienquan = "SELECT * FROM sanpham WHERE MA_SP != $id LIMIT 4";
$result_lienquan = mysqli_query($conn, $sql_lienquan);
?>
<?php include_once("../layout/header.php"); ?>

<style>
    .image-wrapper {
        position: relative;
        width: 100%;
        height: 75%;
        overflow: hidden;
    }

    .card-img-top,
    .card-img-top-hover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    .card-img-top-hover {
        opacity: 0;
        z-index: 1;
    }

    .card:hover .card-img-top {
        transform: scale(1.1);
        opacity: 0;
    }

    .card:hover .card-img-top-hover {
        opacity: 1;
    }

    .card-body {
        flex: 1;
        background: transparent;
        /* bỏ nền trắng */
        text-align: center;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border: none;
    }

    .card-body h5 {
        font-size: 1.1rem;
        margin-bottom: .5rem;
        color: white;
    }

    .card-body a {
        text-decoration: none;
    }

    .card-body p {
        color: white;
        /* vàng nổi bật giá trên nền tối */
        font-weight: bold;
        margin-bottom: .5rem;
    }

    .product-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        margin-right: 5px;
    }

    .main-image {
        width: 100%;
        max-height: 350px;
        object-fit: contain;
        border: 1px solid #ccc;
    }

    .size-button {
        margin: 5px;
        width: 40px;
        height: 40px;
    }

    .chitietsanpham {
        display: flex;
    }

    .chitietsanpham .mota {
        background-color: #212529;
        border-radius: 5%;
    }

    .hinhanh {
        width: 50%;
    }

    .mota {
        width: 50%;
    }

    .anhgioithieu img {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
    }

    .anhmota {
        display: flex;
        justify-content: center;
    }

    .anhmota img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        cursor: pointer;
    }

    .anhmota img:hover {
        border: 2px solid #0d6efd;
    }

    h4 {
        color: white;
    }

    .mota h4 {
        color: white;
        margin-top: 50px;
        margin-left: 30px;
    }

    .mota p {
        color: white;
        margin-top: 20px;
        margin-left: 30px;
    }

    .mota button {
        color: white;
        margin-top: 20px;
        margin-left: 30px;
        border: 2px solid white;
    }

    .size {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Khoảng cách giữa các item */
        justify-content: center;
        /* Căn giữa */
        align-items: center;
        margin-top: 5px;
    }

    .size input {
        padding: 5;
        margin: 5px;
    }

    .size label {
        font-size: larger;
        color: white;
        font-weight: bold;
        cursor: pointer;
    }

    #btsoluong {
        background: none;
        border: none;
        outline: none;
    }

    form #soluong {
        background: none;
        color: white;
    }
</style>

<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.css" />

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/simple-notify/dist/simple-notify.min.js"></script>
</head>

<body>
    <!-- Product Detail -->
    <div class="container my-5">
        <div class="chitietsanpham">
            <div class="hinhanh">
                <div class="anhgioithieu">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_CHI_TIET_1']; ?>" id="product-detail" onclick="doianh(this)">
                </div>
                <div class="anhmota">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_CHI_TIET_2']; ?>" id="product-detail" onclick="doianh(this)">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_CHI_TIET_3']; ?>" id="product-detail" onclick="doianh(this)">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_CHI_TIET_4']; ?>" id="product-detail" onclick="doianh(this)">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_GIOI_THIEU']; ?>" id="product-detail" onclick="doianh(this)">
                    <img class="card-img img-fluid" src="/PRJ/<?php echo $row['ANH_HOVER']; ?>" id="product-detail" onclick="doianh(this)">
                </div>
            </div>
            <!-- Thông tin -->
            <div class="mota">
                <h4><?php echo $row['TEN_SP'] ?></h4>
                <p><strong>Giá: </strong><?php echo $row['GIA_MOI'] ?></p>
                <p><strong>Trạng thái :</strong> Còn hàng</p>
                <p><strong>Mô tả: </strong><?php echo $row['THONGTIN_SP'] ?></p>
                <p><strong>Ngày cập nhật: </strong><?php echo $row['NGAY_CAPNHAT'] ?></p>
                <p><strong>Lượt bán: </strong><?php echo $row['LUOT_BAN'] ?></p>
                <form method="get">
                    <input type="hidden" name="MA_SP" value="<?php echo $row['MA_SP']; ?>">

                    <p><strong>Size:</strong></p>
                    <div class="size" style="color: white;">
                        <?php while ($row_size = mysqli_fetch_assoc($result_size)) {
                            $ten_kc = $row_size['TEN_KC'];
                        ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="size" id="size_<?php echo $ten_kc; ?>" value="<?php echo $ten_kc; ?>" required>
                                <label class="form-check-label custom-size-label" for="size_<?php echo $ten_kc; ?>">
                                    <?php echo $ten_kc; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>

                    <button type="button" id="btsoluong" onclick="giamSoLuong()" style="padding-right: 26px;">-</button>
                    <input type="text" name="soluong" id="soluong" value="1" readonly style="width: 40px; text-align: center;">
                    <button type="button" id="btsoluong" onclick="tangSoLuong()">+</button>

                    <button type="submit" id="btnSubmit" class="btn btn-success" name="submit" value="submit">THÊM VÀO GIỎ HÀNG</button>
                </form>
            </div>
        </div>

        <!-- Sản phẩm liên quan -->
        <h4 class="mt-5">SẢN PHẨM LIÊN QUAN</h4>
        <div class="showproduct" style="display: flex;">
            <?php while ($row_lienquan = mysqli_fetch_assoc($result_lienquan)): ?>
                <div class="card" style="margin: 20px;">
                    <div class="image-wrapper">
                        <img src="/PRJ/<?php echo $row_lienquan['ANH_GIOI_THIEU']; ?>" class="card-img-top" alt="Ảnh giới thiệu">
                        <img src="/PRJ/<?php echo $row_lienquan['ANH_HOVER']; ?>" class="card-img-top-hover" alt="Ảnh hover">
                    </div>
                    <div class="card-body">
                        <a href="showproduct.php?MA_SP=<?php echo $row_lienquan['MA_SP']; ?>">
                            <h5 class="card-title"><?php echo $row_lienquan['TEN_SP']; ?></h5>
                        </a>
                        <p class="card-text"><?php echo number_format($row_lienquan['GIA_MOI'], 0, ',', '.') . '₫'; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
<script>
    // const btnSubmit = document.getElementById("btnSubmit");
    // btnSubmit.addEventListener("click", function (e) {
    //     console.log("ahihi");
    //     const isLogin = false;

    //     if (isLogin) {
    //         e.preventDefault();
    //     }
    // });

    function tangSoLuong() {
        var input = document.getElementById("soluong");
        var current = parseInt(input.value);
        input.value = current + 1;
    }

    function giamSoLuong() {
        var input = document.getElementById("soluong");
        var current = parseInt(input.value);
        if (current > 1) {
            input.value = current - 1;
        }
    }

    function doianh(img) {
        document.getElementById("product-detail").src = img.src;
    }
</script>
<?php include_once("../layout/footer.php"); ?>