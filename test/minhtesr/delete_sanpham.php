<?php
require_once 'config.php';
$id = !empty($_GET['id']) ? ($_GET['id']) : 0;
if ($id > 0) {
    $sql = "DELETE FROM sanpham WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: success.php");
    } else {
        header("Location: fail.php");
    }
}
mysqli_close($conn);
?>
