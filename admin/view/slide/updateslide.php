<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Sửa slide</h2>
        <a href="index.php?pg=slides" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=handleupdateslide" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $slide['id'] ?>">
        <input type="hidden" name="current_image" value="<?= $slide['image'] ?>">
        <div class="mb-3">
            <label class="form-label">Ảnh slide</label>
            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp">
            <small class="form-text text-muted">Để nguyên nếu không muốn thay đổi ảnh.</small>
            <div class="mt-2">
                <img src="<?= IMG_PATH_ADMIN . $slide['image'] ?>" alt="Current Slide" style="max-width: 200px; max-height: 100px;">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" value="<?= $slide['link'] ?>" placeholder="https://example.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= $slide['order_number'] ?>" required>
        </div>
        <button type="submit" name="updateslide" class="btn btn-primary">Cập nhật</button>
    </form>
</div>