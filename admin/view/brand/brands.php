<div class="table-container px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="color: rgb(60, 102, 215);">Quản lý thương hiệu</h3>
        <a href="index.php?pg=addbrand">
            <button class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <tr>
                    <th>
                        <a href="index.php?pg=brands&sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'id' ? 'active' : '' ?>">
                            ID
                            <?php
                            if ($sort == 'id') {
                                if ($order == 'ASC') {
                                    echo '<i class="fas fa-sort-up"></i>';
                                } else {
                                    echo '<i class="fas fa-sort-down"></i>';
                                }
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th>
                        <a href="index.php?pg=brands&sort=name&order=<?= $sort == 'name' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'name' ? 'active' : '' ?>">
                            Tên thương hiệu
                            <?php
                            if ($sort == 'name') {
                                if ($order == 'ASC') {
                                    echo '<i class="fas fa-sort-up"></i>';
                                } else {
                                    echo '<i class="fas fa-sort-down"></i>';
                                }
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th>
                        <a href="index.php?pg=brands&sort=order_number&order=<?= $sort == 'order_number' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'order_number' ? 'active' : '' ?>">
                            Thứ tự hiển thị
                            <?php
                            if ($sort == 'order_number') {
                                if ($order == 'ASC') {
                                    echo '<i class="fas fa-sort-up"></i>';
                                } else {
                                    echo '<i class="fas fa-sort-down"></i>';
                                }
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>

                    <th>Thao tác</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $brand) : ?>
                    <tr>
                        <td><?= $brand['id'] ?></td>
                        <td><?= $brand['name'] ?></td>
                        <td><?= $brand['order_number'] ?></td>
                        <td>
                            <a href="index.php?pg=updatebrand&id=<?= $brand['id'] ?>">
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                            </a>
                            <a href="index.php?pg=deletebrand&id=<?= $brand['id'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')">
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Paging -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Next button -->
            <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=brands&page=<?= $current_page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <!-- all page button -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=brands&page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Prev button -->
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=brands&page=<?= $current_page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>