<?php

function getAllBrands()
{
    $sql = "SELECT * FROM brands ORDER BY order_number";
    return pdo_query($sql);
}

function getAllBrandsForUser()
{
    $sql = "SELECT * FROM brands b WHERE b.is_visible = 1 ORDER BY order_number  DESC";
    return pdo_query($sql);
}

function addBrand($name, $order_number)
{
    $sql = "INSERT INTO brands (name, order_number) VALUES (?,?)";
    pdo_execute($sql, $name, $order_number);
}

function updateBrand($id, $name)
{
    $sql = "UPDATE brands SET name = ? WHERE id = ?";
    pdo_execute($sql, $name, $id);
}

function deleteBrandById($id)
{
    $sql = "DELETE FROM brands WHERE id = ?";
    pdo_execute($sql, $id);
}

function getBrandById($id)
{
    $sql = "SELECT * FROM brands WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function getNextOrderNumberBrand()
{
    $max_order_number = pdo_query_value("SELECT MAX(order_number) FROM brands ");

    if ($max_order_number === NULL) {
        return 1;
    }

    return intval($max_order_number) + 1;
}

function getTotalBrands()
{
    $sql = "SELECT COUNT(*) FROM brands";

    return (int)pdo_query_value($sql);
}

function getBrandsWithSort($pageSize, $offset, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT * FROM brands b
            WHERE 1=1 ";

    $sort_list = ['id', 'name', 'order_number'];
    $sort = in_array($sort, $sort_list) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $sql .= " ORDER BY b.$sort $order";
    $sql .= " LIMIT $offset , $pageSize";
    return pdo_query($sql);
}


function updateBrandVisibility($id, $is_visible)
{
    $sql = "UPDATE `brands` SET `is_visible` = ? WHERE `id` = ?";
    pdo_execute($sql, $is_visible, $id);
}
