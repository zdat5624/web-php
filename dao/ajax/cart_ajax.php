<?php
session_start();
require_once "../pdo.php";
require_once "../cart.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!']);
    exit();
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $user_id = $_SESSION['user']['id'];

    // Kiểm tra giỏ hàng của người dùng
    $cart = getCartByUserId($user_id);
    if (!$cart) {
        $cart = createCart($user_id);
    }

    // Thêm sản phẩm vào chi tiết giỏ
    addToCartDetail($cart['id'], $product_id, $quantity);

    // Cập nhật tổng giá
    updateCartTotalPrice($cart['id']);

    echo json_encode(['status' => 'success', 'message' => 'Đã thêm sản phẩm vào giỏ hàng thành công!']);
    exit();
}

if (isset($_POST['get_cart_count'])) {
    $user_id = $_SESSION['user']['id'];
    $cart = getCartByUserId($user_id);
    $cart_count = 0;

    if ($cart) {
        $cart_details = getCartDetails($cart['id']);
        $cart_count = count($cart_details);
    }

    $response['status'] = 'success';
    $response['cart_count'] = $cart_count;
    echo json_encode($response);
    exit();
}

if (isset($_POST['get_cart_summary'])) {

    $user_id = $_SESSION['user']['id'];

    $cart = getCartByUserId($user_id);
    if ($cart) {
        createCart($user_id);
    }

    updateCartTotalPrice($cart_id);

    $response = getCartByUserId($user_id);

    echo json_encode($response['total_price']);
    exit();
}

if (isset($_POST['update_cart_item'])) {
    $cart_detail_id = $_POST['cart_detail_id'];
    $quantity = (int)$_POST['quantity'];
    $user_id = $_SESSION['user']['id'];

    $cart = getCartByUserId($user_id);
    if (!$cart) {
        echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng không tồn tại!']);
        exit();
    }

    $sql = "UPDATE cart_detail SET quantity = ? WHERE id = ? AND cart_id = ?";
    pdo_execute($sql, $quantity, $cart_detail_id, $cart['id']);

    $sql = "SELECT cd.quantity, p.price
            FROM cart_detail cd
            JOIN products p ON cd.product_id = p.id
            WHERE cd.id = ?";
    $item = pdo_query_one($sql, $cart_detail_id);
    $item_total = $item['quantity'] * $item['price'];


    updateCartTotalPrice($cart['id']);
    $cart = getCartByUserId($user_id);

    echo json_encode([
        'status' => 'success',
        'message' => 'Đã cập nhật số lượng!',
        'total_price' => $cart['total_price'],
        'item_total' => $item_total
    ]);
    exit();
}

if (isset($_POST['remove_cart_item'])) {
    $cart_detail_id = $_POST['cart_detail_id'];
    $user_id = $_SESSION['user']['id'];

    $cart = getCartByUserId($user_id);
    if (!$cart) {
        echo json_encode(['status' => 'error', 'message' => 'Giỏ hàng không tồn tại!']);
        exit();
    }

    $sql = "DELETE FROM cart_detail WHERE id = ? AND cart_id = ?";
    pdo_execute($sql, $cart_detail_id, $cart['id']);

    updateCartTotalPrice($cart['id']);
    $cart = getCartByUserId($user_id);

    $cart_details = getCartDetails($cart['id']);
    $cart_count = count($cart_details);

    echo json_encode([
        'status' => 'success',
        'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!',
        'total_price' => $cart['total_price'],
        'cart_count' => $cart_count
    ]);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
