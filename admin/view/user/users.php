<style>
    .table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .table thead {
        /* background-color: #4e73df; */
        color: rgb(60, 102, 215);
    }


    .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #375ac1;
        border-color: #375ac1;
    }
</style>

<div class="table-container">
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
                    <th>ID</th>
                    <th>email</th>
                    <th>Mật khẩu</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>SĐT</th>
                    <th>SĐT</th>
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
</div>