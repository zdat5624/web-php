<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đăng ký</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Register Start -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-6 col-12">
            <div class="mb-2">
                <h4 class="font-weight-semi-bold mb-4 text-gradient text-center" style="font-family: 'Poppins', sans-serif;">Đăng ký tài khoản</h4>
                <div class="card border-primary shadow-lg rounded-lg">
                    <div class="card-body">
                        <div id="alert-message" class="mb-3"></div>
                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="input_password" name="password" required autocomplete="new-password">
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control" id="input_confirm_password" name="confirm_password" required autocomplete="new-password">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="text-right"><a href="index.php?pg=forgot_password">Quên mật khẩu?</a></div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4">Đăng ký</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">Đã có tài khoản? <a href="#" data-toggle="modal" data-target="#loginModal">Đăng nhập ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register End -->