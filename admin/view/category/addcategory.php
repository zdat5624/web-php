<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Thêm danh mục</h2>
        <a href="index.php?pg=categories" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=addcategory" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= $next_order_number ?>" required>
        </div>

        <button type="submit" name="addcategory" class="btn btn-primary">Thêm</button>
    </form>
</div>