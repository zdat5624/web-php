<?php
session_start();
require_once '../pdo.php';
require_once '../user.php';

// Xử lý yêu cầu đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Email không hợp lệ.']);
        exit();
    }

    // Kiểm tra email đã tồn tại
    if (checkEmailExists($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email đã được sử dụng.']);
        exit();
    }

    // Kiểm tra mật khẩu khớp
    if ($password !== $confirm_password) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu và xác nhận mật khẩu không khớp.']);
        exit();
    }

    // Kiểm tra độ dài mật khẩu
    if (strlen($password) < 6) {
        echo json_encode(['status' => 'error', 'message' => 'Mật khẩu phải có ít nhất 6 ký tự.']);
        exit();
    }

    // Đăng ký người dùng
    $user = registerUser($email, $password, $name, $address, $phone);

    // Lưu thông tin người dùng vào session
    $_SESSION['user'] = $user;

    echo json_encode(['status' => 'success', 'message' => 'Đăng ký thành công!']);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']);
exit();
