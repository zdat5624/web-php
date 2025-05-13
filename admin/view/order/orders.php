<div class="table-container px-3">
    <!-- Tiêu đề -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h3 style="color: rgb(60, 102, 215);">Quản lý đơn hàng</h3>
    </div>

    <!-- Bộ lọc trạng thái và tìm kiếm -->
    <div class="card shadow-sm p-3 mb-4">
        <form method="GET" action="index.php" class="row align-items-end g-3">
            <input type="hidden" name="pg" value="orders">
            <input type="hidden" name="sort" value="<?= $sort ?>">
            <input type="hidden" name="order" value="<?= $order ?>">
            <input type="hidden" name="status" value="<?= $status ?>">


            <!-- Ô tìm kiếm và các nút -->
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <label for="search" class="form-label fw-bold text-primary">
                    <i class="fas fa-search"></i> Tìm kiếm:
                </label>
                <div class="input-group">
                    <input type="text" name="search" id="search" class="form-control"
                        placeholder="ID, SĐT, người nhận" value="<?= isset($_GET['search']) ? ($_GET['search']) : '' ?>">
                    <button type="submit" class="btn btn-primary" style="display: flex; justify-content: center; align-items: center;">
                        <i class="fas fa-search"></i>
                    </button>

                    <?php if (isset($_GET['search']) && $_GET['search'] !== '') : ?>
                        <a href="index.php?pg=orders&sort=<?= ($sort) ?>&order=<?= ($order) ?>&status=<?= ($status ? $status : '') ?>"
                            class="btn btn-outline-secondary"
                            style="display: flex; justify-content: center; align-items: center;"
                            title="Hủy tìm kiếm">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Nút lọc trạng thái -->
            <div class="col-12 mb-3">
                <label class="form-label fw-bold text-primary">
                    <i class="fas fa-filter"></i> Trạng thái:
                </label>
                <div class="btn-group d-flex flex-wrap" role="group">
                    <a href="index.php?pg=orders" class="btn btn-outline-primary flex-fill text-center <?= $status === null ||  $status === '' ? 'active' : '' ?>" style="min-width: 100px;">Tất cả</a>
                    <a href="index.php?pg=orders&status=pending&sort=<?= $sort ?>&order=<?= $order ?>" class="btn btn-outline-primary flex-fill text-center <?= isset($_GET['status']) && $_GET['status'] == 'pending' ? 'active' : '' ?>" style="min-width: 100px;">Chờ xác nhận</a>
                    <a href="index.php?pg=orders&status=preparing&sort=<?= $sort ?>&order=<?= $order ?>" class="btn btn-outline-primary flex-fill text-center <?= isset($_GET['status']) && $_GET['status'] == 'preparing' ? 'active' : '' ?>" style="min-width: 100px;">Đang chuẩn bị</a>
                    <a href="index.php?pg=orders&status=shipping&sort=<?= $sort ?>&order=<?= $order ?>" class="btn btn-outline-primary flex-fill text-center <?= isset($_GET['status']) && $_GET['status'] == 'shipping' ? 'active' : '' ?>" style="min-width: 100px;">Đang giao</a>
                    <a href="index.php?pg=orders&status=completed&sort=<?= $sort ?>&order=<?= $order ?>" class="btn btn-outline-primary flex-fill text-center <?= isset($_GET['status']) && $_GET['status'] == 'completed' ? 'active' : '' ?>" style="min-width: 100px;">Hoàn thành</a>
                    <a href="index.php?pg=orders&status=canceled&sort=<?= $sort ?>&order=<?= $order ?>" class="btn btn-outline-primary flex-fill text-center <?= isset($_GET['status']) && $_GET['status'] == 'canceled' ? 'active' : '' ?>" style="min-width: 100px;">Đã hủy</a>
                </div>
            </div>



        </form>
    </div>

    <!-- Bảng đơn hàng -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-header-blue">
                <tr>
                    <th style="width: 5%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'id' ? 'active' : '' ?>">
                            ID
                            <?php
                            if ($sort == 'id') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th style="width: 10%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=total_price&order=<?= $sort == 'total_price' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'total_price' ? 'active' : '' ?>">
                            Tổng giá (VNĐ)
                            <?php
                            if ($sort == 'total_price') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th style="width: 10%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=phone&order=<?= $sort == 'phone' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'phone' ? 'active' : '' ?>">
                            SĐT
                            <?php
                            if ($sort == 'phone') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th style="width: 10%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=receiver_name&order=<?= $sort == 'receiver_name' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'receiver_name' ? 'active' : '' ?>">
                            Người nhận
                            <?php
                            if ($sort == 'receiver_name') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <!-- <th style="width: 15%;">
                        Địa chỉ
                    </th> -->

                    <th class="text-center" style="width: 10%;">
                        Thanh toán
                    </th>
                    <th class="text-center" style="width: 10%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=status&order=<?= $sort == 'status' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'status' ? 'active' : '' ?>">
                            Trạng thái
                            <?php
                            if ($sort == 'status') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th style="width: 10%;">
                        <a href="index.php?pg=orders&<?= isset($_GET['status']) ? "status={$_GET['status']}&" : '' ?><?= isset($_GET['search']) ? "search={$_GET['search']}&" : '' ?>sort=created_at&order=<?= $sort == 'created_at' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'created_at' ? 'active' : '' ?>">
                            Ngày tạo
                            <?php
                            if ($sort == 'created_at') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th style="width: 20%;">
                        Ghi chú
                    </th>
                    <th class="text-center" style="width: 15%;">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($orders)) {
                    echo '<tr>
                    <td colspan="10" class="text-center">Không có đơn hàng nào.</td>
                </tr>';
                }
                ?>
                <?php foreach ($orders as $item) : ?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= number_format($item['total_price']) ?> </td>
                        <td><?= ($item['phone']) ?></td>
                        <td title="<?= ($item['receiver_name']) ?>"><?= ($item['receiver_name']) ?></td>
                        <!-- <td class="text-truncate" style="max-width: 200px;" title="<?= ($item['address']) ?>">
                                <?= ($item['address']) ?>
                            </td> -->

                        <td class="text-center"><?= ($item['type_payment']) ?></td>
                        <td class="text-center">
                            <?php
                            $item_status = $item['status'];
                            $badge_class = '';
                            $status_text = '';
                            switch ($item_status) {
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
                                    $status_text = $status;
                            }
                            ?>
                            <span class="<?= $badge_class ?> " style="font-size: 0.9rem !important;  padding: 0.35em 0.65em !important;  color: #FFFFFF !important;">
                                <?= $status_text ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                        <td class="text-truncate" style="max-width: 150px;" title="<?= ($item['note']) ?>">
                            <?= ($item['note']) ?>
                        </td>
                        <td class="text-center">
                            <a href="index.php?pg=orderdetail&order_id=<?= $item['id'] ?>" class="btn btn-success btn-sm me-1" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="btn btn-warning btn-sm update-order-btn" title="Cập Nhật Đơn Hàng"
                                data-id="<?= ($item['id']) ?>"
                                data-status="<?= ($item['status']) ?>"
                                data-note="<?= ($item['note']) ?>"
                                data-toggle="modal"
                                data-target="#updateOrderModal">
                                <i class="fas fa-edit"></i>
                            </button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Cập Nhật Đơn Hàng -->
    <div class="modal fade" id="updateOrderModal" tabindex="-1" role="dialog" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="updateOrderModalLabel">
                        <i class="fas fa-edit me-2"></i> Cập Nhật Đơn Hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateOrderForm">
                    <div class="modal-body">

                        <input type="hidden" name="id" id="orderId">
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Trạng thái:</label>
                            <select class="form-control" name="status" id="orderStatus">
                                <option value="pending">Chờ xử lý</option>
                                <option value="preparing">Đang chuẩn bị</option>
                                <option value="shipping">Đang giao</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="canceled">Đã hủy</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="orderNote" class="form-label">Ghi chú:</label>
                            <input type="text" class="form-control" name="note" id="orderNote"></input>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" id="saveOrderBtn">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Paging -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Next button -->
            <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=orders&page=<?= $current_page - 1 ?>&status=<?= $status ? $status : ''  ?>&search=<?= $search ? $search : ''  ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <!-- all page button -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=orders&page=<?= $i ?>&status=<?= $status ? $status : ''  ?>&search=<?= $search ? $search : ''  ?>&sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Prev button -->
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=orders&page=<?= $current_page + 1 ?>&status=<?= $status ? $status : ''  ?>&search=<?= $search ? $search : ''  ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>