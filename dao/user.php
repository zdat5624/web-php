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
