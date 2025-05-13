<?php
require_once "pdo.php";

function getAllSlides()
{
    $sql = "SELECT * FROM slides ORDER BY order_number";
    return pdo_query($sql);
}

function addSlide($link, $order_number, $image)
{
    $sql = "INSERT INTO slides (link, order_number, image) VALUES (?, ?, ?)";
    pdo_execute($sql, $link, $order_number, $image);
}

function updateSlide($id, $link, $order_number, $image)
{
    $sql = "UPDATE slides SET link = ?, order_number = ?, image = ? WHERE id = ?";
    pdo_execute($sql, $link, $order_number, $image, $id);
}

function deleteSlideById($id)
{
    $sql = "DELETE FROM slides WHERE id = ?";
    pdo_execute($sql, $id);
}

function getSlideById($id)
{
    $sql = "SELECT * FROM slides WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function getNextOrderNumberSlide()
{
    $max_order_number = pdo_query_value("SELECT MAX(order_number) FROM slides");
    if ($max_order_number === NULL) {
        return 1;
    }
    return intval($max_order_number) + 1;
}

function getTotalSlides()
{
    $sql = "SELECT COUNT(*) FROM slides";
    return (int)pdo_query_value($sql);
}

function getSlidesWithSort($pageSize, $offset, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT * FROM slides WHERE 1=1";
    $sort_list = ['id', 'order_number'];
    $sort = in_array($sort, $sort_list) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $sql .= " ORDER BY $sort $order";
    $sql .= " LIMIT $offset, $pageSize";
    return pdo_query($sql);
}

function getAllSlidesForUser()
{
    $sql = "SELECT * FROM slides  ORDER BY order_number  DESC";
    return pdo_query($sql);
}
