<?php
session_start();
header('Content-Type: application/json');
require_once '../pdo.php';
require_once '../user.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vui lòng đăng nhập để tiếp tục.']);
    exit();
}

$user_id = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = trim($_POST['current_password'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (!checkUserPassword($user_id, $current_password)) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu hiện tại không đúng.']);
        exit();
    }

    if ($new_password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu mới và xác nhận mật khẩu không khớp.']);
        exit();
    }

    // Kiểm tra độ dài mật khẩu mới (tùy chọn)
    if (strlen($new_password) < 6) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu mới phải có ít nhất 6 ký tự.']);
        exit();
    }


    updateUserPassword($user_id, $new_password);

    echo json_encode(['status' => 'success', 'message' => 'Đổi mật khẩu thành công!']);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
exit();
