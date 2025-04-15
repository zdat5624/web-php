<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-2">


    <div class="row px-xl-5">
        <?php include "sidebar.php"; ?>
        <div class="col-lg-9 col-12 order-lg-2 order-2 mt-4 mt-lg-0">

            <div class="col-lg-12 table-responsive mb-3 ">
                <h4 class="font-weight-semi-bold mb-4">Giỏ hàng của bạn</h4>
                <table class="table table-bordered text-center mb-3">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá (VNĐ)</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        if (empty($cart_details)) {
                            echo '<tr><td colspan="5" class="text-center">Giỏ hàng của bạn đang trống.</td></tr>';
                        }
                        ?>
                        <?php foreach ($cart_details as $item): ?>
                            <tr>
                                <td class="align-middle" style="text-align: left;">
                                    <img src="<?= IMG_PATH_USER . $item['image'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 50px;">
                                    <?= htmlspecialchars($item['name']) ?>
                                </td>
                                <td class="align-middle"><?= number_format($item['price']) ?> </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus btn-minus-cart" data-cart-detail-id="<?= $item['id'] ?>" data-product-id="<?= $item['product_id'] ?>">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="number" class="form-control form-control-sm bg-secondary text-center update-quantity-input" value="<?= $item['quantity'] ?>" min="1" step="1" data-cart-detail-id="<?= $item['id'] ?>">

                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus btn-plus-cart" data-cart-detail-id="<?= $item['id'] ?>" data-product-id="<?= $item['product_id'] ?>">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total-item " data-cart-detail-id="<?= $item['id'] ?>"><?= number_format($item['quantity'] * $item['price']) ?> </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-primary btn-remove" data-cart-detail-id="<?= $item['id'] ?>">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>





            </div>
        </div>



    </div>
    <div class="row px-xl-5">
        <?php if (!empty($cart_details)): ?>
            <div class="col-lg-4 ml-auto">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng giỏ hàng</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tạm tính</h6>
                            <h6 class="font-weight-medium total-price">
                                <?php
                                if (!empty($cart_details)) {
                                    updateCartTotalPrice($cart['id']);
                                    $cart = getCartByUserId($user_id);
                                    echo number_format($cart['total_price']) . ' VNĐ';
                                } else {
                                    echo '0 VNĐ';
                                }
                                ?>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí vận chuyển</h6>
                            <h6 class="font-weight-medium">Miễn phí</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tổng cộng</h5>
                            <h5 class="font-weight-bold total-price">
                                <?php
                                if (!empty($cart_details)) {
                                    echo number_format($cart['total_price']) . ' VNĐ';
                                } else {
                                    echo '0 VNĐ';
                                }
                                ?>
                            </h5>
                        </div>
                        <?= !empty($cart_details) ?  '<a href="index.php?pg=checkout" class="btn btn-block btn-primary my-3 py-3 btn-to-checkout">Thanh toán</a>' : '' ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


</div>
<!-- end cart -->