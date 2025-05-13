<div id="header-carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php


        foreach ($slides as $index => $slide) {
            if ($index === 0) {
                echo '
                <div class="carousel-item active">
                    <a href="' . $slide['link'] . '" class="carousel-link">
                        <div class="carousel-image-wrapper">
                            <img class="img-fluid" src="' . IMG_PATH_USER . $slide['image'] . '" alt="Image">
                        </div>
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <span class="view-now">Xem ngay</span>
                            </div>
                        </div>
                    </a>
                </div>
                        ';
            } else {
                echo '
                <div class="carousel-item">
                    <a href="' . $slide['link'] . '" class="carousel-link">
                        <div class="carousel-image-wrapper">
                            <img class="img-fluid" src="' . IMG_PATH_USER . $slide['image'] . '" alt="Image">
                        </div>
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <span class="view-now">Xem ngay</span>
                            </div>
                        </div>
                    </a>
                </div>
                        ';
            }
        }

        ?>

        <!-- <div class="carousel-item active">
            <a href="index.php?pg=profile" class="carousel-link">
                <div class="carousel-image-wrapper">
                    <img class="img-fluid" src="upload/H1_1440x242_31b060c70b.png" alt="Image">
                </div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <span class="view-now">Xem ngay</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="carousel-item">
            <a href="index.php?pg=profile" class="carousel-link">
                <div class="carousel-image-wrapper">
                    <img class="img-fluid" src="upload/H1_1440x242_126dbedd86.png" alt="Image">
                </div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <span class="view-now">Xem ngay</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="carousel-item">
            <a href="index.php?pg=profile" class="carousel-link">
                <div class="carousel-image-wrapper">
                    <img class="img-fluid" src="upload/H1_1440x242_31b060c70b.png" alt="Image">
                </div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <span class="view-now">Xem ngay</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="carousel-item">
            <a href="index.php?pg=profile" class="carousel-link">
                <div class="carousel-image-wrapper">
                    <img class="img-fluid" src="upload/H1_1440x242_126dbedd86.png" alt="Image">
                </div>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <span class="view-now">Xem ngay</span>
                    </div>
                </div>
            </a>
        </div> -->
    </div>
    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-prev-icon mb-n2"></span>
        </div>
    </a>
    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
        <div class="btn btn-dark" style="width: 45px; height: 45px;">
            <span class="carousel-control-next-icon mb-n2"></span>
        </div>
    </a>
</div>

<!-- Featured Start -->
<div class="container-fluid pt-4">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Chất lượng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14 ngày trả hàng</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->


<!-- Categories Start -->
<!-- <div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-1.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Men's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-2.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Women's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-3.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Baby's dresses</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-4.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Accerssories</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-5.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Bags</h5>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">15 Products</p>
                <a href="" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="layout/img/cat-6.jpg" alt="">
                </a>
                <h5 class="font-weight-semi-bold m-0">Shoes</h5>
            </div>
        </div>
    </div>
</div> -->
<!-- Categories End -->

<!-- Products Start -->
<div class="container-fluid pt-4">
    <div class="text-center mb-4">
        <h2 class="section-title px-5" style="font-family: 'Poppins', sans-serif !important;">
            <span class="px-2">Sản Phẩm Bán Chạy</span>
        </h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php foreach ($bestSellingProducts as $product) : ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="<?= IMG_PATH_USER . $product['image']; ?>" alt="<?= $product['name'] ?>">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3 px-2"><?= $product['name'] ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6><?= number_format($product['price']) ?> VNĐ</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="index.php?pg=productdetail&id=<?= $product['id'] ?>" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết
                        </a>
                        <button class="btn btn-sm text-dark p-0 add-to-cart" data-product-id="<?= $product['id'] ?>"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-1">
        <a href="index.php?pg=products&sort=sold" class="btn btn-primary py-2 px-3">Xem Thêm</a>
    </div>
</div>
<!-- Products End -->


<!-- Subscribe Start -->
<!-- <div class="container-fluid bg-secondary my-5">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- Subscribe End -->


<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class=" section-title px-5" style="font-family: 'Poppins', sans-serif !important;">
            <span class="px-2">Sản Phẩm Mới</span>
        </h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php foreach ($newProducts as $product): ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="<?= IMG_PATH_USER . $product['image']; ?>" alt="<?= $product['name']; ?>">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3 px-2"><?= $product['name']; ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6><?= number_format($product['price']); ?> VNĐ</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="index.php?pg=productdetail&id=<?= $product['id'] ?>" class="btn btn-sm text-dark p-0">
                            <i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết
                        </a>
                        <button class="btn btn-sm text-dark p-0 add-to-cart" data-product-id="<?= $product['id'] ?>"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-1">
        <a href="index.php?pg=products&sort=new" class="btn btn-primary py-2 px-3">Xem Thêm</a>
    </div>
</div>
<!-- Products End -->


<!-- Vendor Start : list brand -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5" style="font-family: 'Poppins', sans-serif !important;">
            <span class="px-2">Thương Hiệu</span>
        </h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <?php foreach ($brands as $brand): ?>
                    <a href="index.php?pg=products&brand=<?= $brand['id'] ?>" class="vendor-item border p-4 text-decoration-none">
                        <span>
                            <?= $brand['name'] ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->

<style>
    /* Đảm bảo carousel-item có vị trí tương đối để định vị văn bản */
    .carousel-item {
        position: relative;
    }

    /* Wrapper để duy trì tỷ lệ khung hình */
    .carousel-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 16.8056%;
        /* Tỷ lệ 242/1440 = 16.8056% */
        overflow: hidden;
    }

    .carousel-image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo hình ảnh không bị méo, nhưng có thể bị cắt */
    }

    /* Định dạng văn bản "Xem ngay" */
    .view-now {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px 20px;
        border-radius: 5px;
        z-index: 10;
    }

    /* Hiển thị văn bản và làm mờ ảnh khi hover */
    .carousel-link:hover .view-now {
        display: block;
    }

    .carousel-link:hover img {
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    /* Responsive cho màn hình nhỏ */
    @media (max-width: 576px) {
        .carousel-image-wrapper {
            padding-top: 50%;
            /* Tăng tỷ lệ khung hình cho màn hình nhỏ để hiển thị đầy đủ hơn */
        }

        .view-now {
            font-size: 16px;
            /* Giảm kích thước chữ trên màn hình nhỏ */
            padding: 8px 16px;
        }

        .carousel-caption .p-3 {
            max-width: 100%;
            /* Đảm bảo caption không vượt quá màn hình */
        }
    }
</style>