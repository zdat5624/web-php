<?php

function getCartByUserId($user_id)
{
    $sql = "SELECT * FROM carts WHERE user_id = ?";
    return pdo_query_one($sql, $user_id);
}

function getCartById($id)
{
    $sql = "SELECT * FROM carts c WHERE c.id = ?";
    return pdo_query_one($sql, $id);
}

//  tạo giỏ hàng mới
function createCart($user_id)
{
    $existingCart = pdo_query_one("SELECT * FROM carts WHERE user_id = ? LIMIT 1", $user_id);

    if ($existingCart) {
        return $existingCart;
    }

    $sql = "INSERT INTO carts (total_price, user_id) VALUES (0, ?)";
    pdo_execute($sql, $user_id);

    return pdo_query_one("SELECT * FROM carts WHERE user_id = ? LIMIT 1", $user_id);
}

// thêm sản phẩm vào chi tiết giỏ hàng
function addToCartDetail($cart_id, $product_id, $quantity)
{
    $sql = "SELECT * FROM cart_detail WHERE cart_id = ? AND product_id = ?";
    $existing = pdo_query_one($sql, $cart_id, $product_id);

    if ($existing) {
        $new_quantity = $existing['quantity'] + $quantity;
        $sql = "UPDATE cart_detail SET quantity = ? WHERE id = ?";
        pdo_execute($sql, $new_quantity, $existing['id']);
    } else {
        $sql = "INSERT INTO cart_detail (quantity, cart_id, product_id) VALUES (?, ?, ?)";
        pdo_execute($sql, $quantity, $cart_id, $product_id);
    }
}

//cập nhật total price giỏ hàng
function updateCartTotalPrice($cart_id)
{
    $sql = "SELECT SUM(cd.quantity * p.price) as total
            FROM cart_detail cd
            JOIN products p ON cd.product_id = p.id
            WHERE cd.cart_id = ?";
    $total = pdo_query_value($sql, $cart_id);
    $sql = "UPDATE carts SET total_price = ? WHERE id = ?";
    pdo_execute($sql, $total ? $total : 0, $cart_id);
}

// get chi tiết giỏ hàng
function getCartDetails($cart_id)
{
    $sql = "SELECT cd.*, p.name, p.price, p.image
            FROM cart_detail cd
            JOIN products p ON cd.product_id = p.id
            WHERE cd.cart_id = ?";
    return pdo_query($sql, $cart_id);
}
