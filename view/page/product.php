<?php
include_once("../layout/header.php");
include_once("../../config/config.php");

$ma_nh = isset($_GET['MANH_SP']) ? (int)$_GET['MANH_SP'] : 0; // bắt chắc số nguyên
$source = isset($_GET['source']) ? $_GET['source'] : 'unknown';

$sql = ""; // khởi tạo biến SQL


switch ($source) {
    case 'home_logo':
        $sql = "SELECT * FROM sanpham WHERE MANH_SP = $ma_nh";
        break;
    case 'header_link':
        $sql = "SELECT * FROM sanpham WHERE MANH_SP = $ma_nh";
        break;
    case 'header_productlink':
        $sql = "SELECT * FROM sanpham";
        break;
    case 'search_bar':
        $keyword = $_GET['keyword'] ?? '';
        $sql = "SELECT * FROM sanpham WHERE TEN_SP LIKE '%$keyword%'";
        break;
    default:
        $sql = "SELECT * FROM sanpham";
        break;
}

$result = mysqli_query($conn, $sql);
?>

<style>
    .container {
        margin-top: 100px;
    }

    .showproduct {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .image-wrapper {
        position: relative;
        width: 100%;
        height: 75%;
        overflow: hidden;
    }

    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease-in-out;
        position: absolute;
        top: 0;
        left: 0;
    }

    .image-wrapper img.card-img-top-hover {
        opacity: 0;
        z-index: 1;
    }

    .card:hover .card-img-top-hover {
        opacity: 1;
    }

    .card:hover .card-img-top {
        opacity: 0;
    }
</style>
<main>
    <div class="container">
        <div class="showproduct">
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="card" style="width: 18rem;">
                        <div class="image-wrapper">
                            <img src="/PRJ/<?php echo ($row['ANH_GIOI_THIEU']); ?>" class="card-img-top" alt="<?php echo ($row['TEN_SP']); ?>">
                            <img src="/PRJ/<?php echo ($row['ANH_HOVER']); ?>" class="card-img-top-hover" alt="<?php echo ($row['TEN_SP']); ?> hover">
                        </div>
                        <div class="card-body">
                            <a href="showproduct.php?MA_SP=<?php echo $row['MA_SP']; ?>">
                                <h5 class="card-title"><?php echo ($row['TEN_SP']); ?></h5>
                            </a>
                            <p class="card-text"><?php echo number_format($row['GIA_MOI'], 0, ',', '.') . "₫"; ?></p>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>Không có sản phẩm phù hợp.</p>";
            }
            ?>
        </div>
    </div>
</main>
<?php include_once("../layout/footer.php"); ?>