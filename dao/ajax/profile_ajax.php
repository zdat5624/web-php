<?php
session_start();
require_once '../pdo.php';
require_once '../user.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vui lòng đăng nhập để tiếp tục.']);
    exit();
}

$user_id = $_SESSION['user']['id'];

// Xử lý yêu cầu cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');


    updateUserProfile($user_id, $name, $address, $phone);

    $_SESSION['user'] = getUserById($user_id);

    echo json_encode(['status' => 'success', 'message' => 'Cập nhật thông tin thành công!']);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
exit();
