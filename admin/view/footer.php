            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; XLaptopshop</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Toast Notification -->
            <div id="toast-container" class="position-fixed" style="top: 20px; right: 20px; z-index: 9999;"></div>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bạn đã sẵn sàng đăng xuất chưa?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Chọn "Đăng xuất" bên dưới nếu bạn đã sẵn sàng kết thúc phiên làm việc hiện tại.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                            <a class="btn btn-primary" href="../index.php?pg=logout">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="layout/vendor/jquery/jquery.min.js"></script>
            <script src="layout/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="layout/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="layout/js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="layout/vendor/chart.js/Chart.min.js"></script>

            <?php
            if (isset($revenue_by_month) && isset($product_by_category)) {
                echo "<script>
                            var revenueData = " . json_encode($revenue_by_month) . ";
                            var productByCategory = " . json_encode($product_by_category) . ";
                        </script>";

                echo '
                        <script src="layout/js/demo/chart-area-demo.js"></script>
                        <script src="layout/js/demo/chart-pie-demo.js"></script>
                        ';
            }
            ?>

            <script>
                $('.update-order-btn').on('click', function() {
                    // Lấy dữ liệu từ thuộc tính data-*
                    var orderId = $(this).data('id');
                    var orderStatus = $(this).data('status');
                    var orderNote = $(this).data('note') || '';

                    $('#orderId').val(orderId);
                    $('#orderStatus').val(orderStatus);
                    $('#orderNote').val(orderNote);

                    // Hiển thị modal
                    $('#updateOrderModal').modal('show');
                });

                $(document).ready(function() {
                    $('#updateOrderForm').on('submit', function(e) {
                        e.preventDefault();
                        var orderStatus = $('#orderStatus').val();
                        var orderNote = $('#orderNote').val();
                        var order_id = $('#orderId').val();

                        $.ajax({
                            url: '/dao/ajax/update_order_ajax.php',
                            type: 'POST',
                            data: {
                                update_order: true,
                                order_id: order_id,
                                orderStatus: orderStatus,
                                orderNote: orderNote
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {

                                    $('#updateOrderModal').modal('hide');
                                    showToast(response.message, 'success')

                                    // Tìm hàng trong bảng tương ứng với order_id
                                    var row = $('table tbody tr').filter(function() {
                                        return $(this).find('td:first').text() == order_id;
                                    });

                                    // Cập nhật cột "Trạng thái"
                                    var statusCell = row.find('td:nth-child(6)');
                                    var badgeClass = '';
                                    var statusText = '';
                                    switch (orderStatus) {
                                        case 'pending':
                                            badgeClass = 'badge bg-warning text-dark';
                                            statusText = 'Chờ xác nhận';
                                            break;
                                        case 'preparing':
                                            badgeClass = 'badge bg-info';
                                            statusText = 'Đang chuẩn bị';
                                            break;
                                        case 'shipping':
                                            badgeClass = 'badge bg-primary';
                                            statusText = 'Đang giao';
                                            break;
                                        case 'completed':
                                            badgeClass = 'badge bg-success';
                                            statusText = 'Hoàn thành';
                                            break;
                                        case 'canceled':
                                            badgeClass = 'badge bg-danger';
                                            statusText = 'Đã hủy';
                                            break;
                                        default:
                                            badgeClass = 'badge bg-secondary';
                                            statusText = orderStatus;
                                    }
                                    statusCell.html('<span class="' + badgeClass + '" style="font-size: 0.9rem !important; padding: 0.35em 0.65em !important; color: #FFFFFF !important;">' + statusText + '</span>');

                                    // Cập nhật cột "Ghi chú"
                                    var noteCell = row.find('td:nth-child(8)'); // Cột "Ghi chú" (thứ 9 trong bảng)
                                    noteCell.text(orderNote || '');
                                    noteCell.attr('title', orderNote || '');

                                    // Cập nhật thuộc tính data-status và data-note của nút "Cập nhật"
                                    var updateButton = row.find('.update-order-btn');
                                    updateButton.data('status', orderStatus);
                                    updateButton.data('note', orderNote);
                                    updateButton.attr('data-status', orderStatus);
                                    updateButton.attr('data-note', orderNote);

                                } else {
                                    showToast(response.message, 'error');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(">>> error: ", error)
                                showToast(response.message, 'error');
                            }
                        });
                    });


                });
            </script>

            <script>
                $(document).ready(function() {
                    $('.toggle-visibility').on('change', function() {
                        var id = $(this).data('id');
                        var type = $(this).data('type');
                        var isVisible = $(this).is(':checked') ? 1 : 0;

                        var checkbox = $(this);

                        $.ajax({
                            url: '/dao/ajax/update_visible_ajax.php',
                            type: 'POST',
                            data: {
                                table_update: type,
                                id: id,
                                is_visible: isVisible
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status !== 'success') {
                                    showToast(response.message, type = 'error')
                                    checkbox.prop('checked', !isVisible);
                                }
                                showToast(response.message, type = 'success')
                            },
                            error: function(xhr, status, error) {
                                showToast(response.message, type = 'error')
                                checkbox.prop('checked', !isVisible);
                            }
                        });
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