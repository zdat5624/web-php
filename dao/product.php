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

function deleteProductById($id)
{
    $sql = "DELETE FROM products WHERE id = ?";
    pdo_execute($sql, $id);
}
