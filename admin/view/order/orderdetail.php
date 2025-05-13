<!-- Tiêu đề -->
<div class="d-flex justify-content-between align-items-center mb-4 px-3">
    <h3 style="color: rgb(60, 102, 215);">Chi tiết đơn hàng #<?= $order['id'] ?></h3>
    <a href="index.php?pg=orders" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<!-- Thông tin đơn hàng -->
<div class="order-info bg-light p-4 rounded mb-4 px-3">
    <h4 style="color: rgb(60, 102, 215);">Thông tin đơn hàng</h4>
    <div class="row">
        <div class="col-md-6">
            <p><strong>ID:</strong> <?= $order['id'] ?></p>
            <p><strong>Tổng giá:</strong> <?= number_format($order['total_price']) ?> VNĐ</p>
            <p><strong>Số điện thoại:</strong> <?= ($order['phone']) ?></p>
            <p><strong>Tên người nhận:</strong> <?= ($order['receiver_name']) ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Địa chỉ:</strong> <?= ($order['address']) ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?= ($order['type_payment']) ?></p>
            <p><strong>Trạng thái:</strong>
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
                <span class="<?= $badge_class ?>" style="font-size: 0.9rem !important;  padding: 0.35em 0.65em !important;  color: #FFFFFF !important;"><?= $status_text ?></span>
            </p>
            <p><strong>Ngày tạo:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
            <p><strong>Ghi chú:</strong> <?= ($order['note']) ?: 'Không có' ?></p>
        </div>
    </div>
</div>

<!-- Danh sách sản phẩm -->
<h4 class="px-3" style="color: rgb(60, 102, 215);">Danh sách sản phẩm</h4>
<div class="table-responsive px-3">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 10%;">Hình ảnh</th>
                <th style="width: 40%;">Tên sản phẩm</th>
                <th style="width: 15%;">Giá (VNĐ)</th>
                <th style="width: 15%;">Số lượng</th>
                <th style="width: 20%;">Tổng (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($order_details)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Không có sản phẩm nào trong đơn hàng.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($order_details as $detail) : ?>
                    <tr>
                        <td>
                            <img src="<?= IMG_PATH_ADMIN . ($detail['image']) ?>" alt="<?= ($detail['name']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        </td>
                        <td><?= ($detail['name']) ?></td>
                        <td><?= number_format($detail['price']) ?></td>
                        <td><?= $detail['quantity'] ?></td>
                        <td><?= number_format($detail['price'] * $detail['quantity']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>