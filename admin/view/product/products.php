<div class="table-container px-3">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h3 style="color: rgb(60, 102, 215);">Quản lý sản phẩm</h3>
        <a href="index.php?pg=addproduct" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm
        </a>
    </div>

    <div class="card shadow-sm p-3 mb-4">
        <form method="GET" action="index.php" class="row align-items-end g-3">
            <input type="hidden" name="pg" value="products">

            <div class="col-12 col-md-4 col-lg-3">
                <label for="category" class="form-label fw-bold text-primary">
                    <i class="fas fa-list"></i> Danh mục:
                </label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Tất cả</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category_id == $category['id'] ? 'selected' : '' ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <label for="brand" class="form-label fw-bold text-primary">
                    <i class="fas fa-tags"></i> Thương hiệu:
                </label>
                <select name="brand" id="brand" class="form-select" onchange="this.form.submit()">
                    <option value="">Tất cả</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?= $brand['id'] ?>" <?= $brand_id == $brand['id'] ? 'selected' : '' ?>>
                            <?= $brand['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </form>
    </div>



    <!-- Bảng sản phẩm -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <!-- sort -->
            <thead>
                <tr>
                    <th>
                        <a href="index.php?pg=products&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
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
                    <th>Tên</th>
                    <th>Hình</th>
                    <th>
                        <a href="index.php?pg=products&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=price&order=<?= $sort == 'price' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'price' ? 'active' : '' ?>">
                            Giá
                            <?php
                            if ($sort == 'price') {
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
                        <a href="index.php?pg=products&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=view&order=<?= $sort == 'view' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'view' ? 'active' : '' ?>">
                            Lượt xem
                            <?php
                            if ($sort == 'view') {
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
                        <a href="index.php?pg=products&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=sold&order=<?= $sort == 'sold' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'sold' ? 'active' : '' ?>">
                            Lượt bán
                            <?php
                            if ($sort == 'sold') {
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
                    <th>Thương hiệu</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if (empty($products)) {
                    echo '<tr>
                            <td colspan="11" class="text-center">Không có sản phẩm nào.</td>
                        </tr>';
                } else {
                    foreach ($products as $product) {
                        echo '<tr>
                                <td>' . $product['id'] . '</td>
                                <td>' . $product['name'] . '</td>
                                <td>
                                    <img src="' . IMG_PATH_ADMIN . $product['image'] . '"
                                        alt="' . $product['name'] . '"
                                        width="60" height="60"
                                        style="object-fit: cover; border-radius: 5px;">
                                </td>
                                <td>' . number_format($product['price'], 0, ',', '.') . ' VND</td>

                                <td>' . $product['view'] . '</td>
                                <td>' . $product['sold'] . '</td>
                                <td>' . $product['brand_name'] . '</td>
                                <td>' . $product['category_name'] . '</td>
                                <td>
                                    <a href="index.php?pg=updateproduct&id=' . $product['id'] . '">
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                                    </a>
                                    <a href="index.php?pg=deleteproduct&id=' . $product['id'] . '" 
                                        onclick="return confirm(\'Bạn có chắc muốn xóa sản phẩm này?\')">
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                                    </a>
                                </td>
                        </tr>';
                    }
                }
                ?>


            </tbody>
        </table>
    </div>

    <!-- Paging -->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Next button -->
            <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=products&page=<?= $current_page - 1 ?>&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <!-- all page button -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=products&page=<?= $i ?>&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Prev button -->
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=products&page=<?= $current_page + 1 ?>&<?= $brand_id ? "brand=$brand_id&" : '' ?><?= $category_id ? "category=$category_id&" : '' ?>sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>