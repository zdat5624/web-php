<div class="table-container px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="color: rgb(60, 102, 215);">Quản lý người dùng</h3>
        <a href="index.php?pg=adduser" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <a href="index.php?pg=users&sort=id&order=<?= $sort == 'id' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
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
                        <a href="index.php?pg=users&sort=email&order=<?= $sort == 'email' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'email' ? 'active' : '' ?>">
                            Email
                            <?php
                            if ($sort == 'email') {
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
                    <th>Mật khẩu</th>
                    <th>
                        <a href="index.php?pg=users&sort=name&order=<?= $sort == 'name' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'name' ? 'active' : '' ?>">
                            Tên
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
                        <a href="index.php?pg=users&sort=address&order=<?= $sort == 'address' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'address' ? 'active' : '' ?>">
                            Địa chỉ
                            <?php
                            if ($sort == 'address') {
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
                        <a href="index.php?pg=users&sort=phone&order=<?= $sort == 'phone' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'phone' ? 'active' : '' ?>">
                            SĐT
                            <?php
                            if ($sort == 'phone') {
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
                        <a href="index.php?pg=users&sort=role&order=<?= $sort == 'role' && $order == 'ASC' ? 'DESC' : 'ASC' ?>"
                            class="sort-link <?= $sort == 'role' ? 'active' : '' ?>">
                            Vai trò
                            <?php
                            if ($sort == 'role') {
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
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['password'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['address'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="index.php?pg=updateuser&id=<?= $user['id'] ?>">
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                            </a>
                            <a href="index.php?pg=deleteuser&id=<?= $user['id'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">
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
                <a class="page-link" href="index.php?pg=users&page=<?= $current_page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                </a>
            </li>

            <!-- all page button -->
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?pg=users&page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Prev button -->
            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                <a class="page-link" href="index.php?pg=users&page=<?= $current_page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</div>