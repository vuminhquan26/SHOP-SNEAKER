<?php
$conn = mysqli_connect("localhost", "root", "", "ten_database");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>