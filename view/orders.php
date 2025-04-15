<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đơn hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Orders Start -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5">
        <?php include "sidebar.php"; ?>
        <div class="col-lg-9 col-12 order-lg-2 order-2 mt-4 mt-lg-0">


            <div class="col-lg-12 table-responsive mb-4">
                <h4 class="font-weight-semi-bold mb-4">Đơn hàng của bạn</h4>
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Xem chi tiết</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        if (empty($orders))
                            echo '<tr>
                            <td colspan="5" class="text-center">Bạn chưa có đơn hàng nào.</td>
                        </tr>';
                        ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="align-middle">
                                    <a href="index.php?pg=order_detail&id=<?php echo $order['id']; ?>" class="">
                                        <?php echo $order['id']; ?>
                                    </a>
                                </td>
                                <td class="align-middle"><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                <td class="align-middle"><?php echo number_format($order['total_price']); ?> VNĐ</td>
                                <td class="align-middle"><?php echo $order['status']; ?></td>
                                <td class="align-middle">
                                    <a href="index.php?pg=order_detail&id=<?php echo $order['id']; ?>" class="btn btn-sm btn-primary">
                                        <i class="fa fa-eye"></i> Xem
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>


            </div>
            <!-- paging -->
            <div class="col-12 pb-1">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-3">
                        <!-- Previous -->
                        <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="index.php?pg=orders&page=<?= $current_page - 1 ?>&sort=<?= $sort ?>"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                                <a class="page-link"
                                    href="index.php?pg=orders&page=<?= $i ?>&sort=<?= $sort ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next -->
                        <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                            <a class="page-link"
                                href="index.php?pg=orders&page=<?= $current_page + 1 ?>&sort=<?= $sort ?>"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- end paging -->

        </div>
    </div>
</div>
<!-- Orders End -->