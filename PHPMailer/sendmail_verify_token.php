<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/src/Exception.php';
require __DIR__ . '/src/PHPMailer.php';
require __DIR__ . '/src/SMTP.php';

function sendResetPasswordEmail($recipientEmail, $token)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'zdat5624@gmail.com'; // Email
        $mail->Password = 'eniz oucp kjri achq'; // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Recipients
        $mail->setFrom('zdat5624@gmail.com', 'XLaptopshop');
        $mail->addAddress($recipientEmail);
        $mail->addReplyTo('zdat5624@gmail.com', 'XLaptopshop');

        // Content
        $reset_link = "http://localhost:3000//index.php?pg=reset_password&email=$recipientEmail&token=" . $token;
        $mail->isHTML(true);
        $mail->Subject = 'Đặt lại mật khẩu XLaptopshop';
        $mail->Body = "
            <h3>Đặt lại mật khẩu</h3>
            <p>Nhấp vào liên kết sau để đặt lại mật khẩu của bạn: <a href='$reset_link'>Link</a> </p>
            <p>Liên kết này sẽ hết hạn sau 1 giờ.</p>
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
        ";
        $mail->AltBody = "Nhấp vào liên kết để đặt lại mật khẩu: $reset_link \nLiên kết này sẽ hết hạn sau 1 giờ.";

        $mail->send();
        return ['status' => 'success', 'message' => 'Email đã được gửi.'];
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => "Không thể gửi email. Lỗi: {$e}"];
    }
}

if (isset($_GET['test'])) {
    $testEmail = 'zdat524@gmail.com';
    $testToken = 'sample_token abc';
    $result = sendResetPasswordEmail($testEmail, $testToken);
    echo json_encode($result);
}
