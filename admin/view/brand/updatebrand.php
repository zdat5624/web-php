<div class="container mt-5">
    <h2 class="text-primary">Cập nhật thương hiệu</h2>
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