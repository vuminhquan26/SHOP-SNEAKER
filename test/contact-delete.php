<?php
include_once("../layout/sidebar.php");
include_once("../../config/config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM lienhe WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $email = $_POST['email'];
    $noidung = $_POST['noidung'];

    $sql = "UPDATE lienhe SET ten='$ten', email='$email', noidung='$noidung' WHERE id=$id";
    mysqli_query($conn, $sql);
    header("Location: contact.php");
    exit;
}
?>

<div class="container mt-4">
    <h2>Sửa liên hệ</h2>
    <form method="post">
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="ten" class="form-control" value="<?= htmlspecialchars($row['ten']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="noidung" class="form-control" required><?= htmlspecialchars($row['noidung']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>