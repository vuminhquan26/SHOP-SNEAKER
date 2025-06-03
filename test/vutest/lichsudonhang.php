<?php
session_start();
include('../../view/layout/header.php'); // Giao diện bạn đã gửi
require('../../config/config.php');

// Giả sử ID người dùng lưu trong session khi đăng nhập
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "<p style='color:white; text-align:center'>Vui lòng đăng nhập để xem lịch sử đơn hàng.</p>";
    exit;
}

// Lấy danh sách đơn hàng
$sql = "SELECT id, created_at, status, total_price FROM orders WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch sử đơn hàng</title>
    <style>
        body {
            background-color: #2d2f36;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .history-table {
            width: 90%;
            margin: 30px auto;
            background: #3b3d45;
            border-radius: 12px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #555;
            text-align: center;
        }
        th {
            background-color: #444;
        }
    </style>
</head>
<body>

<div class="history-table">
    <h2 style="text-align:center;">Lịch sử đơn hàng của bạn</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($row['created_at'])) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= number_format($row['total_price'], 0, ',', '.') ?>₫</td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center;">Bạn chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>

</body>
</html>
