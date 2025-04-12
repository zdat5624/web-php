<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1 custom-rounded">X</span>Laptopshop</h1>
            </a>
            <p>Khám phá thế giới Laptop chính hãng – Hiệu suất tối đa, giá thành tối ưu!</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>19 Nguyễn Hữu Thọ, Tân Phong, Quận 7, Hồ Chí Minh</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@tdtu.edu.vn</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Thông tin</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                        <a class="text-dark mb-2" href="index.php?pg=products"><i class="fa fa-angle-right mr-2"></i>Danh sách sản phẩm</a>
                        <a class="text-dark" href="index.php?pg=contact"><i class="fa fa-angle-right mr-2"></i>Liên hệ</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Về chúng tôi</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Trang chủ</a>
                        <a class="text-dark mb-2" href="index.php?pg=products"><i class="fa fa-angle-right mr-2"></i>Danh sách sản phẩm</a>
                        <a class="text-dark" href="index.php?pg=contact"><i class="fa fa-angle-right mr-2"></i>Liên hệ</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4">Nhận tin mới</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="#">XLaptopshop</a>.

            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="layout/img/payments.png" alt="">
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Toast Notification -->
<div id="toast-container" class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;"></div>


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="./layout/lib/easing/easing.min.js"></script>
<script src="./layout/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="./layout/mail/jqBootstrapValidation.min.js"></script>
<script src="./layout/mail/contact.js"></script>

<!-- Template Javascript -->
<script src="./layout/js/main.js"></script>


<!-- AJAX Login Script -->
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            var username = $('#username').val();
            var password = $('#password').val();

            console.log('Dữ liệu gửi:', {
                username,
                password
            });

            $.ajax({
                url: '/dao/ajax/login_ajax.php',
                type: 'POST',
                data: {
                    login: true,
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    // console.log('Phản hồi:', response);
                    if (response.status === 'success') {
                        $('#login-message').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#loginModal').modal('hide'); // Đóng modal
                        $('#auth-nav').html(
                            `<div class="nav-item dropdown">
                                            <a href="#" class="nav-link " data-toggle="dropdown">Xin chào, ${response.user && response.user.name ? response.user.name : 'Người dùng'}<i class="fas fa-user-cog ml-2"></i></i></a>
                                            <div class="dropdown-menu rounded-0 m-0">
                        ${response.user.role === 'ADMIN' ? '<a href="/admin/" class="dropdown-item">Trang quản trị</a>' : ''}
                                                <a href="index.php?pg=profile" class="dropdown-item">Thông tin cá nhân</a>
                                                <a href="index.php?pg=orders" class="dropdown-item">Đơn hàng</a>
                                                <a href="index.php?pg=cart" class="dropdown-item">Giỏ hàng</a>
                                                <a href="index.php?pg=logout" class="dropdown-item">Đăng xuất</a>
                                            </div>
                                        </div>'`
                        );
                        $('#loginForm')[0].reset(); // Reset form
                    } else {
                        $('#login-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    // console.log('Lỗi:', xhr.status, xhr.responseText);
                    $('#login-message').html('<div class="alert alert-danger">Lỗi: ' + xhr.status + ' - ' + error + '</div>');
                }
            });
        });

        // Xóa thông báo khi modal mở lại
        $('#loginModal').on('show.bs.modal', function() {
            $('#login-message').empty();
        });
    });
</script>

<script>
    function updateCartCount() {
        $.ajax({
            url: '/dao/ajax/cart_ajax.php',
            type: 'POST',
            data: {
                get_cart_count: true
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('.btn.border .badge').text(response.cart_count);
                }
            },
            error: function(xhr, status, error) {
                console.log('Lỗi AJAX:', xhr.responseText);
            }
        });
    }

    $(document).ready(function() {

        // khi người dùng nhập trực tiếp vào input
        $('.quantity-input').on('input', function() {
            var value = parseInt($(this).val());
            if (isNaN(value) || value < 1) {
                $(this).val(1);
            }
        });

        updateCartCount();

        //  nút Thêm vào giỏ
        $('.add-to-cart').on('click', function(e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            // lấy phần tử cha gần nhất có ".d-flex", từ phần tử cha lấy phần tử con có ".quantity-input"
            var quantityInput = $(this).closest('.d-flex').find('.quantity-input');
            var quantity = parseInt(quantityInput.val());

            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                quantityInput.val(1);
            }

            $.ajax({
                url: '/dao/ajax/cart_ajax.php',
                type: 'POST',
                data: {
                    add_to_cart: true,
                    product_id: product_id,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, type = 'success');
                        updateCartCount();
                    } else {
                        if (response.message.includes('đăng nhập')) {
                            $('#loginModal').modal('show');
                        } else {
                            alert(response.message);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi AJAX:', xhr.responseText);
                    alert('Đã xảy ra lỗi: ' + error);
                }
            });
        });


        // Xử lý nút giảm số lượng
        $('.btn-minus-cart').on('click', function(e) {
            e.preventDefault();
            var input = $(this).closest('.quantity').find('.update-quantity-input');
            var value = parseInt(input.val(), 10);
            var cart_detail_id = $(this).data('cart-detail-id');

            if (isNaN(value) || value < 1) {
                $(this).val(1);
                value = 1;
            }
            updateCartItem(cart_detail_id, value);
        });

        // cart page
        $('.btn-plus-cart').on('click', function(e) {
            e.preventDefault();
            var input = $(this).closest('.quantity').find('.update-quantity-input');
            var value = parseInt(input.val(), 10);
            var cart_detail_id = $(this).data('cart-detail-id');

            if (isNaN(value) || value < 1) {
                $(this).val(1);
                value = 1;
            }
            updateCartItem(cart_detail_id, value);
        });

        $('.update-quantity-input').on('input', function() {
            var value = parseInt($(this).val(), 10);
            var cart_detail_id = $(this).data('cart-detail-id');

            if (isNaN(value) || value < 1) {
                $(this).val(1);
                value = 1;
            }
            updateCartItem(cart_detail_id, value);
        });

        function updateCartItem(cart_detail_id, quantity) {
            $.ajax({
                url: '/dao/ajax/cart_ajax.php',
                type: 'POST',
                data: {
                    update_cart_item: true,
                    cart_detail_id: cart_detail_id,
                    quantity: quantity
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        showToast(response.message, 'success');
                        // selector class and atribute
                        $('.total-item[data-cart-detail-id="' + cart_detail_id + '"]').text(numberFormat(response.item_total));
                        // Cập nhật tổng giá giỏ hàng
                        $('.card-body .total-price').text(numberFormat(response.total_price) + ' VNĐ');
                        $('.card-footer .total-price').text(numberFormat(response.total_price) + ' VNĐ');
                    } else {
                        showToast(response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi AJAX:', xhr.responseText);
                    showToast('Đã xảy ra lỗi: ' + error, 'error');
                }
            });
        }




    });

    $('.btn-remove').on('click', function(e) {
        e.preventDefault();
        var cart_detail_id = $(this).data('cart-detail-id');

        $.ajax({
            url: '/dao/ajax/cart_ajax.php',
            type: 'POST',
            data: {
                remove_cart_item: true,
                cart_detail_id: cart_detail_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    showToast(response.message, 'success');
                    // xóa hàng 
                    $('button[data-cart-detail-id="' + cart_detail_id + '"]').closest('tr').remove();
                    // Cập nhật số lượng sản phẩm trong giỏ
                    updateCartCount();
                    // Cập nhật total price
                    $('.card-body .total-price').text(numberFormat(response.total_price) + ' VNĐ');
                    $('.card-footer .total-price').text(numberFormat(response.total_price) + ' VNĐ');
                    // giỏ hàng rỗng
                    if (response.cart_count === 0) {
                        $('tbody').html('<tr><td colspan="5" class="text-center">Giỏ hàng của bạn đang trống.</td></tr>');
                    }
                } else {
                    showToast(response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.log('Lỗi AJAX:', xhr.responseText);
                showToast('Đã xảy ra lỗi: ' + error, 'error');
            }
        });
    });

    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>

<script>
    function showToast(message, type = 'success') {

        if ($('#toast-container .toast').length >= 3) {
            $('#toast-container .toast').first().remove();
        }

        // Tạo ID duy nhất cho toast
        var randomInt = Math.floor(Math.random() * 10000);
        toastId = 'toast-' + new Date().getTime() + '-' + randomInt;

        var toastHtml = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                <div class="toast-header">
                    <strong class="mr-auto ${type === 'success' ? 'text-success' : 'text-danger'}">${type === 'success' ? 'Thông báo' : 'Lỗi'}</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;

        // Thêm toast vào container
        $('#toast-container').append(toastHtml);

        // Hiển thị toast
        $('#' + toastId).toast('show');

        // Xóa toast khỏi DOM sau khi ẩn
        $('#' + toastId).on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
</script>


</body>

</html>