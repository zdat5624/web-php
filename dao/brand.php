<?php

function getAllBrands()
{
    $sql = "SELECT * FROM brands ORDER BY order_number";
    return pdo_query($sql);
}

function getAllBrandsForUser()
{
    $sql = "SELECT * FROM brands b WHERE b.is_visible = 1 ORDER BY order_number  ASC";
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

// function deleteBrandById($id)
// {
//     $sql = "DELETE FROM brands WHERE id = ?";
//     pdo_execute($sql, $id);
// }

function deleteBrandById($id)
{
    $conn = null;
    try {
        $conn = pdo_get_connection();
        // Bắt đầu giao dịch
        $conn->beginTransaction();

        // 1. Lấy danh sách product_id thuộc thương hiệu
        $sql = "SELECT id FROM products WHERE brand_id = ?";
        $products = pdo_query($sql, $id);

        // 2. Xóa dữ liệu liên quan cho từng sản phẩm
        foreach ($products as $product) {
            $product_id = $product['id'];

            // 2.1. Lấy danh sách cart_id bị ảnh hưởng
            $sql = "SELECT DISTINCT cart_id FROM cart_detail WHERE product_id = ?";
            $cart_ids = pdo_query($sql, $product_id);

            // 2.2. Xóa các bản ghi trong cart_detail
            $sql = "DELETE FROM cart_detail WHERE product_id = ?";
            pdo_execute($sql, $product_id);

            // 2.3. Xóa các bản ghi trong order_detail
            $sql = "DELETE FROM order_detail WHERE product_id = ?";
            pdo_execute($sql, $product_id);

            // 2.4. Xóa các bản ghi trong vnpay_check liên quan
            $sql = "DELETE FROM vnpay_check WHERE cart_id IN (SELECT cart_id FROM cart_detail WHERE product_id = ?)";
            pdo_execute($sql, $product_id);

            // 2.5. Xóa sản phẩm
            $sql = "DELETE FROM products WHERE id = ?";
            pdo_execute($sql, $product_id);

            // 2.6. Cập nhật total_price cho các giỏ hàng bị ảnh hưởng
            foreach ($cart_ids as $cart) {
                updateCartTotalPrice($cart['cart_id']);
            }
        }

        // 3. Xóa bản ghi trong brands
        $sql = "DELETE FROM brands WHERE id = ?";
        pdo_execute($sql, $id);

        // Kết thúc giao dịch
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // Hoàn tác giao dịch nếu có lỗi
        if ($conn) {
            $conn->rollBack();
        }
        // Lưu thông báo lỗi
        $_SESSION['error'] = $e->getMessage();
        return false;
    } finally {
        // Đóng kết nối
        if ($conn) {
            unset($conn);
        }
    }
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
