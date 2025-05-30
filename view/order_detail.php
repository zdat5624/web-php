<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><a href="index.php?pg=orders">Đơn hàng</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Chi tiết đơn hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Order Detail Start -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <h4 class="font-weight-semi-bold mb-4">Chi tiết đơn hàng #<?= $order['id']; ?></h4>

            <div class="table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá (VNĐ)</th>
                            <th>Số lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php if (empty($order_details)) {
                            echo '<tr>
                                <td colspan="4" class="text-center">Không có sản phẩm trong đơn hàng.</td>
                            </tr>';
                        } ?>


                        <?php foreach ($order_details as $item): ?>
                            <tr>
                                <td class="align-middle" style="text-align: left;">
                                    <img src="<?= IMG_PATH_USER . ($item['image']) ?>" alt="<?= ($item['name']) ?>" style="width: 50px;">
                                    <?= ($item['name']) ?>
                                </td>
                                <td class="align-middle"><?= number_format($item['price']) ?></td>
                                <td class="align-middle"><?= $item['quantity'] ?></td>
                                <td class="align-middle"><?= number_format($item['price'] * $item['quantity']) ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <p><strong>Ngày đặt hàng:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])); ?></p>
                <p><strong>Tổng tiền:</strong> <?= number_format($order['total_price']); ?> VNĐ</p>

                <?php
                $status_text = '';
                $badge_class = '';
                switch ($order['status']) {
                    case 'pending':
                        $badge_class = 'badge bg-warning text-dark';
                        $status_text = 'Chờ xác nhận';
                        break;
                    case 'preparing':
                        $badge_class = 'badge bg-info';
                        $status_text = 'Đang chuẩn bị';
                        break;
                    case 'shipping':
                        $badge_class = 'badge bg-primary';
                        $status_text = 'Đang giao';
                        break;
                    case 'completed':
                        $badge_class = 'badge bg-success';
                        $status_text = 'Hoàn thành';
                        break;
                    case 'canceled':
                        $badge_class = 'badge bg-danger';
                        $status_text = 'Đã hủy';
                        break;
                    default:
                        $badge_class = 'badge bg-secondary';
                        $status_text = $order['status'];
                }
                ?>

                <p>
                    <strong>Trạng thái:</strong> <span class="<?= $badge_class ?>" style="font-size: 0.9rem !important;  padding: 0.35em 0.65em !important;  color: #FFFFFF !important;"><?= $status_text ?></span>
                </p>
                <p><strong>Phương thức thanh toán:</strong> <?= $order['type_payment'] === 'cod' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản - VNPay'; ?></p>
                <p><strong>Địa chỉ giao hàng:</strong> <?= $order['address']; ?></p>
                <p><strong>Số điện thoại người nhận:</strong> <?= $order['phone']; ?></p>
                <p><strong>Tên người nhận:</strong> <?= $order['receiver_name']; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Order Detail End -->