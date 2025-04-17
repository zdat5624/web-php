<?php


$email = isset($_GET['email']) ? trim($_GET['email']) : '';
$token = isset($_GET['token']) ? trim($_GET['token']) : '';

$tokenData = getTokenData($token);
$user = getUserByEmail($email);

?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-3">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Đặt lại mật khẩu</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<div class="container pt-2">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Đặt lại mật khẩu</h3>

            <div class="card border-primary shadow-lg rounded-lg">
                <div class="card-body">

                    <div id="alert-message-success" class="mb-3">
                        <div id="alert-message-error" class="mb-3"></div>
                        <form id="resetPasswordForm">
                            <?php


                            if (!$user || !$tokenData) {
                                echo '<div class="alert alert-danger">Liên kết không hợp lệ.</div>';
                            } else {

                                echo '
                        <form id="resetPasswordForm">
                            <input type="hidden" name="email" id="email" value="' . $email . '">
                            <input type="hidden" name="token" id="token" value="' . $token . '">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Đặt lại mật khẩu</button>
                            </div>
                        ';
                            }
                            ?>
                        </form>
                    </div>
                    <p class="text-center mt-3"><a href="index.php?pg=login">Quay lại đăng nhập</a></p>

                </div>
            </div>
        </div>
    </div>
</div>