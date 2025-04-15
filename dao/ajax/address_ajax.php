<?php
session_start();
require_once "../../dao/pdo.php";

header('Content-Type: application/json');


if (isset($_GET['get_all_provinces'])) {

    $sql = "SELECT * FROM provinces ORDER BY name ASC";

    $provinces = pdo_query($sql);

    echo json_encode([
        'status' => 'success',
        'message' => 'Lấy danh sách tỉnh/thành thành công',
        'provinces' => $provinces
    ]);
    exit();
}

if (isset($_GET['get_districts_by_province_code'])) {

    if (!$_GET['province_code']) {
        echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
        exit();
    }

    $sql = "SELECT * FROM districts d WHERE d.province_code = ? ORDER BY name ASC";

    $districts = pdo_query($sql, $_GET['province_code']);

    echo json_encode([
        'status' => 'success',
        'message' => 'Lấy danh sách quận/huyện thành công',
        'districts' => $districts
    ]);
    exit();
}

if (isset($_GET['get_wards_by_district_code'])) {

    if (!$_GET['district_code']) {
        echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
        exit();
    }

    $sql = "SELECT * FROM wards w WHERE w.district_code = ? ORDER BY name ASC";

    $wards = pdo_query($sql, $_GET['district_code']);

    echo json_encode([
        'status' => 'success',
        'message' => 'Lấy danh sách phường/xã thành công',
        'wards' => $wards
    ]);
    exit();
}

echo json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ!']);
