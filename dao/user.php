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

function deleteUserById($id)
{
    $sql = "DELETE FROM users WHERE id = ?";
    pdo_execute($sql, $id);
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
