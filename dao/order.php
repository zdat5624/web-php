<?php
function createOrder($user_id, $phone, $receiver_name, $address, $payment = 'cod')
{
    try {
        // Lấy giỏ hàng
        $sql = "SELECT * FROM carts WHERE user_id = ?";
        $cart = pdo_query_one($sql, $user_id);

        if (!$cart) {
            throw new Exception("Không tìm thấy giỏ hàng");
        }

        // Lấy thông tin giỏ hàng
        $sql = "SELECT c.total_price, cd.quantity, cd.product_id, p.price
                FROM carts c
                JOIN cart_detail cd ON c.id = cd.cart_id
                JOIN products p ON cd.product_id = p.id
                WHERE c.user_id = ?";
        $cart_items = pdo_query($sql, $user_id);

        if (empty($cart_items)) {
            throw new Exception("Giỏ hàng của bạn đang trống");
        }

        // Tạo đơn hàng
        $total_price = $cart['total_price'];
        $status = 'pending';
        $note = '';
        $conn = pdo_get_connection();
        $sql = "INSERT INTO orders (total_price, phone, receiver_name, address, note, type_payment, status, user_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$total_price, $phone, $receiver_name, $address, $note, $payment, $status, $user_id]);
        $order_id = $conn->lastInsertId();

        // Lưu chi tiết đơn hàng
        $sql = "INSERT INTO order_detail (price, quantity, order_id, product_id) VALUES (?, ?, ?, ?)";
        foreach ($cart_items as $item) {
            pdo_execute($sql, $item['price'], $item['quantity'], $order_id, $item['product_id']);
        }

        // Cập nhật số lượng bán (sold) cho từng sản phẩm
        $sql = "UPDATE products SET sold = sold + ? WHERE id = ?";
        foreach ($cart_items as $item) {
            pdo_execute($sql, $item['quantity'], $item['product_id']);
        }

        // Xóa giỏ hàng
        $sql = "DELETE FROM cart_detail WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?)";
        pdo_execute($sql, $user_id);

        $sql = "DELETE FROM carts WHERE user_id = ?";
        pdo_execute($sql, $user_id);

        return $order_id;
    } catch (Exception $e) {
        error_log("Lỗi createOrder: " . $e->getMessage());
        throw new Exception("Lỗi khi tạo đơn hàng: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}


function getOrdersByUserId($user_id)
{
    $sql = "SELECT *
            FROM orders
            WHERE user_id = ?
            ORDER BY created_at DESC";
    return pdo_query($sql, $user_id);
}

function getOrderById($order_id)
{
    $sql = "SELECT *
            FROM orders
            WHERE id = ? ";
    return pdo_query_one($sql, $order_id);
}

function getOrderDetails($order_id)
{
    $sql = "SELECT od.price, od.quantity, p.name, p.image
            FROM order_detail od
            JOIN products p ON od.product_id = p.id
            WHERE od.order_id = ?";
    return pdo_query($sql, $order_id);
}

function getOrdersByUserIdPagingForUser($pageSize, $offset, $user_id, $sort = 'id', $order = 'DESC')
{
    $sql = "SELECT * FROM orders od
            WHERE od.user_id =  ? ";


    $sort_list = ['id'];
    $sort = in_array($sort, $sort_list) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
    $sql .= " ORDER BY $sort $order";
    $sql .= " LIMIT $offset , $pageSize";
    return pdo_query($sql, $user_id);
}

function getTotalOrderForUser($user_id)
{
    $sql = "SELECT COUNT(*) FROM orders od
            WHERE od.user_id =  ? ";
    return (int)pdo_query_value($sql, $user_id);
}


function getTotalOrdersWithFilters($status = null, $search = null)
{
    $sql = "SELECT COUNT(*) FROM orders od WHERE 1=1 ";


    if ($status) {
        $sql .= " AND od.status = '$status' ";
    }

    if ($search) {
        $sql .= " AND (id LIKE '%$search%' OR phone LIKE '%$search%' OR receiver_name LIKE '%$search%' )";
    }

    return (int)pdo_query_value($sql);
}

function getOrdersWithFilters($pageSize, $offset, $status = null, $search = null, $sort = 'id', $order = 'DESC')
{
    $allowed_sort = ['id', 'total_price', 'phone', 'receiver_name', 'status', 'created_at'];
    $sort = in_array($sort, $allowed_sort) ? $sort : 'id';
    $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

    $sql = "SELECT * FROM orders WHERE 1=1";


    if ($status) {
        $sql .= " AND status = '$status' ";
    }

    if ($search) {
        $sql .= " AND (id LIKE '%$search%' OR phone LIKE '%$search%' OR receiver_name LIKE '%$search%' )";
    }

    $sql .= " ORDER BY $sort $order LIMIT $offset , $pageSize ";

    return pdo_query($sql);
}

function updateOrderStatus($order_id, $status, $note)
{
    $sql = "UPDATE orders SET status = ?, note = ? WHERE id = ?";
    pdo_execute($sql, $status, $note, $order_id);
}

function getMonthlyRevenue()
{
    $current_month = date('Y-m');
    return pdo_query_value("SELECT SUM(total_price) FROM orders WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'completed'", $current_month) ?: 0;
}

function getYearlyRevenue()
{
    $current_year = date('Y');
    return pdo_query_value("SELECT SUM(total_price) FROM orders WHERE YEAR(created_at) = ? AND status = 'completed'", $current_year) ?: 0;
}

function getPendingOrders()
{
    return pdo_query_value("SELECT COUNT(*) FROM orders WHERE status = 'pending'") ?: 0;
}


function getRevenueByMonth()
{
    $year = date('Y');


    $sql = "SELECT MONTH(created_at) AS month, SUM(total_price) AS revenue
            FROM orders
            WHERE YEAR(created_at) = ? AND status = 'completed'
            GROUP BY MONTH(created_at)";
    $results = pdo_query($sql, $year);

    $monthly_revenue = array_fill(0, 12, 0);

    foreach ($results as $row) {
        $month = (int)$row['month'];
        $revenue = (int)$row['revenue'];
        $monthly_revenue[$month - 1] = $revenue;
    }


    return $monthly_revenue;
}

function getProductByCategory()
{
    return pdo_query("SELECT c.name, COUNT(*) as total_quantity
                      FROM products p
                      JOIN categories c ON p.category_id = c.id
                      GROUP BY c.id, c.name");
}
