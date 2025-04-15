<?php
header('Content-Type: application/json');

require_once "../pdo.php";

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Phương thức không hợp lệ.');
    }

    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $note = isset($_POST['note']) ? trim($_POST['note']) : '';

    if ($id <= 0) {
        throw new Exception('ID đơn hàng không hợp lệ.');
    }

    // Kiểm tra trạng thái hợp lệ
    $validStatuses = ['pending', 'preparing', 'shipping', 'completed', 'canceled'];
    if (!in_array($status, $validStatuses)) {
        throw new Exception('Trạng thái không hợp lệ.');
    }

    // Cập nhật đơn hàng trong cơ sở dữ liệu
    $sql = "UPDATE orders SET status = :status, note = :note WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':status' => $status,
        ':note' => $note,
        ':id' => $id
    ]);

    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Không có thay đổi nào được thực hiện.';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
