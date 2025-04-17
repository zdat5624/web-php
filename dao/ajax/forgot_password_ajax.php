<?php
header('Content-Type: application/json');
require_once "../pdo.php";
require_once "../../PHPMailer/sendmail_verify_token.php";



if (isset($_POST['forgot_password']) && isset($_POST['email'])) {
    $email = $_POST['email'];

    // Kiểm tra email tồn tại
    $sql = "SELECT * FROM users WHERE email = ?";
    $user = pdo_query_one($sql, $email);

    if (!$user) {
        $response['message'] = 'Email không tồn tại trong hệ thống.';
        echo json_encode($response);
        exit;
    }

    // Tạo và lưu token
    $token = bin2hex(random_bytes(32));
    $expire_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $sql = "INSERT INTO verify_token (token, expired_at, user_id) VALUES (?, ?, ?)";
    pdo_execute($sql, $token, $expire_at, $user['id']);


    // Gửi email
    $emailResult = sendResetPasswordEmail($email, $token);
    $response = $emailResult;
    echo json_encode($response);
    exit;
}
