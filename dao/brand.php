<?php

function getAllBrands()
{
    $sql = "SELECT * FROM brands ORDER BY order_number";
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
