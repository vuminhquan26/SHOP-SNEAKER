<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../src/PHPMailer-master/src/PHPMailer.php';
require '../../src/PHPMailer-master/src/SMTP.php';
require '../../src/PHPMailer-master/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vmqtestf4@gmail.com';  // Thay bằng email của bạn
        $mail->Password = 'jyvf jwze kfci uipn';  // Thay bằng app password của bạn
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Người gửi
        $mail->setFrom('vmqtestf4@gmail.com', 'F4 Sneaker');
        // Người nhận
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Gửi email
        $mail->send();

        // Hiển thị thông báo thành công và chuyển hướng
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Thành công!',
                text: 'Email đã được gửi thành công!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'user.php';  // Đường dẫn sau khi gửi thành công
            });
        </script>";
    } catch (Exception $e) {
        // Hiển thị thông báo lỗi
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Thất bại!',
                text: 'Có lỗi xảy ra: {$mail->ErrorInfo}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>
