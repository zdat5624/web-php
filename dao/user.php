<?php


function getAllUsers()
{
    $sql = "SELECT * FROM users";
    return pdo_query($sql);
}

function updateUser($id, $email, $password, $name, $address, $phone, $role)
{
    $sql = "UPDATE users 
            SET email = ?, password = ?, name = ?, address = ?, phone = ?, role = ?
            WHERE id = ?";
    pdo_execute($sql, $email, $password, $name, $address, $phone, $role, $id);
}

// function deleteUserById($id)
// {
//     $sql = "DELETE FROM users WHERE id = ?";
//     pdo_execute($sql, $id);
// }

function deleteUserById($id)
{
    $conn = null;
    try {
        $conn = pdo_get_connection();
        // Bắt đầu giao dịch
        $conn->beginTransaction();

        // 1. Lấy danh sách cart_id của người dùng
        $sql = "SELECT id FROM carts WHERE user_id = ?";
        $cart_ids = pdo_query($sql, $id);

        // 2. Xóa dữ liệu liên quan đến giỏ hàng
        foreach ($cart_ids as $cart) {
            $cart_id = $cart['id'];
            // 2.1. Xóa các bản ghi trong cart_detail
            $sql = "DELETE FROM cart_detail WHERE cart_id = ?";
            pdo_execute($sql, $cart_id);

            // 2.2. Xóa các bản ghi trong vnpay_check
            $sql = "DELETE FROM vnpay_check WHERE cart_id = ?";
            pdo_execute($sql, $cart_id);
        }

        // 3. Xóa tất cả giỏ hàng của người dùng
        $sql = "DELETE FROM carts WHERE user_id = ?";
        pdo_execute($sql, $id);

        // 4. Lấy danh sách order_id của người dùng
        $sql = "SELECT id FROM orders WHERE user_id = ?";
        $order_ids = pdo_query($sql, $id);

        // 5. Xóa dữ liệu liên quan đến đơn hàng
        foreach ($order_ids as $order) {
            $order_id = $order['id'];
            // 5.1. Xóa các bản ghi trong order_detail
            $sql = "DELETE FROM order_detail WHERE order_id = ?";
            pdo_execute($sql, $order_id);
        }

        // 6. Xóa tất cả đơn hàng của người dùng
        $sql = "DELETE FROM orders WHERE user_id = ?";
        pdo_execute($sql, $id);

        // 7. Xóa tất cả token xác thực của người dùng
        $sql = "DELETE FROM verify_token WHERE user_id = ?";
        pdo_execute($sql, $id);

        // 8. Xóa bản ghi trong users
        $sql = "DELETE FROM users WHERE id = ?";
        pdo_execute($sql, $id);

        // Kết thúc giao dịch
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Hoàn tác giao dịch nếu có lỗi
        if ($conn) {
            $conn->rollBack();
        }
        // Lưu thông báo lỗi
        $_SESSION['error'] = $e->getMessage();
        return false;
    } finally {
        // Đóng kết nối
        if ($conn) {
            unset($conn);
        }
    }
}

function getUserById($id)
{
    $sql = "SELECT * FROM users WHERE id = ?";
    return pdo_query_one($sql, $id);
}


function addUser($email, $password, $name, $address, $phone, $role)
{
    $sql = "INSERT INTO users (email, password, name, address, phone, role)
            VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $email, $password, $name, $address, $phone, $role);
}

function getUsersWithSort($pageSize, $offset, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT * FROM users u
            WHERE 1=1 ";

    $sort_list = ['id', 'email', 'name', 'address', 'role'];
    $sort = in_array($sort, $sort_list) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $sql .= " ORDER BY u.$sort $order";
    $sql .= " LIMIT $offset , $pageSize";
    return pdo_query($sql);
}

function getTotalUsers()
{
    $sql = "SELECT COUNT(*) FROM users";

    return (int)pdo_query_value($sql);
}

function user_login($username, $password)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $user = pdo_query_one($sql, $username);

    if ($user && $user['password'] === $password) {
        return $user;
    }
    return false;
}


function checkEmailExists($email)
{
    $sql = "SELECT id FROM users WHERE email = ? ";
    $user = pdo_query_one($sql, $email);
    return $user !== false;
}

function getUserByEmail($email)
{
    $sql = "SELECT * FROM users WHERE email = ? ";
    $user = pdo_query_one($sql, $email);
    return $user;
}

function updateUserProfile($id, $name, $address, $phone)
{
    $sql = "UPDATE users
            SET name = ?, address = ?, phone = ?
            WHERE id = ?";
    pdo_execute($sql, $name, $address, $phone, $id);
}


function checkUserPassword($id, $password)
{
    $sql = "SELECT password FROM users WHERE id = ?";
    $user = pdo_query_one($sql, $id);
    if ($user && $user['password'] === $password) {
        return true;
    }
    return false;
}

function updateUserPassword($id, $password)
{
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    pdo_execute($sql, $password, $id);
}

function registerUser($email, $password, $name, $address, $phone)
{
    $role = 'USER';
    $sql = "INSERT INTO users (email, password, name, address, phone, role)
            VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $email, $password, $name, $address, $phone, $role);


    $sql = "SELECT * FROM users WHERE email = ?";
    return pdo_query_one($sql, $email);
}


function isEmailExists($email, $exclude_id = null)
{
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    if ($exclude_id !== null) {
        $sql .= " AND id != ?";
        return pdo_query_value($sql, $email, $exclude_id) > 0;
    }
    return pdo_query_value($sql, $email) > 0;
}
