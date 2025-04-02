<?php

function getAllProducts()
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name 
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id";

    return pdo_query($sql);
}

function addProduct($name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $image)
{
    $sql = "INSERT INTO products (name, price, short_desc, detail_desc, view, sold, brand_id, category_id, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $image);
}


function getProductById($id)
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name 
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.id = ?";
    return pdo_query_one($sql, $id);
}

function updateProduct($id, $name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $image)
{
    $sql = "UPDATE products
            SET name = ?, price = ?, short_desc = ?, detail_desc = ?, view = ?, sold = ?, brand_id = ?, category_id = ?, image = ?
            WHERE id = ?";
    pdo_execute($sql, $name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $image, $id);
}

function getNewProducts($limit = 8)
{
    $sql = "SELECT * FROM products ORDER BY id DESC LIMIT $limit";
    return pdo_query($sql);
}

function getBestSellingProducts($limit = 8)
{
    $sql = "SELECT * FROM products ORDER BY sold DESC LIMIT $limit";
    return pdo_query($sql);
}

function deleteProductById($id)
{
    $sql = "DELETE FROM products WHERE id = ?";
    pdo_execute($sql, $id);
}

function getProductsWithFilters($pageSize, $offset, $brand_id = null, $category_id = null, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id
            WHERE 1=1";

    // check null or empty
    if ($brand_id && $category_id) {
        $sql .= " AND p.brand_id = ? AND p.category_id = ?";
        $sort_list = ['id', 'price', 'view', 'sold'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY p.$sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $brand_id, $category_id);
    } elseif ($brand_id) {
        $sql .= " AND p.brand_id = ?";
        $sort_list = ['id', 'price', 'view', 'sold'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY p.$sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $brand_id);
    } elseif ($category_id) {
        $sql .= " AND p.category_id = ?";
        $sort_list = ['id', 'price', 'view', 'sold'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY p.$sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $category_id);
    } else {
        $sort_list = ['id', 'price', 'view', 'sold'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY p.$sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql);
    }
}

function getTotalProductsWithFilters($brand_id = null, $category_id = null)
{
    $sql = "SELECT COUNT(*) FROM products p WHERE 1=1";

    if ($brand_id && $category_id) {
        $sql .= " AND p.brand_id = ? AND p.category_id = ?";
        return (int)pdo_query_value($sql, $brand_id, $category_id);
    } elseif ($brand_id) {
        $sql .= " AND p.brand_id = ?";
        return (int)pdo_query_value($sql, $brand_id);
    } elseif ($category_id) {
        $sql .= " AND p.category_id = ?";
        return (int)pdo_query_value($sql, $category_id);
    } else {
        return (int)pdo_query_value($sql);
    }
}
