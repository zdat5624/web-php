<div class="container mt-5">
    <h2 class="text-primary">Sửa người dùng</h2>
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