<?php


function getAllCategories()
{
    $sql = "SELECT * FROM categories ORDER BY order_number";
    return pdo_query($sql);
}

function addCategory($name, $order_number)
{
    $sql = "INSERT INTO categories (name, order_number) VALUES (?, ?)";
    pdo_execute($sql, $name, $order_number);
}

function getNextOrderNumber()
{
    $max_order_number = pdo_query_value("SELECT MAX(order_number) FROM categories");

    if ($max_order_number === NULL) {
        return 1;
    }

    return intval($max_order_number) + 1;
}

function updateCategory($id, $name, $order_number)
{
    $sql = "UPDATE categories SET name = ?, order_number = ? WHERE id = ?";
    pdo_execute($sql, $name, $order_number, $id);
}

function deleteCategoryById($id)
{
    $sql = "DELETE FROM categories WHERE id = ?";
    pdo_execute($sql, $id);
}

function getCategoryById($id)
{
    $sql = "SELECT * FROM categories WHERE id = ?";
    return pdo_query_one($sql, $id);
}
