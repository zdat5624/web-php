<div class="table-container px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="color: rgb(60, 102, 215);">Quản lý danh mục</h3>
        <a href="index.php?pg=addcategory" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-header-blue">

                <tr>
                    <th>
                        <a href="index.php?pg=categories&sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
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
                        <a href="index.php?pg=categories&sort=name&order=<?= $sort == 'name' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'name' ? 'active' : '' ?>">
                            Tên danh mục
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
                        <a href="index.php?pg=categories&sort=order_number&order=<?= $sort == 'order_number' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
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
                    <th class="text-center">Hiển thị</th>
                    <th class="text-center">Thao tác</th>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['order_number'] ?></td>
                        <td class="checkbox-cell">
                            <input type="checkbox" class="toggle-visibility"
                                data-id="<?= $category['id'] ?>"
                                data-type="category"
                                <?= $category['is_visible'] ? 'checked' : '' ?>>
                        </td>
                        <td class="text-center">
                            <a href="index.php?pg=updatecategory&id=<?= $category['id'] ?>">
                                <button class="btn btn-warning btn-sm" title="Sửa"><i class="fas fa-edit"></i> </button>
                            </a>
                            <a href="index.php?pg=deletecategory&id=<?= $category['id'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                <button class="btn btn-danger btn-sm" title="Xóa"><i class="fas fa-trash"></i> </button>
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
                <a class="page-link" href="index.php?pg=categories&page=<?= $current_page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <!-- all page button -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=categories&page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Prev button -->
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=categories&page=<?= $current_page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>