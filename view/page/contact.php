<?php
require("../check/check_user.php");
include_once("../layout/header.php"); 
include("../../config/config.php");

$thongBao = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_kh = $_SESSION['user_id'];
    $noidung = $_POST['message'];

    // Kiểm tra nếu có dữ liệu thì mới chèn
    if ($noidung != "" && $ma_kh != "") {
        $sql = "INSERT INTO feedback (NOIDUNG, MA_KH) VALUES ('$noidung', '$ma_kh')";
        $kq = mysqli_query($conn, $sql);

        if ($kq) {
            $thongBao = "<div class='alert alert-success mt-4'>✔️ Cảm ơn bạn đã phản hồi! Chúng tôi sẽ liên hệ với bạn sớm nhất (trong vòng 3 ngày).</div>";
        } else {
            $thongBao = "<div class='alert alert-danger mt-4'>❌ Gửi phản hồi thất bại.</div>";
        }
    } else {
        $thongBao = "<div class='alert alert-warning mt-4'>⚠️ Vui lòng nhập đầy đủ nội dung.</div>";
    }
}
?>

<?php
   $thongBao = '';
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $thongBao = "<div class='alert alert-success mt-4'>✔️ Cảm ơn bạn đã phản hồi! Chúng tôi sẽ liên hệ với bạn sớm nhất (trong vòng 3 ngày).</div>";
   }
   ?>

<style>
    .banner-contact {
        height: 300px;
        background: url('../../assets/images/banner-contact.jpg') center/cover no-repeat;
        color: white;
        position: relative;
    }

    .banner-background {
        background: rgba(0, 0, 0, 0.4);
        z-index: 0;
    }

    .banner-content {
        position: relative;
        z-index: 1;
    }

    .form-control,
    .btn {
        border-radius: 8px;
    }

    .alert {
        font-weight: bold;
        font-size: 16px;
    }

    .contact-info h4 {
        font-weight: bold;
    }

    .contact-info a {
        color: #333;
        text-decoration: none;
    }

    .contact-info a:hover {
        text-decoration: underline;
    }
    form label{
        color: white;
    }
</style>

<div class="banner-contact d-flex align-items-center justify-content-center text-center mb-5">
    <div class="banner-content">
        <h1 class="display-5 fw-bold">Liên hệ với chúng tôi</h1>
        <p class="lead">Chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
    </div>
    <div class="banner-background position-absolute top-0 start-0 w-100 h-100"></div>
</div>

<div class="container mb-5" style="max-width: 800px;">
    <div class="text-center mb-4">
        <h2 class="mb-3">Gửi tin nhắn nhanh</h2>
        <p>Điền vào biểu mẫu dưới đây và chúng tôi sẽ liên hệ lại với bạn.</p>
    </div>

    <?= $thongBao ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="message" class="form-label">Nội dung</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nội dung tin nhắn..." required></textarea>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-dark px-4">Gửi</button>
        </div>
    </form>
</div>

<?php include_once("../layout/footer.php"); ?>