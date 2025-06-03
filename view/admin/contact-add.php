<?php
require_once("../check/check_admin.php");
include_once("../../config/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $sql = "INSERT INTO lienhe (TEN_LH) VALUES ('$ten')";
    mysqli_query($conn, $sql);
    header("Location:  contact.php");
    exit;
}
?>
<?php include_once("../layout/sidebar.php");?>
<div class="container mt-4">
    <h2>Thêm liên hệ</h2>
    <form method="post">
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="ten" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
    </form>
</div>