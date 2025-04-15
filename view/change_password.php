<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đổi mật khẩu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Change Password Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <?php if (isset($_SESSION['user'])): ?>
            <?php include "sidebar.php"; ?>
            <div class="col-lg-9 col-12 order-lg-2 order-2 mt-4 mt-lg-0">
            <?php else: ?>
                <div class="col-lg-12 col-12 order-2">
                <?php endif; ?>
                <div class="mb-5">
                    <h4 class="font-weight-semi-bold mb-4 text-gradient" style="font-family: 'Poppins', sans-serif;">Đổi mật khẩu</h4>
                    <div class="card border-primary shadow-lg rounded-lg">
                        <div class="card-body">
                            <div id="alert-message" class="mb-3"></div>
                            <form id="changePasswordForm">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
    <!-- Change Password End -->