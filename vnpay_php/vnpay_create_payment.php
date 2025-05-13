<?php
header('Content-Type: application/json');
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * 
 *
 * @author CTT VNPAY
 */
require_once("./config.php");
require_once("../dao/pdo.php");
require_once("../dao/cart.php");
require_once("../dao/vnpay_check.php");

$response = ['status' => 'error', 'message' => 'Có lỗi xảy ra'];

// Kiểm tra đăng nhập
if (!isset($_SESSION['user']['id'])) {
    $response['message'] = 'Vui lòng đăng nhập để đặt hàng';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['user']['id'];
$cart = getCartByUserId($user_id);

if (!$cart || !is_array($cart)) {
    $response['message'] = 'Giỏ hàng không tồn tại';
    echo json_encode($response);
    exit;
}

if ($cart['total_price'] <= 0) {
    $response['message'] = 'Giỏ hàng không hợp lệ';
    echo json_encode($response);
    exit;
}

$phone = $_POST['phone'] ?? '';
$receiver_name = $_POST['receiver_name'] ?? '';
$address = $_POST['full_address'] ?? '';

if (!$phone || !$receiver_name || !$address) {
    echo json_encode(['status' => 'error', 'message' => 'Thông tin không hợp lệ']);
    exit;
}

$vnpay_check = get_pending_vnpay_check_by_cart_id($cart['id']);

if ($vnpay_check) {
    $sql = "UPDATE vnpay_check SET phone = ?, receiver_name = ?, address = ? WHERE id = ?";
    pdo_execute($sql, $phone, $receiver_name, $address, $vnpay_check['id']);

    //error_log("vnpay_check updated: id=" . $vnpay_check['id'] . ", link=" . $vnpay_check['link']);

    echo json_encode([
        'status' => 'success',
        'message' => 'Cập nhật thông tin thanh toán thành công',
        'url' => $vnpay_check['link']
    ]);
    exit;
}

$vnp_TxnRef = rand(1, 99999999); //Mã giao dịch thanh toán tham chiếu của merchant
$vnp_Amount = $cart['total_price']; // Số tiền thanh toán
$vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
$vnp_BankCode = 'VNBANK'; //Mã phương thức thanh toán
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toán GD: " . $vnp_TxnRef,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}



vnpay_check_create($vnp_TxnRef, $phone, $receiver_name, $address, $vnp_Url, $expired_at, $cart['id']);
echo json_encode([
    'status' => 'success',
    'message' => 'Tạo yêu cầu thanh toán thành công',
    'url' => $vnp_Url
]);
exit;
