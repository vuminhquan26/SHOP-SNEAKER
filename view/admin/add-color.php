<?php
require_once("../check/check_admin.php");
include_once("../../config/config.php");
$sql = "SELECT * FROM mausac";
$query = mysqli_query($conn, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['TEN_MS'];
    mysqli_query($conn, "INSERT INTO mausac (TEN_MS) VALUES ('$name')");
    header("Location: color.php");
}
?>
<?php include_once("../layout/sidebar.php"); ?>
<div class="container mt-5">
    <h2>Thêm Màu sắc</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="TEN_MS" class="form-label">Tên màu</label>
            <input type="text" class="form-control" id="TEN_MS" name="TEN_MS" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>
