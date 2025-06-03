<?php 
require("../check/check_user.php");
include_once("../layout/header.php"); 
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Chi Tiết Sản Phẩm</h1>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Mã sản phẩm</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng</th>
                <th scope="col">Kích cỡ</th>
                <th scope="col">Màu sắc</th>
                <th scope="col">Giá</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
           
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<?php
include_once("../layout/footer.php");
?>