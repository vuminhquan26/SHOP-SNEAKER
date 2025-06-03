<?php
require("../check/check_admin.php"); 
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

// Lấy toàn bộ phản hồi
$sql_feedback = "SELECT * FROM feedback ORDER BY MA_FB DESC";
$result_feedback = mysqli_query($conn, $sql_feedback);

// Lấy toàn bộ khách hàng để tra cứu
$sql_kh_all = "SELECT MA_KH, TEN_KH, EMAIL, SDT_KH FROM khachhang";
$result_kh_all = mysqli_query($conn, $sql_kh_all);

$khachhangs = [];
while ($row = mysqli_fetch_assoc($result_kh_all)) {
    $khachhangs[$row['MA_KH']] = $row;
}

// Lưu phản hồi vào mảng để dễ xử lý sau
$feedbacks = [];
while ($fb = mysqli_fetch_assoc($result_feedback)) {
    $feedbacks[] = $fb;
}
?>

<body>
<div class="container my-5 bg-white p-4 rounded shadow-sm">
    <h2 class="mb-4 text-center">Danh sách phản hồi khách hàng</h2>

    <?php if (count($feedbacks) > 0): ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th scope="col" style="width:5%">ID</th>
                    <th scope="col" style="width:20%">Khách hàng</th>
                    <th scope="col" style="width:25%">Email</th>
                    <th scope="col">Nội dung phản hồi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbacks as $fb): 
                    if (isset($khachhangs[$fb['MA_KH']])) {
                        $ten_kh = $khachhangs[$fb['MA_KH']]['TEN_KH'];
                        $email_kh = $khachhangs[$fb['MA_KH']]['EMAIL'];
                    } else {
                        $ten_kh = "Không rõ";
                        $email_kh = "Không rõ";
                    }
                    $noidung_fb = $fb['NOIDUNG'];
                ?>
                <tr>
                    <td class="text-center"><?php echo $fb['MA_FB']; ?></td>
                    <td><?php echo $ten_kh; ?></td>
                    <td><?php echo $email_kh; ?></td>
                    <td><?php echo $noidung_fb; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <div class="alert alert-info text-center">Chưa có phản hồi nào.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
