<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $noidung = $_POST['noidung'];

    $sql = "INSERT INTO lienhe (ten, email, noidung) VALUES ('$ten', '$email', '$noidung')";
    mysqli_query($conn, $sql);
    header("Location:  contact.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Thêm liên hệ</h2>
    <form method="post">
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="ten" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="noidung" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>