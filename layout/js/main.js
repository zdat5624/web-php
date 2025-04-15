(function ($) {
    "use strict";

    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });

    function togglePaymentButtons() {
        // Ẩn cả hai nút trước
        $('.btn-checkout-cod').hide();
        $('.btn-checkout-vnpay').hide();

        // Hiển thị nút tương ứng
        if ($('#cod').is(':checked')) {
            $('.btn-checkout-cod').show();
        } else if ($('#vnpay').is(':checked')) {
            $('.btn-checkout-vnpay').show();
        }
    }

    // Gọi khi trang tải
    $(document).ready(function () {
        togglePaymentButtons();

        // Lắng nghe sự kiện change
        $('input[name="payment"]').on('change', function () {
            togglePaymentButtons();
        });
    });

    // Xử lý mọi trường hợp hiển thị trang
    $(window).on('pageshow', function () {
        togglePaymentButtons();
    });

    // Fallback cho middle-click hoặc các trường hợp khác
    $(window).on('load', function () {
        setTimeout(togglePaymentButtons, 0);
    });

})(jQuery);

