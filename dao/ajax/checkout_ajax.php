<?php
session_start();
header('Content-Type: application/json');

require_once "../pdo.php";
require_once "../order.php"; // Include hàm createOrder

$response = ['status' => 'error', 'message' => 'Có lỗi xảy ra'];

// Kiểm tra đăng nhập
if (!isset($_SESSION['user']['id'])) {
    $response['message'] = 'Vui lòng đăng nhập để đặt hàng';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user']['id'];

if (isset($_POST['checkout_cod'])) {
    $phone = trim($_POST['phone'] ?? '');
    $receiver_name = trim($_POST['receiver_name'] ?? '');
    $full_address = trim($_POST['full_address'] ?? '');
    $payment = trim($_POST['payment'] ?? '');

    // Kiểm tra dữ liệu đầu vào
    if (empty($phone) || empty($receiver_name) || empty($full_address)) {
        $response['message'] = 'Vui lòng điền đầy đủ thông tin';
        echo json_encode($response);
        exit;
    }

    if ($payment !== 'cod') {
        $response['message'] = 'Phương thức thanh toán không hợp lệ';
        echo json_encode($response);
        exit;
    }

    try {
        $order_id = createOrder($user_id, $phone, $receiver_name, $full_address, $payment);

        $response = [
            'status' => 'success',
            'message' => 'Đặt hàng thành công! Chúng tôi sẽ liên hệ sớm.',
            'order_id' => $order_id
        ];
    } catch (Exception $e) {
        $response['message'] = 'Lỗi khi đặt hàng: ' . $e->getMessage();
    }
}

echo json_encode($response);
