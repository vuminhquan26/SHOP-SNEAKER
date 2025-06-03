<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Ảnh có thanh trượt</title>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Lexend';
        }

        /* CSS để định kiểu cho phần tử chứa ảnh */
        .viewer {
            text-align: center;
            /* Căn giữa ảnh */
            margin-bottom: 20px;
            /* Khoảng cách dưới ảnh */
        }

        /* CSS cho ảnh trong phần tử .viewer */
        .viewer img {
            width: 897px;
            /* Kích thước chiều rộng ảnh */
            height: 636px;
            /* Kích thước chiều cao ảnh */
            object-fit: cover;
            /* Đảm bảo ảnh sẽ bao phủ toàn bộ không gian mà không bị biến dạng */
            border: 2px solid #ccc;
            /* Viền ảnh */
            cursor: pointer;
            /* Khi di chuột vào ảnh sẽ hiển thị con trỏ dạng tay */
        }

        /* CSS cho các nút mũi tên */
        .arrow {
            position: absolute;
            /* Đặt vị trí tuyệt đối của các nút mũi tên */
            top: 50%;
            /* Đặt nút mũi tên ở giữa theo chiều dọc */
            transform: translateY(-50%);
            /* Đảm bảo nút mũi tên chính xác ở giữa */
            background-color: white;
            /* Màu nền trắng cho nút mũi tên */
            border: 1px solid #ccc;
            /* Viền nút mũi tên */
            cursor: pointer;
            /* Khi di chuột vào nút mũi tên sẽ hiển thị con trỏ tay */
            font-size: 30px;
            /* Kích thước chữ trong nút */
            padding: 10px;
            /* Khoảng cách giữa các chữ và viền của nút */
            z-index: 1;
            /* Đảm bảo các nút mũi tên hiển thị trên ảnh */
        }

        /* CSS cho nút mũi tên trái */
        .arrow.left {
            left: 0;
            /* Đặt nút mũi tên trái ở cạnh trái */
        }

        /* CSS cho nút mũi tên phải */
        .arrow.right {
            right: 0;
            /* Đặt nút mũi tên phải ở cạnh phải */
        }
    </style>
</head>

<body>

    <h2 style="text-align:center">Ảnh sản phẩm có thanh trượt</h2> <!-- Tiêu đề của trang web -->

    <!-- Phần tử chứa ảnh chính -->
    <div class="viewer">
        <!-- Ảnh chính, khi click vào ảnh sẽ gọi hàm nextImage() để chuyển sang ảnh tiếp theo -->
        <img id="mainImage" src="../image/product/af1/download (1).png" alt="Ảnh chính" onclick="nextImage()">
    </div>

    <!-- Nút mũi tên trái để quay lại ảnh trước -->
    <div class="arrow left" onclick="prevImage()">&#10094;</div>

    <!-- Nút mũi tên phải để chuyển đến ảnh tiếp theo -->
    <div class="arrow right" onclick="nextImage()">&#10095;</div>

    <script>
        // Biến lưu vị trí ảnh hiện tại
        let currentPosition = 0;

        // Mảng chứa danh sách các ảnh cần hiển thị
        const images = [
            "../image/product/af1/download (1).png",
            "../image/product/af1/download (2).png",
            "../image/product/af1/download (3).png",
            "../image/product/af1/download (4).png",
            "../image/product/af1/download (5).png",
            "../image/product/af1/download (6).png",
            "../image/product/af1/download (7).png",
            "../image/product/af1/download (8).png",
            "../image/product/af1/download (9).png",
            "../image/product/af1/download (10).png",
            "../image/product/af1/download (11).png",
            "../image/product/af1/download (12).png",
            "../image/product/af1/download (13).png",
            "../image/product/af1/download (14).png",
            "../image/product/af1/download (15).png",
            "../image/product/af1/download (16).png",
            "../image/product/af1/download (17).png",
            "../image/product/af1/download (18).png",
            "../image/product/af1/download (19).png",
            "../image/product/af1/download (20).png",
            "../image/product/af1/download (21).png",
            "../image/product/af1/download (22).png",
            "../image/product/af1/download (23).png",
            "../image/product/af1/download (24).png",
            "../image/product/af1/download (25).png",
            "../image/product/af1/download (26).png",
            "../image/product/af1/download (27).png",
            "../image/product/af1/download (28).png"
        ];

        // Lấy phần tử ảnh chính từ DOM
        const mainImage = document.getElementById("mainImage");

        // Hàm hiển thị ảnh hiện tại (theo vị trí trong mảng images)
        function showImage() {
            mainImage.src = images[currentPosition]; // Cập nhật thuộc tính src của ảnh chính
        }

        // Hàm chuyển đến ảnh tiếp theo
        function nextImage() {
            currentPosition = (currentPosition + 1) % images.length; // Tăng vị trí và nếu vượt quá số ảnh, quay lại ảnh đầu tiên
            showImage(); // Gọi hàm hiển thị ảnh mới
        }

        // Hàm quay lại ảnh trước
        function prevImage() {
            currentPosition = (currentPosition - 1 + images.length) % images.length; // Giảm vị trí và nếu là ảnh đầu tiên, quay lại ảnh cuối cùng
            showImage(); // Gọi hàm hiển thị ảnh mới
        }
    </script>

</body>

</html>