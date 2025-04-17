<?php


function getAllCategories()
{
    $sql = "SELECT * FROM categories ORDER BY order_number";
    return pdo_query($sql);
}

function getAllCategoriesForUser()
{
    $sql = "SELECT * FROM categories WHERE is_visible = 1  ORDER BY order_number ";
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


function getTotalCategories()
{
    $sql = "SELECT COUNT(*) FROM categories";
    return (int)pdo_query_value($sql);
}

function getCategoriesWithSort($pageSize, $offset, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT * FROM categories c
            WHERE 1=1 ";

    $sort_list = ['id', 'name', 'order_number'];
    $sort = in_array($sort, $sort_list) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $sql .= " ORDER BY c.$sort $order";
    $sql .= " LIMIT $offset , $pageSize";
    return pdo_query($sql);
}

function updateCategoryVisibility($id, $is_visible)
{
    $sql = "UPDATE `categories` SET `is_visible` = ? WHERE `id` = ?";
    pdo_execute($sql, $is_visible, $id);
}
