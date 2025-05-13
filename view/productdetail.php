<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0"><a href="index.php?pg=products">Danh sách sản phẩm</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Chi tiết</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Detail Start -->
<div class="container-fluid py-2 ">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="<?= IMG_PATH_USER . $product['image']; ?>" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 pb-5 mt-3">
            <h3 class="font-weight-semi-bold mb-4"><?= $product['name'] ?></h3>
            <h3 class="font-weight-semi-bold mb-4"><?= number_format($product['price']) ?> VNĐ</h3>
            <p class="mb-5"><?= $product['short_desc'] ?></p>
            <div class="d-flex align-items-center mb-4 pt-2">
                <div class="input-group quantity mr-3" style="width: 130px;">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-minus" type="button">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="number" class="form-control bg-secondary text-center quantity-input" value="1" min="1" step="1">
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-plus" type="button">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button class="btn btn-primary px-3 add-to-cart" data-product-id="<?= $product['id'] ?>"><i class="fa fa-shopping-cart mr-1"></i> Thêm vào giỏ</button>
            </div>
        </div>
    </div>

    <div class="description-section px-xl-5">
        <h4 class="font-weight-semi-bold mb-3">Mô tả chi tiết sản phẩm</h4>
        <div class="description-content">
            <div class="short-desc" style="max-height: 200px; overflow: hidden; position: relative;">
                <?= $product['detail_desc'] ?>
                <div class="fade-overlay"></div> <!-- Lớp gradient mờ -->
            </div>
            <div class="full-desc" style="display: none;">
                <?= $product['detail_desc'] ?>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-link read-more-btn font-weight-bold"> Xem thêm ↓</button>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<!-- Products Start -->
<!-- <div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Tương tự</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="<?= IMG_PATH_USER . $product['image']; ?>" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">Colorful Stylish Shirt</h6>
                        <div class="d-flex justify-content-center">
                            <h6>$123.00</h6>
                            <h6 class="text-muted ml-2"><del>$123.00</del></h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Products End -->

<!-- JavaScript để xử lý chức năng Xem thêm/Thu gọn -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreBtn = document.querySelector('.read-more-btn');
        const shortDesc = document.querySelector('.short-desc');
        const fullDesc = document.querySelector('.full-desc');

        if (readMoreBtn && shortDesc && fullDesc) {
            readMoreBtn.addEventListener('click', function() {
                if (fullDesc.style.display === 'none') {
                    // Hiển thị toàn bộ mô tả
                    shortDesc.style.display = 'none';
                    fullDesc.style.display = 'block';
                    readMoreBtn.textContent = 'Thu gọn ↑'; // Sử dụng ký tự Unicode U+2191
                    readMoreBtn.classList.add('collapsed');
                } else {
                    // Thu gọn mô tả
                    shortDesc.style.display = 'block';
                    fullDesc.style.display = 'none';
                    readMoreBtn.textContent = 'Xem thêm ↓'; // Sử dụng ký tự Unicode U+2193
                    readMoreBtn.classList.remove('collapsed');
                }
            });

            // Kiểm tra nếu nội dung vượt quá giới hạn để hiển thị nút
            const shortDescHeight = shortDesc.scrollHeight;
            if (shortDescHeight <= 200) {
                readMoreBtn.style.display = 'none'; // Ẩn nút nếu nội dung ngắn
            }
        }
    });
</script>

<style>
    .short-desc {
        position: relative;
        max-height: 200px;
        overflow: hidden;
    }

    .fade-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 90px;
        background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.9));
        pointer-events: none;
    }



    .description-content img {
        max-width: 100%;
        height: auto;
        margin: 0 auto;
        display: block;
    }
</style>