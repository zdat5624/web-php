<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Sửa người dùng</h2>


        <a href="index.php?pg=users" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <?php
    if (isset($_GET['error']) && $_GET['error'] === 'email') {
        echo '<div id="alert-message" class="mb-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">Lỗi cập nhật người dùng: email đã tồn tại</div>
    </div>';
    }
    ?>
    <form action="index.php?pg=handleupdateuser" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="text" name="password" class="form-control" value="<?= $user['password'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-control" required>
                <option value="USER" <?= $user['role'] == 'USER' ? 'selected' : '' ?>>USER</option>
                <option value="ADMIN" <?= $user['role'] == 'ADMIN' ? 'selected' : '' ?>>ADMIN</option>
            </select>
        </div>

        <button type="submit" name="updateuser" class="btn btn-primary">Cập nhật</button>
    </form>
</div>