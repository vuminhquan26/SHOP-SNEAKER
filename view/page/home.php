<?php
include_once("../layout/header.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM sanpham";
$sql_hang = "SELECT * FROM nhanhieu WHERE TRANGTHAI = 1";
$result = mysqli_query($conn, $sql);
$result_hang = mysqli_query($conn, $sql_hang);
?>
<style>
    body {
        background-color: #343a40;
    }

    .container {
        margin-top: 100px;
    }

    .showproduct {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .showproduct .card {
        width: 18rem;
        height: 25rem;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;

        /* Xóa shadow và viền, mặc định nền trắng */
        box-shadow: none;
        border: none;
        background-color: #343a40;
        color: inherit;
    }

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

    .featured-brands {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-top: 50px;

    }

    .brand-card {
        border: none;
        width: 12rem;
        height: 12rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #343a40;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .brand-card:hover {
        transform: scale(1.1);
    }

    .brand-card img {
        max-width: 80%;
        max-height: 80%;
        object-fit: contain;
    }

    .banner {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .banner img {
        max-width: 1200px;
        max-height: 700px;
    }

    .carousel-item img {
        width: 100%;
        height: 50%;
        object-fit: cover;
        /* Đảm bảo ảnh không bị biến dạng */
    }
</style>


<body>
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <!-- Chỉ mục ảnh -->
        <ul class="carousel-indicators">
            <li data-bs-target="#demo" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#demo" data-bs-slide-to="1"></li>
        </ul>

        <!-- Slide ảnh -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../image/banner/1.png" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="../../image/banner/2.png" alt="Banner 2">
            </div>
        </div>

        <!-- Điều khiển trái và phải -->
        <a class="carousel-control-prev" href="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>


    <!-- Hot Products -->
    <div class="container">
        <div class="showproduct">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="/PRJ/<?php echo $row['ANH_GIOI_THIEU']; ?>" class="card-img-top" alt="Ảnh giới thiệu">
                        <img src="/PRJ/<?php echo $row['ANH_HOVER']; ?>" class="card-img-top-hover" alt="Ảnh hover">
                    </div>
                    <div class="card-body">
                        <a href="showproduct.php?MA_SP=<?php echo $row['MA_SP']; ?>">
                            <h5 class="card-title"><?php echo $row['TEN_SP']; ?></h5>
                        </a>
                        <p class="card-text"><?php echo number_format($row['GIA_MOI'], 0, ',', '.') . '₫'; ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    </div>

    <!-- Featured Brands -->
    <div class="container">
        <div class="featured-brands">
            <?php while ($row_hang = mysqli_fetch_assoc($result_hang)) { ?>
                <a href="product.php?MANH_SP=<?= $row_hang['MANH_SP'] ?>&source=home_logo" class="brand-card">
                    <img src="/PRJ/<?= $row_hang['LOGO'] ?>" alt="SP">
                </a>
            <?php } ?>
        </div>
    </div>
</body>



<?php
include_once("../layout/footer.php");
?>