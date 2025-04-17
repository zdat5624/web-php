<?php
session_start();
require_once "../pdo.php";
require_once "../order.php";

header('Content-Type: application/json');

// Kiểm tra quyền admin
if (!isset($_SESSION['user'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Vui lòng đăng nhập để thực hiện thao tác này!'
    ]);
    exit();
}

if ($_SESSION['user']['role'] !== 'ADMIN') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Bạn không có quyền thực hiện thao tác này!'
    ]);
    exit();
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['orderStatus'];
    $order_note = $_POST['orderNote'] ?? '';

    // Validate dữ liệu
    if (empty($order_id) || empty($order_status)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Thiếu thông tin cần thiết!'
        ]);
        exit();
    }

    // Cập nhật đơn hàng
    updateOrderStatus($order_id, $order_status, $order_note);
    $result = getOrderById($order_id);
    if ($result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Cập nhật đơn hàng thành công!',
            'order' => $result,

        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Cập nhật đơn hàng thất bại!'
        ]);
    }
    exit();
}

echo json_encode([
    'status' => 'error',
    'message' => 'Yêu cầu không hợp lệ!'
]);
