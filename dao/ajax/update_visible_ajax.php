<?php
session_start();
require_once "../pdo.php";
require_once "../brand.php";
require_once "../product.php";
require_once "../category.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Vui lòng đăng nhập để thực hiện thao tác này!'
    ]);
    exit();
}

if ($_SESSION['user']['role'] !== 'ADMIN') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Bạn không có quyền thực hiện thao tác này!'
    ]);
    exit();
}

if (isset($_POST['table_update'])) {
    $id = $_POST['id'] ?? null;
    $table_update = $_POST['table_update'] ?? null;
    $is_visible = isset($_POST['is_visible']) ? (int)$_POST['is_visible'] : null;

    if (empty($id) || empty($table_update) || !isset($is_visible)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Thiếu thông tin cần thiết!'
        ]);
        exit();
    }

    $valid_tables = ['brand', 'product', 'category'];
    if (!in_array($table_update, $valid_tables)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Bảng không hợp lệ!'
        ]);
        exit();
    }

    try {
        switch ($table_update) {
            case 'brand':

                updateBrandVisibility($id, $is_visible);
                break;
            case 'product':
                updateProductVisibility($id, $is_visible);
                break;
            case 'category':

                updateCategoryVisibility($id, $is_visible);
                break;
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Cập nhật hiện thị thành công!'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Cập nhật trạng thái thất bại: ' . $e->getMessage()
        ]);
    }
    exit();
}

echo json_encode([
    'status' => 'error',
    'message' => 'Yêu cầu không hợp lệ!'
]);
