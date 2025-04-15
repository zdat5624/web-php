<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thông tin cá nhân</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Profile Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <?php if (isset($_SESSION['user'])): ?>
            <?php include "sidebar.php"; ?>
            <div class="col-lg-9 col-12 order-lg-2 order-2 mt-4 mt-lg-0">
            <?php else: ?>
                <div class="col-lg-12 col-12 order-2">
                <?php endif; ?>
                <div class="mb-5">
                    <h4 class="font-weight-semi-bold mb-4 text-gradient" style="font-family: 'Poppins', sans-serif;">Thông tin cá nhân</h4>
                    <div class="card border-primary shadow-lg rounded-lg">
                        <div class="card-body">
                            <div id="alert-message" class="mb-3"></div>
                            <form id="profileForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo ($_SESSION['user']['name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo ($_SESSION['user']['email']); ?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo ($_SESSION['user']['address'] ?? ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo ($_SESSION['user']['phone'] ?? ''); ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
    <!-- Profile End -->