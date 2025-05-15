<?php
$page_title = 'X';
if (!isset($_GET['pg'])) {
    $page_title = 'Trang chủ | XLaptopshop';
} else {
    switch ($_GET['pg']) {
        case  'products':
            $page_title = 'Sản phẩm | XLaptopshop';
            break;
        case  'contact':
            $page_title = 'Liện hệ  | XLaptopshop';
            break;
        case  'profile':
            $page_title = 'Thông tin cá nhân  | XLaptopshop';
            break;
        case  'cart':
            $page_title = 'Giỏ hàng  | XLaptopshop';
            break;
        case  'orders':
            $page_title = 'Đơn hàng  | XLaptopshop';
            break;
        case  'change_password':
            $page_title = 'Đổi mật khẩu  | XLaptopshop';
            break;
        case  'register':
            $page_title = 'Đăng ký  | XLaptopshop';
            break;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $page_title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="XLaptopshop, laptop, mua laptop, bán laptop, laptop giá rẻ, laptop gaming, laptop văn phòng, laptop đồ họa, laptop AI, cửa hàng laptop, laptop chính hãng, laptop mới">
    <meta name="description" content="XLaptopshop - Chuyên cung cấp các dòng laptop chính hãng, laptop gaming, laptop đồ họa, laptop văn phòng với giá tốt nhất. Mua laptop uy tín, bảo hành dài hạn, giao hàng tận nơi.">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="./layout/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./layout/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-map-marker-alt text-primary mr-3"></i>
                    19 Nguyễn Hữu Thọ, Tân Phong, Quận 7, Hồ Chí Minh
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold" style="white-space: nowrap;">
                        <span class="text-primary font-weight-bold border px-3 mr-1 custom-rounded">X</span>
                        <span>Laptopshop</span>
                    </h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
            </div>
            <div class="col-lg-3 col-6 text-right " id="cart-icon">
                <!-- <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a> -->
                <?php
                if (isset($_SESSION['user'])) {
                    $user_id = $_SESSION['user']['id'];
                    $cart = getCartByUserId($user_id);
                    $cart_item_count = 0;
                    if ($cart) {
                        $cart_details = getCartDetails($cart['id']);
                        $cart_item_count = count($cart_details);
                    }
                    echo '<a href="index.php?pg=cart" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">' . $cart_item_count . '</span>
                    </a>';
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-3">
        <div class="row border-top px-xl-5">
            <!-- Categories -->
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100 category-btn"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0 category-title">Danh Mục</h6>
                    <i class="fa fa-angle-down text-dark category-arrow"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-y-auto">
                        <?php
                        foreach ($categories as $category) {
                            echo '<a href="index.php?pg=products&category=' . $category['id'] . '" class="nav-item nav-link">' . $category['name'] . '</a>';
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <!-- End Categories -->

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">X</span>Laptopshop</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link <?= !isset($_GET['pg'])   ? 'active' : '' ?> ">Trang chủ</a>
                            <a href="index.php?pg=products" class="nav-item nav-link <?= isset($_GET['pg']) && $_GET['pg'] === 'products' ? 'active' : '' ?>">Sản phẩm</a>
                            <!-- <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="index.php?pg=cart" class="dropdown-item">Giỏ hàng</a>
                                    <a href="index.php?pg=checkout" class="dropdown-item">Thanh toán</a>
                                </div>
                            </div> -->
                            <a href="index.php?pg=contact" class="nav-item nav-link <?= isset($_GET['pg']) && $_GET['pg'] === 'contact' ? 'active' : '' ?>">Liên hệ</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0" id="auth-nav">
                            <?php
                            //ADMIN
                            if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'ADMIN') {
                                echo '
                                        <div class="nav-item dropdown">
                                            <a href="#" class="nav-link " data-toggle="dropdown">Xin chào, ' . $_SESSION['user']['name'] . '<i class="fas fa-user-cog ml-2"></i></i></a>
                                            <div class="dropdown-menu rounded-0 m-0">
                                                <a href="/admin/" class="dropdown-item">Trang quản trị</a>
                                                <a href="index.php?pg=profile" class="dropdown-item">Thông tin cá nhân</a>
                                                <a href="index.php?pg=orders" class="dropdown-item">Đơn hàng của bạn</a>
                                                <a href="index.php?pg=cart" class="dropdown-item">Giỏ hàng của bạn</a>
                                                <a href="index.php?pg=change_password" class="dropdown-item">Đổi mật khẩu</a>
                                                <a href="index.php?pg=logout" class="dropdown-item">Đăng xuất</a>
                                            </div>
                                        </div>';
                            } else if (isset($_SESSION['user'])) {
                                //USER
                                echo '
                                        <div class="nav-item dropdown">
                                            <a href="#" class="nav-link" data-toggle="dropdown">Xin chào, ' . $_SESSION['user']['name'] . '<i class="fas fa-user-cog ml-2"></i></i></a>
                                            <div class="dropdown-menu rounded-0 m-0">
                                                <a href="index.php?pg=profile" class="dropdown-item">Thông tin cá nhân</a>
                                                <a href="index.php?pg=orders" class="dropdown-item">Đơn hàng của bạn</a>
                                                <a href="index.php?pg=cart" class="dropdown-item">Giỏ hàng của bạn</a>
                                                <a href="index.php?pg=change_password" class="dropdown-item">Đổi mật khẩu</a>
                                                <a href="index.php?pg=logout" class="dropdown-item">Đăng xuất</a>
                                            </div>
                                        </div>';
                            } else {
                                // Hiển thị liên kết Đăng nhập và Đăng ký khi chưa đăng nhập
                                echo '
                                    <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#loginModal">Đăng nhập</a>
                                    <a href="index.php?pg=register" class="nav-item nav-link">Đăng ký</a>';
                            }
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="login-message"></div>
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="text-right mb-2"><a href="index.php?pg=forgot_password">Quên mật khẩu?</a></div>
                        <button type="submit" name="login" class="btn btn-primary btn-block">Đăng nhập</button>
                    </form>
                    <p class="text-center mt-3">Chưa có tài khoản? <a href="index.php?pg=register">Đăng ký ngay</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->


</body>

</html>