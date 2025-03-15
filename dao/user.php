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
