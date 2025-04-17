<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Thêm người dùng</h2>

        <a href="index.php?pg=users" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=adduser" method="POST">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Vai trò</label>
            <select name="role" class="form-control" required>
                <option value="USER">USER</option>
                <option value="USER">ADMIN</option>
            </select>
        </div>

        <button type="submit" name="adduser" class="btn btn-primary">Thêm</button>
    </form>
</div>