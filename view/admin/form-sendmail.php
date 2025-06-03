<?php 
include_once("../layout/sidebar.php");
include_once("../../config/config.php");
$sql = "SELECT MA_KH FROM khachhang";
$query = mysqli_query($conn, $sql);
// la makh
$ma_kh = "";
if (isset($_GET["MA_KH"])) {
    $ma_kh = $_GET["MA_KH"];
} elseif (isset($_POST["MA_KH"])) {
    $ma_kh = $_POST["MA_KH"];
}
?>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Gửi Email</h5>
                    </div>
                    <div class="card-body">
                        <form action="sendmail.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label"><?php echo"EMAIL"?></label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Nhập email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Tiêu đề</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="subject"
                                    name="subject"
                                    placeholder="Tiêu đề email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung</label>
                                <textarea
                                    class="form-control"
                                    id="message"
                                    name="message"
                                    rows="4"
                                    placeholder="Nội dung email"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Gửi Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
