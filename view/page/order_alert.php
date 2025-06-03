<?php
require("../check/check_user.php");
include_once("../layout/header.php");
?>
    <style>
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
<body>
    <div class="container mt-5">
        <h2 class="text-center text-success">Cảm ơn bạn đã đặt hàng!</h2>
        <p class="text-center">Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ với bạn sớm nhất để xác nhận.</p>
        
        <div class="card mt-4">
            <div class="card-header bg-warning text-dark">
                <h4>Thông tin sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/80" alt="Product Image" class="product-thumbnail">
                    <div>
                        <h5 class="mb-1">Tên sản phẩm: Giày Sneaker A</h5>
                        <p class="mb-0">Số lượng: 1</p>
                        <p class="mb-0">Giá: 500,000 VND</p>
                    </div>
                </div>
                <hr>
                <div class="d-flex align-items-center mb-3">
                    <img src="https://via.placeholder.com/80" alt="Product Image" class="product-thumbnail">
                    <div>
                        <h5 class="mb-1">Tên sản phẩm: Giày Sneaker B</h5>
                        <p class="mb-0">Số lượng: 2</p>
                        <p class="mb-0">Giá: 300,000 VND</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <img src="https://scontent.fhan14-4.fna.fbcdn.net/v/t1.15752-9/491279670_1176650663943829_7855825497719652809_n.jpg?stp=dst-jpg_s526x395_tt6&_nc_cat=102&ccb=1-7&_nc_sid=0024fc&_nc_ohc=zlu2VxmprMAQ7kNvwHQRQKM&_nc_oc=AdljAQRIWkf3hoxm-eYPXxKsrosXZaVhyRkBHqmTVIssdmjORgWJm3KSpP0JO1CicUEUTpnU3d8X8-e_r-ng_nSw&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.fhan14-4.fna&oh=03_Q7cD2AFCinP-_mSmSFy_3NSTKvTKouwdRO2o2iDhjzLcP7uQng&oe=682C32A6">
            <p class="mt-3">Chúng tôi rất trân trọng sự ủng hộ của bạn!</p>
        </div>
    </div>