<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">Thêm slide</h2>
        <a href="index.php?pg=slides" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=addslide" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Ảnh slide</label>
            <input type="file" name="image" id="imageInput" class="form-control" accept=".jpg,.jpeg,.png,.gif,.webp" required>
            <small class="form-text text-muted">Chỉ hỗ trợ file JPG, JPEG, PNG, GIF, WEBP.</small>
            <div class="mt-2 preview-container" id="imagePreview" style="display: none;">
                <img id="previewImg" src="#" alt="Ảnh preview">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="url" name="link" class="form-control" placeholder="https://example.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="order_number" class="form-control" value="<?= isset($next_order_number_slide) ? $next_order_number_slide : 1 ?>" required>
        </div>
        <button type="submit" name="addslide" class="btn btn-primary">Thêm</button>
    </form>

    <style>
        /* CSS để tăng kích thước và tối ưu giao diện ảnh preview */
        .preview-container {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            background-color: #f9f9f9;
            text-align: center;
        }

        #previewImg {
            max-width: 500px;
            /* Tăng kích thước ảnh preview */
            max-height: 250px;
            width: auto;
            height: auto;
            object-fit: contain;
            /* Đảm bảo ảnh không bị méo */
        }

        @media (max-width: 576px) {
            #previewImg {
                max-width: 100%;
                /* Responsive cho màn hình nhỏ */
                max-height: 200px;
            }
        }
    </style>

    <script>
        // JavaScript để hiển thị preview ảnh
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');

            if (file) {
                // Kiểm tra định dạng file
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!validImageTypes.includes(file.type)) {
                    alert('Chỉ hỗ trợ file JPG, JPEG, PNG, GIF, WEBP!');
                    event.target.value = ''; // Xóa file không hợp lệ
                    previewContainer.style.display = 'none';
                    return;
                }

                // Kiểm tra kích thước file (dưới 10MB)
                if (file.size > 10000000) {
                    alert('File quá lớn! Chỉ hỗ trợ file dưới 10MB.');
                    event.target.value = '';
                    previewContainer.style.display = 'none';
                    return;
                }

                // Hiển thị ảnh preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
</div>