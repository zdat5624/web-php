<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Sửa thương hiệu</h2>
        <a href="index.php?pg=brands" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=handleupdatebrand" method="POST">

        <input type="hidden" name="id" value="<?= $brand['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Tên thương hiệu</label>
            <input type="text" name="name" class="form-control" value="<?= $brand['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= $brand['order_number'] ?>" required>
        </div>

        <button type="submit" name="updatebrand" class="btn btn-primary">Cập nhật</button>
    </form>
</div>