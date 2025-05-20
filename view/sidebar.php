<div class="col-lg-3 col-12 mb-4">
    <div class="card border-secondary">
        <div class="card-header bg-secondary border-0">
            <h4 class="font-weight-semi-bold m-0">Tài khoản</h4>
        </div>
        <div class="card-body">
            <h5 class="font-weight-medium mb-1"><?= ($_SESSION['user']['name']); ?></h5>
            <p class="mb-3"><?= ($_SESSION['user']['email']); ?></p>
            <ul class="list-group">
                <li class="list-group-item <?= $_GET['pg'] === 'cart' ? 'active' : ''; ?>">
                    <a href="index.php?pg=cart" class="text-decoration-none <?= $current_page === 'cart' ? 'text-white' : 'text-dark'; ?>">Giỏ hàng</a>
                </li>
                <li class="list-group-item <?= $_GET['pg'] === 'orders' ? 'active' : ''; ?>">
                    <a href="index.php?pg=orders" class="text-decoration-none <?= $current_page === 'orders' ? 'text-white' : 'text-dark'; ?>">Đơn hàng</a>
                </li>
                <li class="list-group-item <?= $_GET['pg'] === 'profile' ? 'active' : ''; ?>">
                    <a href="index.php?pg=orders" class="text-decoration-none <?= $current_page === 'profile' ? 'text-white' : 'text-dark'; ?>">Thông tin cá nhân</a>
                </li>
                <li class="list-group-item <?= $_GET['pg'] ===  'change_password' ? 'active' : ''; ?>">
                    <a href="index.php?pg=change_password" class="text-decoration-none <?php echo $current_page === 'change_password' ? 'text-white' : 'text-dark'; ?>">Đổi mật khẩu</a>
                </li>

                <li class="list-group-item">
                    <a href="index.php?pg=logout" class="text-decoration-none text-dark">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </div>
</div>