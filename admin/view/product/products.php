<style>
    .table-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .table thead {
        /* background-color: #4e73df; */
        color: rgb(60, 102, 215);
    }

    .table tbody tr:hover {
        background-color: #f8f9fc;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #375ac1;
        border-color: #375ac1;
    }
</style>

<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="color: rgb(60, 102, 215);">Quản lý sản phẩm</h3>
        <button class="btn btn-success"><i class="fas fa-plus"></i> Thêm</button>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Sản phẩm A</td>
                    <td>100,000 VND</td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Xem</button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sản phẩm B</td>
                    <td>200,000 VND</td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Xem</button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>