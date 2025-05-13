<?php

function vnpay_check_create($vnpay_TxnRef, $phone, $receiver_name, $address, $link, $expired_at, $cart_id)
{
    $sql = "INSERT INTO vnpay_check (
                vnpay_TxnRef, phone, receiver_name, address, link, expired_at, order_id, cart_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    pdo_execute($sql, $vnpay_TxnRef, $phone, $receiver_name, $address, $link, $expired_at, null, $cart_id);
}

function get_vnpay_check_by_vnpay_TxnRef($vnpay_TxnRef)
{
    $sql = "SELECT * FROM vnpay_check  WHERE vnpay_TxnRef = ?";
    return pdo_query_one($sql, $vnpay_TxnRef);
}


function updateVnpayCheck($txn_ref, $order_id)
{
    $sql = "UPDATE vnpay_check SET order_id = ? WHERE vnpay_TxnRef = ?";
    pdo_execute($sql, $order_id, $txn_ref);
}

function update_vnp_ResponseCode($txn_ref, $code)
{
    $sql = "UPDATE vnpay_check SET vnpay_ResponseCode = ? WHERE vnpay_TxnRef = ?";
    pdo_execute($sql, $code, $txn_ref);
}

function get_pending_vnpay_check_by_cart_id($cart_id)
{
    $sql = "SELECT * FROM vnpay_check
            WHERE cart_id = ? AND vnpay_ResponseCode IS NULL AND expired_at > NOW()
            ORDER BY id DESC";
    return pdo_query_one($sql, $cart_id);
}
