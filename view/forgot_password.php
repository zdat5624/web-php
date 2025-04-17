<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Quên mật khẩu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Forgot Password Start -->
<div class="container-fluid pt-2">
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-4 col-12">
            <div class="mb-2">
                <h4 class="font-weight-semi-bold mb-4 text-gradient text-center" style="font-family: 'Poppins', sans-serif;">Quên mật khẩu</h4>
                <div class="card border-primary shadow-lg rounded-lg">
                    <div class="card-body">
                        <div id="alert-message" class="mb-3"></div>
                        <form id="forgotPasswordForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <small class="form-text text-muted">Chúng tôi sẽ gửi liên kết đặt lại mật khẩu.</small>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 py-2">Gửi</button>
                            </div>
                        </form>
                        <p class="text-center mt-3">Đã có tài khoản? <a href="#" data-toggle="modal" data-target="#loginModal">Đăng nhập ngay</a></p>
                        <p class="text-center mt-2">Chưa có tài khoản? <a href="index.php?pg=register">Đăng ký ngay</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Forgot Password End -->

<!-- AJAX Forgot Password -->
<script>
    $(document).ready(function() {
        $('#forgotPasswordForm').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                email: $('#email').val().trim(),
                forgot_password: true
            };

            if (!formData.email) {
                $('#alert-message').html(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    'Vui lòng nhập email.' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                );
                return;
            }

            $.ajax({
                url: '/dao/ajax/forgot_password_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#alert-message').html(
                        '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                    if (response.status === 'success') {
                        $('#forgotPasswordForm')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    $('#alert-message').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Đã có lỗi xảy ra. Vui lòng thử lại sau.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                }
            });
        });
    });
</script>