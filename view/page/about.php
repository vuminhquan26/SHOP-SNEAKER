<?php include_once("../layout/header.php"); ?>
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #050505;
    }

    .feed-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px 15px;
    }

    .post {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        padding: 15px;
    }

    .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .post-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .post-header .user-info {
        font-weight: bold;
        font-size: 1rem;
    }

    .post-header .time {
        font-size: 0.85rem;
        color: gray;
    }

    .post img.post-img {
        width: 100%;
        border-radius: 10px;
        margin-top: 10px;
    }

    .post-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1877f2;
        margin-top: 10px;
    }

    .post-content {
        margin-top: 10px;
        line-height: 1.6;
        text-align: justify;
        color: #1c1e21;
    }
</style>
<main>
<div class="feed-container">

    <!-- Post 1 -->
    <div class="post">
        <div class="post-header">
            <img src="../../image/logo/store_logo/2(1).png" alt="Avatar">
            <div>
                <div class="user-info">GLITCH SOLE</div>
                <div class="time">1 ngày trước</div>
            </div>
        </div>
        <div class="post-title">F4 Sneaker</div>
        <div class="post-content">
            Mỗi thương hiệu lớn đều bắt đầu từ một ý tưởng nhỏ, và công ty của chúng tôi cũng không ngoại lệ.
            Xuất phát từ niềm đam mê với giày sneaker và mong muốn mang đến cho cộng đồng những sản phẩm chất lượng,
            chúng tôi đã cùng nhau xây dựng một thương hiệu chuyên biệt...
        </div>
        <img class="post-img" src="https://marketplace.canva.com/EAFrvc38NU0/1/0/1600w/canva-green-and-black-modern-roadmap-timeline-brainstorm-PYBWIR-5Alc.jpg" alt="F4 Sneaker">
    </div>

    <!-- Post 2 -->
    <div class="post">
        <div class="post-header">
            <img src="../../image/logo/store_logo/2(1).png" alt="Avatar">
            <div>
                <div class="user-info">GLITCH SOLE</div>
                <div class="time">2 ngày trước </div>
            </div>
        </div>
        <div class="post-title">Quá trình</div>
        <div class="post-content">
            Ban đầu, chúng tôi chỉ là một nhóm nhỏ những người yêu sneaker, thường xuyên chia sẻ các mẫu giày mới,
            trao đổi về công nghệ sản xuất và xu hướng thị trường...
        </div>
        <img class="post-img" src="https://img.freepik.com/free-vector/flat-roadmap-infographic-template_23-2149039951.jpg?semt=ais_hybrid&w=740" alt="Quá trình">
    </div>

    <!-- Post 3 -->
    <div class="post">
        <div class="post-header">
            <img src="../../image/logo/store_logo/2(1).png" alt="Avatar">
            <div>
                <div class="user-info">GLITCH SOLE</div>
                <div class="time">3 ngày trước</div>
            </div>
        </div>
        <div class="post-title">Mục tiêu</div>
        <div class="post-content">
            Chúng tôi không chỉ tập trung vào việc bán giày, mà còn chú trọng vào trải nghiệm của khách hàng.
            Từng sản phẩm được thiết kế với sự tỉ mỉ, ứng dụng công nghệ tiên tiến để mang đến sự thoải mái...
        </div>
        <img class="post-img" src="https://infograpia.com/cdn/shop/products/roadmap-slides-powerpoint-keynote-google-slides-preview-5.jpg?v=1579552569" alt="Mục tiêu">
    </div>

</div>
</main>
<?php include_once("../layout/footer.php"); ?>