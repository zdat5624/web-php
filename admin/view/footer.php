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

            <!-- Page level custom scripts -->
            <script src="layout/js/demo/chart-area-demo.js"></script>
            <script src="layout/js/demo/chart-pie-demo.js"></script>

            <!-- AJAX update order -->
            <script>
                $(document).ready(function() {
                    $('.update-order-btn').on('click', function() {
                        var orderId = $(this).data('id');
                        var orderStatus = $(this).data('status');
                        var orderNote = $(this).data('note');

                        $('#orderId').val(orderId);
                        $('#orderStatus').val(orderStatus);
                        $('#orderNote').val(orderNote);
                    });

                    $('#saveOrderBtn').on('click', function() {
                        var formData = $('#updateOrderForm').serialize();

                        $.ajax({
                            url: 'update_order.php',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    alert('Cập nhật đơn hàng thành công!');
                                    location.reload();
                                } else {
                                    alert('Lỗi: ' + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Đã xảy ra lỗi khi gửi yêu cầu. Vui lòng thử lại.');
                                console.log(xhr.responseText);
                            }
                        });
                    });
                });
            </script>

            </body>

            </html>