<?php
require_once("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// dem san pham
$sql_product = "SELECT COUNT(*) AS total_product FROM sanpham";
$result_product = mysqli_query($conn, $sql_product);
$row_product = mysqli_fetch_assoc($result_product);

// dem don hang
$sql_donhang = "SELECT COUNT(*) AS total_donhang FROM hoadon";
$result_donhang = mysqli_query($conn, $sql_donhang);
$row_donhang = mysqli_fetch_assoc($result_donhang);

//dem user
$sql_user = "SELECT COUNT(*) AS total_khachhang FROM khachhang";
$result_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_assoc($result_user);
?>
<style>
    body {
        overflow-x: hidden;
    }

    #wrapper {
        min-height: 100vh;
    }

    #sidebar {
        min-width: 250px;
    }

    .product-card img {
        height: 200px;
        object-fit: cover;
    }

    .app-main {
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 15px;
    }
</style>

<div class="app-main">
    <div class="row">
        <!-- Tổng quan các chỉ số -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sản phẩm</h5>
                    <p class="card-text fs-3"><?php echo $row_product['total_product']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Đơn hàng</h5>
                    <p class="card-text fs-3"><?php echo $row_donhang['total_donhang']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="card-text fs-3"><?php echo $row_user['total_khachhang']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng danh sách sản phẩm mới -->
    <!-- Bảng danh sách đơn hàng mới -->
    <div class="card mt-2">
        <div class="card-header">
            Đơn hàng mới
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Tên Người Đặt</th>
                        <th>Ngày Đặt Hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_donhang_moi = "SELECT hd.MA_HD, hd.TEN_NN, hd.NGAY_HD
                                    FROM hoadon hd
                                    ORDER BY hd.NGAY_HD DESC
                                    LIMIT 5";
                    $result_donhang_moi = mysqli_query($conn, $sql_donhang_moi);

                    while ($row = mysqli_fetch_assoc($result_donhang_moi)) {
                        echo "<tr>";
                        echo "<td>" . $row['MA_HD'] . "</td>";
                        echo "<td>" . $row['TEN_NN'] . "</td>";
                        echo "<td>" . date("d/m/Y", strtotime($row['NGAY_HD'])) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>