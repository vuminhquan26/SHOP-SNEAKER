<?php
require("../check/check_user.php");
include_once("../layout/header.php");
?>

<style>
    body {
        background-color: #343a40;
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

        .related-product img {
            height: 200px;
            object-fit: cover;
        }
    </style>
<main>
    <div class="container mt-5 text-center">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQCiV8sN8H8N-4bpv1AG4Q_FteF-DcBj269LQ&s" alt="Thank You" class="img-fluid my-4" style="max-width: 700px;">
        <h1 class="text-white display-3">CẢM ƠN BẠN ĐÃ ĐẶT HÀNG!</h1>
        <p class="mt-3 text-white">Đơn hàng của bạn đã được ghi nhận và đang trong quá trình xử lý.</p>
        <a href="home.php" class="btn btn-dark mt-3">Về Trang Chủ</a>
    </div>
</main>
<?php
include_once(__DIR__ . "/../layout/footer.php");
?>