<?php
// Điền phone, email
$phone_value = '';
$email_value = '';

if (isset($cart['id'])) {
    $vnpay_check = get_pending_vnpay_check_by_cart_id($cart['id']);
    if ($vnpay_check) {
        $phone_value = $vnpay_check['phone'] ?? '';
        $email_value = $vnpay_check['email'] ?? '';
    }
}

if (empty($phone_value) && isset($_SESSION['user'])) {
    $phone_value = $_SESSION['user']['phone'] ?? '';
}

if (empty($email_value) && isset($_SESSION['user'])) {
    $email_value = $_SESSION['user']['email'] ?? '';
}
?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><a href="index.php?pg=cart">Giỏ hàng</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thanh toán</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container-fluid pt-2">
    <form id="checkoutForm" method="POST">
        <div class="row px-xl-5">
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Thông tin thanh toán</h4>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label>Số điện thoại</label>
                            <input class="form-control" type="text" id="phone" name="phone" placeholder="Nhập số điện thoại..." value="<?= $phone_value ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Email liên hệ</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Nhập email..." value="<?= $email_value ?>" required>
                        </div>
                        <div class=" col-md-6 form-group mb-4">
                            <label for="province">Tỉnh / Thành phố <span class="text-danger">*</span></label>
                            <select class="form-control" id="province" name="province" required>
                                <option value="">Chọn tỉnh/thành phố</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn tỉnh/thành phố.</div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label for="district">Quận / Huyện <span class="text-danger">*</span></label>
                            <select class="form-control" id="district" name="district" required disabled>
                                <option value="">Chọn quận/huyện</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn quận/huyện.</div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label for="ward">Phường / Xã <span class="text-danger">*</span></label>
                            <select class="form-control" id="ward" name="ward" required disabled>
                                <option value="">Chọn phường/xã</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn phường/xã.</div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label>Số nhà, tên đường</label>
                            <input class="form-control" type="text" id="street" name="street" placeholder="Nhập số nhà, tên đường...">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Địa chỉ bạn nhận hàng</label>
                            <input class="form-control" type="text" id="full_address" name="full_address" placeholder="Địa chỉ nhận hàng sẽ hiển thị ở đây..." disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng đơn hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex product-row product-row-checkout mb-1">
                            <p class="product-name product-name-checkout font-weight-bold">Sản phẩm</p>
                            <p class="product-quantity product-quantity-checkout font-weight-bold">Số lượng</p>
                            <p class="product-price product-price-checkout font-weight-bold">Tổng (VNĐ)</p>
                        </div>
                        <?php foreach ($cart_details as $item): ?>
                            <div class="d-flex product-row product-row-checkout mb-1">
                                <p class="product-name product-name-checkout"><?php echo $item['name']; ?></p>
                                <p class="product-quantity product-quantity-checkout"><?php echo $item['quantity']; ?></p>
                                <p class="product-price product-price-checkout">
                                    <?php echo number_format($item['price'] * $item['quantity']); ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                        <hr class="mt-4">
                        <div class="d-flex justify-content-between mb-3 pt-0">
                            <p class="font-weight-medium">Tiền hàng (tạm tính)</p>
                            <p class="font-weight-medium"><?php echo number_format($cart['total_price']); ?> VNĐ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="font-weight-medium">Phí vận chuyển</p>
                            <p class="font-weight-medium">Miễn phí</p>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng cộng</h5>
                            <h5 class="font-weight-bold"><?php echo number_format($cart['total_price']); ?> VNĐ</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương thức thanh toán</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio mb-4">
                                <input type="radio" class="custom-control-input" name="payment" id="cod" value="cod" required>
                                <label class="custom-control-label-checkout custom-control-label d-flex align-items-center" for="cod">
                                    <i class="fas fa-money-bill-wave me-2"></i>
                                    Thanh toán khi nhận hàng
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" class="custom-control-input" name="payment" id="vnpay" value="vnpay">
                                <label class="custom-control-label-checkout custom-control-label d-flex align-items-center" for="vnpay">
                                    <img src="../upload/vnpay.webp" alt="VNPay QR Logo" style="width: 80px; height: auto; margin-right: 10px;">
                                    Chuyển khoản VNPAY
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent btn-checkout-cod " style="display: none;">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-1 py-3">Đặt Hàng</button>
                    </div>
                    <div class="card-footer border-secondary bg-transparent btn-checkout-vnpay" style="display: none;">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-1 py-3">Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->