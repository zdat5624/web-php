<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Thêm thương hiệu</h2>
        <a href="index.php?pg=brands" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=addbrand" method="POST">
        <div class="mb-3">
            <label class="form-label">Tên thương hiệu</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= isset($next_order_number_brand) ? $next_order_number_brand : 1 ?>" required>
        </div>

        <button type="submit" name="addbrand" class="btn btn-primary">Thêm</button>
    </form>
</div>