<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "f4snacker";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $order_details = $_POST['order_details'];
    $total_price = $_POST['total_price'];

    $sql = "INSERT INTO donhang (customer_name, customer_phone, order_details, total_price, created_at) 
            VALUES ('$customer_name', '$customer_phone', '$order_details', '$total_price', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm đơn hàng thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Đơn Hàng</title>
</head>
<body>
    <h1>Thêm Đơn Hàng</h1>
    <form method="POST" action="">
        <label for="customer_name">Tên khách hàng:</label><br>
        <input type="text" id="customer_name" name="customer_name" required><br><br>

        <label for="customer_phone">Số điện thoại:</label><br>
        <input type="text" id="customer_phone" name="customer_phone" required><br><br>

        <label for="order_details">Chi tiết đơn hàng:</label><br>
        <textarea id="order_details" name="order_details" required></textarea><br><br>

        <label for="total_price">Tổng giá:</label><br>
        <input type="number" id="total_price" name="total_price" required><br><br>

        <button type="submit">Thêm Đơn Hàng</button>
    </form>
</body>
</html>