<?php
session_start();
require_once "../pdo.php";
require_once "../user.php";

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Đã có lỗi xảy ra.'];

if (isset($_POST['reset_password']) && isset($_POST['token']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
    $token = trim($_POST['token']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $user = pdo_query_one($sql, $email);

    if (!$user) {
        $response['message'] = 'Không tồn tại user email ' . $email . '.';
        echo json_encode($response);
        exit;
    }

    // Kiểm tra mật khẩu khớp
    if ($new_password !== $confirm_password) {
        $response['message'] = 'Mật khẩu xác nhận không khớp.';
        echo json_encode($response);
        exit;
    }

    // Kiểm tra token
    $sql = "SELECT user_id, expired_at FROM verify_token WHERE token = ?";
    $tokenData = pdo_query_one($sql, $token);

    if (!$tokenData || strtotime($tokenData['expired_at']) < time() || $tokenData['user_id'] !== $user['id']) {
        $response['message'] = 'Liên kết không hợp lệ hoặc đã hết hạn.';
        echo json_encode($response);
        exit;
    }

    if (strlen($new_password) < 6) {
        $response['message'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
        echo json_encode($response);
        exit;
    }


    // Cập nhật mật khẩu
    updateUserPassword($tokenData['user_id'], $new_password);


    // Xóa token
    $sql = "DELETE FROM verify_token WHERE token = ?";
    pdo_execute($sql, $token);

    $response['status'] = 'success';
    $response['message'] = 'Mật khẩu đã được đặt lại thành công!';
}

echo json_encode($response);
