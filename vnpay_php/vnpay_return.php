<?php
require_once("../dao/pdo.php");
require_once("../dao/vnpay_check.php");
require_once("../dao/order.php");
require_once("../dao/cart.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Thanh Toán VNPAY</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <link href="/vnpay_php/assets/custom.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>

    <link rel="icon" type="image/png" href="/vnpay_php//my-favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/vnpay_php//my-favicon/favicon.svg" />
    <link rel="shortcut icon" href="/vnpay_php//my-favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/vnpay_php//my-favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/vnpay_php//my-favicon/site.webmanifest" />
</head>

<body>
    <?php
    require_once("./config.php");
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">Thanh Toán VNPAY</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã hóa đơn VNPAY:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?? "" ?></label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label>
                    <?= isset($_GET['vnp_Amount']) || $_GET['vnp_Amount'] != '' ? number_format($_GET['vnp_Amount'] / 100, 0, ',', '.') . ' VNĐ' : ''; ?>
                </label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?? '' ?></label>
            </div>
            <!-- <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?= $_GET['vnp_ResponseCode'] ?></label>
            </div> -->
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?? '' ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?? '' ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php
                        $payDate = $_GET['vnp_PayDate'];
                        if (!empty($payDate)) {
                            $dateTime = DateTime::createFromFormat('YmdHis', $payDate);
                            if ($dateTime !== false) {
                                echo $dateTime->format('d/m/Y H:i:s');
                            } else {
                                echo $payDate;
                            }
                        } else {
                            echo 'Không có dữ liệu';
                        }
                        ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    $txn_ref = $_GET['vnp_TxnRef'] ?? '';
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "<span style='color:blue'>Thanh toán đơn hàng thành công</span>";

                            try {
                                if (empty($txn_ref)) {
                                    throw new Exception("Thiếu thông tin giao dịch.");
                                }


                                $vnpay_check = get_vnpay_check_by_vnpay_TxnRef($txn_ref);

                                if (!$vnpay_check) {
                                    throw new Exception("Không tìm thấy giao dịch VNPay.");
                                }

                                $cart = getCartById($vnpay_check['cart_id']);

                                if (!$cart) {
                                    throw new Exception("Đã thanh toán hoặc giỏ hàng không tồn tại ...");
                                }

                                $order_id = createOrder($cart['user_id'], $vnpay_check['phone'], $vnpay_check['receiver_name'], $vnpay_check['address'], 'vnpay');
                                updateVnpayCheck($txn_ref, $order_id);
                                update_vnp_ResponseCode($txn_ref, $_GET['vnp_ResponseCode']);
                            } catch (Exception $e) {
                                error_log(">>> Lỗi vnpay_return: " . $e->getMessage());
                            }
                        } else {
                            if ($_GET['vnp_ResponseCode'] == '24') {
                                echo "<span style='color:orange'>Hủy giao dịch VNPAY thành công</span>";
                            } else {
                                echo "<span style='color:red'>Thanh toán thất bại! Vui lòng liên hệ 1900 6626 để được hỗ trợ (Mã lỗi: " . $_GET['vnp_ResponseCode'] . ")</span>";
                            }
                            update_vnp_ResponseCode($txn_ref, $_GET['vnp_ResponseCode']);
                        }
                    } else {
                        echo "<span style='color:red'>Thất bại! Chữ ký không hợp lệ. Vui lòng liên hệ 1900 6626 để được hỗ trợ</span>";
                    }
                    ?>

                </label>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <a href="../index.php?pg=orders" class="btn btn-primary">Quay lại shop</a>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>