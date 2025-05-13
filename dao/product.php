<?php

function getAllProducts()
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name 
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id";

    return pdo_query($sql);
}

function getAllProductsForUser()
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id  WHERE 1=1 AND p.is_visible = 1 ";

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
    $sql = "SELECT * FROM products WHERE is_visible = 1 ORDER BY id DESC LIMIT $limit";
    return pdo_query($sql);
}

function getBestSellingProducts($limit = 8)
{
    $sql = "SELECT * FROM products WHERE is_visible = 1 ORDER BY sold DESC LIMIT $limit";
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
        $sort_list = ['id', 'price', 'view', 'sold', 'name', 'brand_name', 'category_name'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY $sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $brand_id, $category_id);
    } elseif ($brand_id) {
        $sql .= " AND p.brand_id = ?";
        $sort_list = ['id', 'price', 'view', 'sold', 'name', 'brand_name', 'category_name'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY $sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $brand_id);
    } elseif ($category_id) {
        $sql .= " AND p.category_id = ?";
        $sort_list = ['id', 'price', 'view', 'sold', 'name', 'brand_name', 'category_name'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY $sort $order";
        $sql .= " LIMIT $offset , $pageSize";
        return pdo_query($sql, $category_id);
    } else {
        $sort_list = ['id', 'price', 'view', 'sold', 'name', 'brand_name', 'category_name'];
        $sort = in_array($sort, $sort_list) ? $sort : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        $sql .= " ORDER BY $sort $order";
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


function getProductsWithFiltersForUser($pageSize, $offset, $brand_id = null, $category_id = null, $price_min = null, $price_max = null, $sort = 'new', $keyword = null)
{
    $sql = "SELECT p.*, b.name as brand_name, c.name as category_name
            FROM products p
            JOIN brands b ON p.brand_id = b.id
            JOIN categories c ON p.category_id = c.id
            WHERE p.is_visible = 1 ";

    // check null or empty
    if ($brand_id) {
        $sql .= " AND p.brand_id = $brand_id";
    }
    if ($category_id) {
        $sql .= " AND p.category_id = $category_id";
    }
    if ($price_min && $price_max) {
        $sql .= " AND p.price BETWEEN $price_min AND $price_max";
    }
    if ($keyword) {
        $sql .= " AND p.name LIKE '%$keyword%' ";
    }

    switch ($sort) {
        case 'new':
            $sql .= " ORDER BY id DESC";
            break;
        case 'sold':
            $sql .= " ORDER BY sold DESC";
            break;
        case 'view':
            $sql .= " ORDER BY view DESC";
            break;
        case 'pricedesc':
            $sql .= " ORDER BY price DESC";
            break;
        case 'priceasc':
            $sql .= " ORDER BY price ASC";
            break;
        default:
            $sql .= " ORDER BY id ASC";
            break;
    }


    $sql .= " LIMIT $offset , $pageSize";

    return pdo_query($sql);
}

function getTotalProductsWithFiltersForUser($brand_id = null, $category_id = null, $price_min = null, $price_max = null, $keyword = null)
{
    $sql = "SELECT COUNT(*) FROM products p WHERE p.is_visible = 1 ";
    // check null or empty
    if ($brand_id) {
        $sql .= " AND p.brand_id = $brand_id";
    }
    if ($category_id) {
        $sql .= " AND p.category_id = $category_id";
    }
    if ($price_min !== null && $price_max !== null) {
        $sql .= " AND p.price BETWEEN $price_min AND $price_max";
    }

    if ($keyword) {
        $sql .= " AND p.name LIKE '%$keyword%' ";
    }
    return (int)pdo_query_value($sql);
}

function updateProductVisibility($id, $is_visible)
{
    $sql = "UPDATE `products` SET `is_visible` = ? WHERE `id` = ?";
    pdo_execute($sql, $is_visible, $id);
}

function updateProductView($product_id)
{
    $sql = "UPDATE products SET view = view + 1 WHERE id = ?";
    pdo_execute($sql, $product_id);
}
