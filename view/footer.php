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


<!-- AJAX Login -->
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
                                                <a href="index.php?pg=orders" class="dropdown-item">Đơn hàng của bạn</a>
                                                <a href="index.php?pg=cart" class="dropdown-item">Giỏ hàng của bạn</a>
                                                <a href="index.php?pg=cart" class="dropdown-item">Đổi mật khẩu</a>
                                                <a href="index.php?pg=logout" class="dropdown-item">Đăng xuất</a>
                                            </div>
                                        </div>'`
                        );
                        $.ajax({
                            url: '/dao/ajax/cart_ajax.php',
                            type: 'POST',
                            data: {
                                get_cart_count: true
                            },
                            dataType: 'json',
                            success: function(cartResponse) {
                                if (cartResponse.status === 'success') {
                                    $('#cart-icon').html(
                                        `<a href="index.php?pg=cart" class="btn border">
                                            <i class="fas fa-shopping-cart text-primary"></i>
                                            <span class="badge">${cartResponse.cart_count}</span>
                                        </a>`
                                    );
                                } else {
                                    $('#cart-icon').html('');
                                }
                            },
                            error: function() {
                                $('#cart-icon').html('');
                            }
                        });
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

<!-- AJAX  Profile-->
<script>
    $(document).ready(function() {
        $('#profileForm').on('submit', function(e) {
            e.preventDefault(); // Ngăn form gửi thông thường

            // Lấy giá trị từ các input thủ công
            var name = $('#name').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var phone = $('#phone').val();

            // Tạo object dữ liệu để gửi
            var formData = {
                name: name,
                address: address,
                phone: phone
            };

            $.ajax({
                url: '/dao/ajax/profile_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Hiển thị thông báo
                    $('#alert-message').html(
                        '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                    // Cập nhật giá trị input nếu thành công
                    if (response.status === 'success') {
                        setTimeout(function() {
                            location.reload(); // Tạm thời reload để cập nhật giao diện
                        }, 1500);
                    }
                },
                error: function() {
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

<!-- AJAX Change Password -->
<script>
    $(document).ready(function() {
        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault();

            var current_password = $('#current_password').val();
            var new_password = $('#new_password').val();
            var confirm_password = $('#confirm_password').val();

            var formData = {
                current_password: current_password,
                new_password: new_password,
                confirm_password: confirm_password
            };

            $.ajax({
                url: '/dao/ajax/change_password_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Hiển thị thông báo
                    $('#alert-message').html(
                        '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show" role="alert">' +
                        response.message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                    // Reset form nếu thành công
                    if (response.status === 'success') {
                        $('#changePasswordForm')[0].reset();
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function() {
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
<!--  AJAX Register -->
<script>
    $(document).ready(function() {
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                email: $('#email').val(),
                password: $('#input_password').val(),
                confirm_password: $('#input_confirm_password').val(),
                name: $('#name').val(),
                phone: $('#phone').val(),
                address: $('#address').val()
            };

            $.ajax({
                url: '/dao/ajax/register_ajax.php',
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
                        $('#registerForm')[0].reset();
                        setTimeout(function() {
                            window.location.href = 'index.php?pg=profile';
                        }, 1000);
                    }
                },
                error: function() {
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

<!-- AJAX forgot password -->
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

            var $btn = $('button[type="submit"]');
            $btn.prop('disabled', true).text('Đang xử lý...');

            $.ajax({
                url: '/dao/ajax/forgot_password_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#alert-message').html(
                        '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + ' alert-dismissible fade show" role="alert">' +
                        response.message
                    );
                    if (response.status === 'success') {
                        $('#forgotPasswordForm')[0].reset();
                    }
                    $btn.prop('disabled', false).text('Gửi');
                },
                error: function() {
                    $('#alert-message').html(
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Đã có lỗi xảy ra. Vui lòng thử lại sau.'
                    );
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#resetPasswordForm').on('submit', function(e) {
            e.preventDefault();

            var formData = {
                email: $('#email').val(),
                token: $('#token').val(),
                new_password: $('#new_password').val().trim(),
                confirm_password: $('#confirm_password').val().trim(),
                reset_password: true
            };

            var $btn = $('button[type="submit"]');
            $btn.prop('disabled', true).text('Đang xử lý...');

            $.ajax({
                url: '/dao/ajax/reset_password_ajax.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $btn.prop('disabled', false).text('Đặt lại mật khẩu');

                    if (response.status === 'success') {
                        $('#resetPasswordForm')[0].reset();
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 2500);
                        $('#alert-message-success').html(
                            '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + '">' +
                            response.message +
                            '</div>'
                        );
                    } else {
                        $('#alert-message-error').html(
                            '<div class="alert alert-' + (response.status === 'success' ? 'success' : 'danger') + '">' +
                            response.message +
                            '</div>'
                        );
                    }
                },
                error: function() {
                    $btn.prop('disabled', false).text('Đặt lại mật khẩu');
                    $('#alert-message-error').html(
                        '<div class="alert alert-danger">Đã có lỗi xảy ra. Vui lòng thử lại sau.</div>'
                    );
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
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

            var $btn = $(this);
            $btn.prop('disabled', true);

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
                    $btn.prop('disabled', false);
                    if (response.status === 'success') {
                        showToast(response.message, type = 'success');
                        updateCartCount();

                    } else if (response.status === 'warning') {
                        showToast(response.message, type = 'warning');
                    } else {

                        if (response.message.includes('đăng nhập')) {
                            $('#loginModal').modal('show');
                        } else {
                            showToast(response.message, type = 'error');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Lỗi AJAX:', xhr.responseText);
                    alert('Đã xảy ra lỗi: ' + error);
                    $btn.prop('disabled', false);
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
                            $('.btn-to-checkout').remove();
                        }
                    } else if (response.status === 'warning') {
                        showToast(response.message, 'warning');
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


    });


    function numberFormat(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>

<script>
    $(document).ready(function() {
        if ($('#province').length > 0) {
            let selectedProvince = '';
            let selectedDistrict = '';
            let selectedWard = '';
            let street = '';

            function updateFullAddress() {
                let addressParts = [];
                if (street) addressParts.push(street);
                if (selectedWard) addressParts.push(selectedWard);
                if (selectedDistrict) addressParts.push(selectedDistrict);
                if (selectedProvince) addressParts.push(selectedProvince);

                let fullAddress = addressParts.join(', ');
                $('#full_address').val(fullAddress);
            }

            // Lấy danh sách tỉnh/thành phố
            $.ajax({
                url: '/dao/ajax/address_ajax.php',
                type: 'GET',
                data: {
                    get_all_provinces: true
                },
                dataType: 'json',

                success: function(response) {
                    if (response.status === 'success' && response.provinces && response.provinces.length > 0) {
                        const $select = $('#province');
                        $select.empty();
                        $select.append('<option value="">Chọn tỉnh/thành phố</option>');
                        $.each(response.provinces, function(index, province) {
                            $select.append(`<option value="${province.code}">${province.name}</option>`);
                        });
                        $select.prop('disabled', false);
                    } else {
                        showToast(response.message || 'Không có tỉnh/thành phố nào', 'error');
                        $('#province').html('<option value="">Không có dữ liệu</option>').prop('disabled', true);
                    }
                },
                error: function(xhr, status, error) {
                    showToast('Lỗi khi lấy tỉnh/thành phố: ' + error, 'error');
                    $('#province').html('<option value="">Lỗi tải dữ liệu</option>').prop('disabled', true);
                }
            });

            $('#province').on('change', function() {
                let provinceCode = $(this).val();
                selectedProvince = provinceCode ? $(this).find('option:selected').text() : '';
                $('#district').prop('disabled', true).html('<option value="">Chọn quận/huyện</option>');
                $('#ward').prop('disabled', true).html('<option value="">Chọn phường/xã</option>');
                selectedDistrict = '';
                selectedWard = '';
                updateFullAddress();

                if (provinceCode) {
                    $.ajax({
                        url: '/dao/ajax/address_ajax.php',
                        type: 'GET',
                        data: {
                            get_districts_by_province_code: true,
                            province_code: provinceCode
                        },
                        dataType: 'json',

                        success: function(response) {
                            if (response.status === 'success' && response.districts && response.districts.length > 0) {
                                const $select = $('#district');
                                $select.empty();
                                $select.append('<option value="">Chọn quận/huyện</option>');
                                $.each(response.districts, function(index, district) {
                                    $select.append(`<option value="${district.code}">${district.name}</option>`);
                                });
                                $select.prop('disabled', false);
                            } else {
                                showToast(response.message || 'Không lấy được danh sách quận/huyện', 'error');
                                $('#district').html('<option value="">Không có dữ liệu</option>').prop('disabled', true);
                            }
                        },
                        error: function(xhr, status, error) {
                            showToast('Lỗi khi lấy quận/huyện: ' + error, 'error');
                            $('#district').html('<option value="">Lỗi tải dữ liệu</option>').prop('disabled', true);
                        }
                    });
                }
            });

            $('#district').on('change', function() {
                let districtCode = $(this).val();
                selectedDistrict = districtCode ? $(this).find('option:selected').text() : '';
                $('#ward').prop('disabled', true).html('<option value="">Chọn phường/xã</option>');
                selectedWard = '';
                updateFullAddress();

                if (districtCode) {
                    $.ajax({
                        url: '/dao/ajax/address_ajax.php',
                        type: 'GET',
                        data: {
                            get_wards_by_district_code: true,
                            district_code: districtCode
                        },
                        dataType: 'json',

                        success: function(response) {
                            if (response.status === 'success' && response.wards && response.wards.length > 0) {
                                const $select = $('#ward');
                                $select.empty();
                                $select.append('<option value="">Chọn phường/xã</option>');
                                $.each(response.wards, function(index, ward) {
                                    $select.append(`<option value="${ward.code}">${ward.name}</option>`);
                                });
                                $select.prop('disabled', false);
                            } else {
                                showToast(response.message || 'Không lấy được danh sách phường/xã', 'error');
                                $('#ward').html('<option value="">Không có dữ liệu</option>').prop('disabled', true);
                            }
                        },
                        error: function(xhr, status, error) {
                            showToast('Lỗi khi lấy phường/xã: ' + error, 'error');
                            $('#ward').html('<option value="">Lỗi tải dữ liệu</option>').prop('disabled', true);
                        }
                    });
                }
            });

            $('#ward').on('change', function() {
                selectedWard = $(this).val() ? $(this).find('option:selected').text() : '';
                updateFullAddress();
            });

            $('#street').on('input', function() {
                street = $(this).val().trim();
                updateFullAddress();
            });
        }
    });
</script>

<script>
    // checkout
    $(document).ready(function() {

        $('#checkoutForm').on('submit', function(e) {
            e.preventDefault();
            var paymentMethod = $('input[name="payment"]:checked').val();

            if (paymentMethod === 'cod') {
                var $btn = $('.btn-checkout-cod button');
                $btn.prop('disabled', true).text('Đang xử lý...');

                // Lấy dữ liệu từ input
                var formData = {
                    phone: $('#phone').val().trim(),
                    email: $('#email').val().trim(),
                    full_address: $('#full_address').val().trim(),
                    payment: paymentMethod,
                    checkout_cod: true
                };

                if (!formData.phone || !formData.email || !formData.full_address) {
                    $btn.prop('disabled', false).text('Đặt Hàng');
                    showToast('Vui lòng điền đầy đủ thông tin', 'error');
                    return;
                }

                $.ajax({
                    url: '/dao/ajax/checkout_ajax.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $btn.prop('disabled', true).text('Đang xử lý...');
                        if (response.status === 'success') {
                            showToast(response.message, 'success');
                            setTimeout(() => {
                                window.location.href = 'index.php?pg=orders';
                            }, 2000);
                        } else {
                            showToast(response.message, 'error');
                            $btn.prop('disabled', false).text('Đặt Hàng');
                        }
                    },
                    error: function(xhr, status, error) {
                        $btn.prop('disabled', false).text('Đặt Hàng');
                        showToast('Lỗi khi đặt hàng: ' + error, 'error');
                    }
                });
            }


            if (paymentMethod === 'vnpay') {
                var $btn = $('.btn-checkout-vnpay button');
                $btn.prop('disabled', true).text('Đang xử lý...');

                // Lấy dữ liệu từ input
                var formData = {
                    phone: $('#phone').val().trim(),
                    email: $('#email').val().trim(),
                    full_address: $('#full_address').val().trim(),
                    payment: paymentMethod,
                    checkout_cod: true
                };

                if (!formData.phone || !formData.email || !formData.full_address) {
                    $btn.prop('disabled', false).text('Thanh toán');
                    showToast('Vui lòng điền đầy đủ thông tin', 'error');
                    return;
                }

                $.ajax({
                    url: '/vnpay_php/vnpay_create_payment.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.url) {
                            showToast(response.message, 'success');
                            window.location.href = response.url;
                        } else {
                            console.log(">>> error: ", response.message);
                            showToast(response.message, 'error');
                            $btn.prop('disabled', false).text('Thanh toán');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(">>> error: ", error);
                        $btn.prop('disabled', false).text('Thanh toán');
                        showToast('Lỗi khi đặt hàng: ' + error, 'error');
                    }
                });
            }
        });
    });
</script>

<script>
    function showToast(message, type = 'success') {
        if ($('#toast-container .toast').length >= 1) {
            $('#toast-container .toast').first().remove();
        }

        let randomInt = Math.floor(Math.random() * 10000);
        let toastId = 'toast-' + new Date().getTime() + '-' + randomInt;

        let typeClass = 'text-success';
        let title = 'Thông báo';

        switch (type) {
            case 'error':
                typeClass = 'text-danger';
                title = 'Lỗi';
                break;
            case 'warning':
                typeClass = 'text-warning';
                title = 'Cảnh báo';
                break;
            case 'success':
            default:
                typeClass = 'text-success';
                title = 'Thông báo';
                break;
        }

        let toastHtml = `
        <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="750">
            <div class="toast-header">
                <strong class="mr-auto ${typeClass}">${title}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

        $('#toast-container').append(toastHtml);
        $('#' + toastId).toast('show');

        $('#' + toastId).on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
</script>


</body>

</html>