<!-- sidebar.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F4 Sneaker - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Lexend';
        }

        body {
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        #sidebar {
            width: 250px;
            flex-shrink: 0;
        }

        #sidebar .nav-link {
            color: white;
        }

        #sidebar .nav-link:hover {
            background-color: #495057;
        }

        #page-content {
            flex-grow: 1;
            background-color: #f8f9fa;
            padding: 20px;
        }

        img {
            max-width: 200px;
        }

        .nav-item {
            margin-top: 10px;
        }

        .nav-item a {
            font-size: larger;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="sidebar" class="bg-dark text-white p-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="admin.php"><img src="../../image/logo/store_logo/2(1).png" alt="logo"></a>
                </li>
                <li class="nav-item">
                    <a href="admin.php" class="nav-link text-white"><i class="bi bi-clipboard-data"></i> Trang Chủ</a>
                </li>
                <li class="nav-item">
                    <a href="admin_product.php" class="nav-link text-white"><i class="bi bi-cart4"></i> Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="order.php" class="nav-link text-white"><i class="bi bi-box-seam"></i> Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="user.php" class="nav-link text-white"><i class="bi bi-person-circle"></i> Người dùng</a>
                </li>
                <li class="nav-item">
                    <a href="thongke.php" class="nav-link text-white"><i class="bi bi-graph-up"></i> Thống kê</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link text-white"><i class="bi bi-telephone"></i> Liên hệ</a>
                </li>
                <li class="nav-item">
                    <a href="classify.php" class="nav-link text-white"><i class="bi bi-list-ul"></i> Loại Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="brand.php" class="nav-link text-white"><i class="bi bi-shop-window"></i> Thương Hiệu</a>
                </li>
                <li class="nav-item">
                    <a href="color.php" class="nav-link text-white"><i class="bi bi-palette"></i> Màu Sắc</a>
                </li>
                <li class="nav-item">
                    <a href="list_admin.php" class="nav-link text-white"><i class="bi bi-shield-lock-fill"></i> Quản Lý Admin</a>
                </li>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link text-white"><i class="bi bi-mailbox2"></i> Feedback</a>
                </li>
                <li class="nav-item">
                    <a href="../../view/user/logout.php" class="nav-link text-white"><i class="bi bi-box-arrow-right"></i> Đăng Xuất</a>
                </li>
                
            </ul>
        </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.js"></script>