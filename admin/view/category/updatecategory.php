<div class="container mt-5">
    <h2 class="text-primary">Sửa danh mục</h2>
    <form action="index.php?pg=handleupdatecategory" method="POST">
        <input type="hidden" name="id" value="<?= $category['id']; ?>">

        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="<?= $category['name']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= $category['order_number']; ?>" required>
        </div>

        <button type="submit" name="updatecategory" class="btn btn-primary">Cập nhật</button>
    </form>
</div>