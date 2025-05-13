<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary mb-0">Thêm sản phẩm</h2>
        <a href="index.php?pg=products" class="btn btn-outline-secondary">
            ← Quay lại
        </a>
    </div>
    <form action="index.php?pg=addproduct" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá (VND)</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả ngắn</label>
            <textarea name="short_desc" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Mô tả chi tiết</label>
            <textarea name="detail_desc" id="detail_desc" class="form-control" style="height: 500px;"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Lượt xem</label>
            <input type="number" name="view" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Lượt bán</label>
            <input type="number" name="sold" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label class="form-label">Thương hiệu</label>
            <select name="brand_id" class="form-control" required>
                <option value="">-- Chọn thương hiệu --</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand['id'] ?>">
                        <?= $brand['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label>
            <input type="file" name="image" class="form-control" id="imageUpload" onchange="previewImage(event)" required>
            <br>
            <img id="preview" src="#" alt="Ảnh xem trước" style="max-width: 150px; display: none; margin-top: 10px;">
        </div>

        <button type="submit" name="addproduct" class="btn btn-primary">Thêm sản phẩm</button>
    </form>

    <!-- CKEditor 5 CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Định nghĩa custom upload adapter
        class UploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            // Xử lý upload ảnh
            upload() {
                return this.loader.file.then(file => new Promise((resolve, reject) => {
                    const data = new FormData();
                    data.append('upload', file);

                    // Gửi yêu cầu đến endpoint upload ảnh
                    fetch('/ckeditor/upload_image.php', {
                            method: 'POST',
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.uploaded) {
                                resolve({
                                    default: result.url
                                });
                            } else {
                                reject(result.message);
                            }
                        })
                        .catch(error => {
                            reject('Upload failed: ' + error);
                        });
                }));
            }

            abort() {
                // Xử lý hủy upload
            }
        }

        // Hàm gắn adapter vào CKEditor
        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new UploadAdapter(loader);
            };
        }

        // Khởi tạo CKEditor
        ClassicEditor
            .create(document.querySelector('#detail_desc'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'imageUpload', 'blockQuote', 'insertTable', 'undo', 'redo'],
                alignment: {
                    options: ['left', 'center', 'right', 'justify']
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Xem trước ảnh
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = "block";
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</div>


<style>
    .ck-editor__editable {
        min-height: 300px !important;
        /* Chiều cao tối thiểu */
    }
</style>