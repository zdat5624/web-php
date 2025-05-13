<div class="table-container px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="color: rgb(60, 102, 215);">Quản lý slides</h3>
        <a href="index.php?pg=addslide">
            <button class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-header-blue">
                <tr>
                    <th>
                        <a href="index.php?pg=slides&sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
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
                    <th>Ảnh</th>
                    <th>Link</th>
                    <th>
                        <a href="index.php?pg=slides&sort=order_number&order=<?= $sort == 'order_number' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'order_number' ? 'active' : '' ?>">
                            Thứ tự hiển thị
                            <?php
                            if ($sort == 'order_number') {
                                echo $order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
                            } else {
                                echo '<i class="fas fa-sort"></i>';
                            }
                            ?>
                        </a>
                    </th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $slide) : ?>
                    <tr>
                        <td><?= $slide['id'] ?></td>
                        <td>
                            <img src="<?= IMG_PATH_ADMIN . $slide['image'] ?>" alt="Slide" style="max-width: 100px; max-height: 50px;">
                        </td>
                        <td>
                            <a href="<?= $slide['link'] ?>" target="_blank"><?= htmlspecialchars($slide['link']) ?></a>
                        </td>
                        <td><?= $slide['order_number'] ?></td>
                        <td class="text-center">
                            <a href="index.php?pg=updateslide&id=<?= $slide['id'] ?>">
                                <button class="btn btn-warning btn-sm" title="Sửa"><i class="fas fa-edit"></i> </button>
                            </a>
                            <a href="index.php?pg=deleteslide&id=<?= $slide['id'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa slide này?')">
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
            <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=slides&page=<?= $current_page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=slides&page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=slides&page=<?= $current_page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>