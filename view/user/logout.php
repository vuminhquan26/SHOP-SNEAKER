<?php   
    session_start();
    session_destroy(); // hủy phiên làm việc
    header("location: login.php");
?>