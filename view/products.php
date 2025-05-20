<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-2">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Danh sách sản phẩm</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">

            <!-- Price Filter Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Giá</h5>
                <form method="GET" action="index.php">
                    <!-- Tham số hiện tại -->
                    <input type="hidden" name="pg" value="products">
                    <input type="hidden" name="brand" value="<?= $brand_id ?>">
                    <input type="hidden" name="category" value="<?= $category_id ?>">
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                    <input type="hidden" name="keyword" value="<?= $keyword ?>">


                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-all" value=""
                            <?= ($price_range === null || $price_range === '') ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-all">Tất cả</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, null, null, $keyword); ?></span>
                    </div>


                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-0"
                            value="0-10000000"
                            <?= $price_range == '0-10000000' ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-0">Dưới 10 triệu</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, 0, 10000000, $keyword); ?></span>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-1"
                            value="10000000-20000000"
                            <?= $price_range == '10000000-20000000' ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-1">Từ 10 - 20 triệu</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, 10000000, 20000000, $keyword); ?></span>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-2"
                            value="20000000-30000000"
                            <?= $price_range == '20000000-30000000' ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-2">Từ 20 - 30 triệu</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, 20000000, 30000000, $keyword); ?></span>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-3"
                            value="30000000-40000000"
                            <?= $price_range == '30000000-40000000' ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-3">Từ 30 - 40 triệu</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, 30000000, 40000000, $keyword); ?></span>
                    </div>

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="price" class="custom-control-input" id="price-4"
                            value="40000000-999999999"
                            <?= $price_range == '40000000-999999999' ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="price-4">Trên 40 triệu</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category_id, 40000000, 999999999, $keyword); ?></span>
                    </div>
                </form>
            </div>
            <!-- Price Filter End -->

            <!-- Category Filter Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Danh mục</h5>
                <form method="GET" action="index.php">
                    <!-- Tham số hiện tại -->
                    <input type="hidden" name="pg" value="products">
                    <input type="hidden" name="brand" value="<?= $brand_id ?>">
                    <input type="hidden" name="price" value="<?= $price_range ?>">
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                    <input type="hidden" name="keyword" value="<?= $keyword ?>">

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="category" class="custom-control-input" id="category-all" value=""
                            <?= ($category_id === null || $category_id === '') ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="category-all">Tất cả</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, null, $min_price, $max_price, $keyword); ?></span>
                    </div>

                    <?php foreach ($categories as $category): ?>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="category" class="custom-control-input" id="category-<?= $category['id']; ?>"
                                value="<?= $category['id']; ?>"
                                <?= $category_id == $category['id'] ? 'checked' : ''; ?>
                                onchange="this.form.submit()">
                            <label class="custom-control-label" for="category-<?= $category['id']; ?>"><?= $category['name']; ?></label>
                            <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand_id, $category['id'], $min_price, $max_price, $keyword); ?></span>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <!-- Category Filter End -->

            <!-- Brand Filter Start -->
            <div class="mb-5">
                <h5 class="font-weight-semi-bold mb-4">Thương hiệu</h5>
                <form method="GET" action="index.php">
                    <!-- tham số hiện tại -->
                    <input type="hidden" name="pg" value="products">
                    <input type="hidden" name="category" value="<?= $category_id ?>">
                    <input type="hidden" name="price" value="<?= $price_range ?>">
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                    <input type="hidden" name="keyword" value="<?= $keyword ?>">

                    <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                        <input type="radio" name="brand" class="custom-control-input" id="brand-all" value=""
                            <?= ($brand_id === null || $brand_id === '') ? 'checked' : ''; ?>
                            onchange="this.form.submit()">
                        <label class="custom-control-label" for="brand-all">Tất cả</label>
                        <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser(null, $category_id, $min_price, $max_price, $keyword); ?></span>
                    </div>

                    <?php foreach ($brands as $brand): ?>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" name="brand" class="custom-control-input" id="brand-<?= $brand['id']; ?>"
                                value="<?= $brand['id']; ?>"
                                <?= $brand_id == $brand['id'] ? 'checked' : ''; ?>
                                onchange="this.form.submit()">
                            <label class="custom-control-label" for="brand-<?= $brand['id']; ?>"><?= $brand['name']; ?></label>
                            <span class="badge border font-weight-normal"><?= getTotalProductsWithFiltersForUser($brand['id'], $category_id, $min_price, $max_price, $keyword); ?></span>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <!-- Brand Filter End -->

        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="row mb-4">
                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                            <form action="index.php" method="GET" id="searchForm">
                                <input type="hidden" name="pg" value="products">
                                <input type="hidden" name="brand" value="<?= $brand_id ?>">
                                <input type="hidden" name="category" value="<?= $category_id ?>">
                                <input type="hidden" name="price" value="<?= $price_range ?>">
                                <input type="hidden" name="sort" value="<?= $sort ?>">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" id="searchInput" placeholder="Tìm kiếm sản phẩm" value="">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div id="searchTag" class="mt-3" style="display: <?= $keyword ? 'block' : 'none' ?>;">
                                <div class="d-inline-flex align-items-center px-3 py-2  rounded-pill shadow-sm border">
                                    <span class="text-dark mr-2">
                                        Từ khóa: <span id="keywordText" class="font-italic"><?= $keyword ?></span>
                                    </span>
                                    <a href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&sort=<?= $sort ?>"
                                        class="ml-3 btn btn-sm btn-light p-0 d-flex align-items-center justify-content-center rounded-circle border"
                                        style="width: 24px; height: 24px;"
                                        title="Xóa từ khóa tìm kiếm"
                                        id="clearSearch">
                                        <i class="fas fa-times text-primary " style="font-size: 14px;"></i>
                                    </a>
                                </div>
                            </div>



                        </div>

                        <div class="col-12 col-md-8 d-flex justify-content-end">

                            <div class="dropdown">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $sort_label ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&keyword=<?= $keyword ?>&sort=new">Mới nhất</a>
                                    <a class="dropdown-item" href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&keyword=<?= $keyword ?>&sort=sold">Bán chạy nhất</a>
                                    <a class="dropdown-item" href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&keyword=<?= $keyword ?>&sort=view">Xem nhiều nhất</a>
                                    <a class="dropdown-item" href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&keyword=<?= $keyword ?>&sort=pricedesc">Giá cao nhất</a>
                                    <a class="dropdown-item" href="index.php?pg=products&brand=<?= $brand_id ?>&category=<?= $category_id ?>&price=<?= $price_range ?>&keyword=<?= $keyword ?>&sort=priceasc">Giá thấp nhất</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php foreach ($products as $product) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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
                                <a href="index.php?pg=productdetail&id=<?= $product['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết</a>
                                <button class="btn btn-sm text-dark p-0 add-to-cart" data-product-id="<?= $product['id'] ?>"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <!-- Previous -->
                            <li class="page-item <?= $current_page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="index.php?pg=products&page=<?= $current_page - 1 ?><?= $brand_id ? "&brand=$brand_id" : '' ?><?= $category_id ? "&category=$category_id" : '' ?>&sort=<?= $sort ?>"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?= $current_page == $i ? 'active' : '' ?>">
                                    <a class="page-link"
                                        href="index.php?pg=products&page=<?= $i ?><?= $brand_id ? "&brand=$brand_id" : '' ?><?= $category_id ? "&category=$category_id" : '' ?>&sort=<?= $sort ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next -->
                            <li class="page-item <?= $current_page >= $total_pages ? 'disabled' : '' ?>">
                                <a class="page-link"
                                    href="index.php?pg=products&page=<?= $current_page + 1 ?><?= $brand_id ? "&brand=$brand_id" : '' ?><?= $category_id ? "&category=$category_id" : '' ?>&sort=<?= $sort ?>"
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>


            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->