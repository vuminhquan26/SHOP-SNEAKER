<?php
require("../check/check_admin.php");
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy top 3 sản phẩm bán chạy (theo tổng số lượng bán)
$sql_top_selling = "
    SELECT sp.MA_SP, sp.TEN_SP, SUM(ct.SO_LUONG) AS tong_ban
    FROM sanpham sp
    JOIN ct_hoadon ct ON sp.MA_SP = ct.MA_SP
    GROUP BY sp.MA_SP, sp.TEN_SP
    ORDER BY tong_ban DESC
    LIMIT 3
";
$result_top_selling = mysqli_query($conn, $sql_top_selling);

// Lấy top 3 sản phẩm bán ít nhất (có bán)
$sql_least_selling = "
    SELECT sp.MA_SP, sp.TEN_SP, SUM(ct.SO_LUONG) AS tong_ban
    FROM sanpham sp
    JOIN ct_hoadon ct ON sp.MA_SP = ct.MA_SP
    GROUP BY sp.MA_SP, sp.TEN_SP
    HAVING tong_ban > 0
    ORDER BY tong_ban ASC
    LIMIT 3
";
$result_least_selling = mysqli_query($conn, $sql_least_selling);

// Chuẩn bị dữ liệu cho Chart.js (từ top bán chạy)
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result_top_selling)) {
    $labels[] = $row['TEN_SP'];
    $data[] = (int)$row['tong_ban'];
}
?>

<style>
    /* ... giữ nguyên style bạn có ... */
</style>

<div id="page-content" class="w-100">
    <nav class="navbar navbar-light bg-light px-4 shadow-sm">
        <span class="navbar-brand mb-0 h1">Thống kê doanh thu</span>
    </nav>

    <div class="container mt-4">
        <!-- Bảng thống kê -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Bán Chạy</th>
                    <th>Số Lượng</th>
                    <th>Bán Được Ít</th>
                    <th>Số Lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Đổi mảng dữ liệu thành array để dễ xử lý
                $topSellingArr = [];
                mysqli_data_seek($result_top_selling, 0); // reset con trỏ
                while ($row = mysqli_fetch_assoc($result_top_selling)) {
                    $topSellingArr[] = $row;
                }
                $leastSellingArr = [];
                mysqli_data_seek($result_least_selling, 0);
                while ($row = mysqli_fetch_assoc($result_least_selling)) {
                    $leastSellingArr[] = $row;
                }

                // Lấy max số dòng để in bảng
                $maxRows = max(count($topSellingArr), count($leastSellingArr));
                for ($i = 0; $i < $maxRows; $i++):
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= isset($topSellingArr[$i]) ? htmlspecialchars($topSellingArr[$i]['TEN_SP']) : '-' ?></td>
                    <td><?= isset($topSellingArr[$i]) ? (int)$topSellingArr[$i]['tong_ban'] : '-' ?></td>
                    <td><?= isset($leastSellingArr[$i]) ? htmlspecialchars($leastSellingArr[$i]['TEN_SP']) : '-' ?></td>
                    <td><?= isset($leastSellingArr[$i]) ? (int)$leastSellingArr[$i]['tong_ban'] : '-' ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <div id="chartContainer">
            <canvas id="revenueChart" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Số lượng đã bán',
                data: <?= json_encode($data) ?>,
                backgroundColor: '#f4a261'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
