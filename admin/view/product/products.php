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

        <a href="index.php?pg=addproduct" class="btn btn-success">
            <i class="fas fa-plus"></i> Thêm
        </a>

    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>Mô tả chi tiết</th>
                    <th>Mô tả ngắn</th>
                    <th>Lượt xem</th>
                    <th>Lượt bán</th>
                    <th>Thương hiệu</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td>
                            <img src="<?= IMG_PATH_ADMIN . $product['image'] ?>"
                                alt="<?= $product['name'] ?>"
                                width="60" height="60"
                                style="object-fit: cover; border-radius: 5px;">
                        </td>
                        <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                        <td><?= mb_strimwidth($product['detail_desc'], 0, 40, "...") ?></td>
                        <td><?= mb_strimwidth($product['short_desc'], 0, 20, "...") ?></td>
                        <td><?= $product['view'] ?></td>
                        <td><?= $product['sold'] ?></td>
                        <td><?= $product['brand_name'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                        <td>
                            <a href="index.php?pg=updateproduct&id=<?= $product['id'] ?>">
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Sửa</button>
                            </a>
                            <a href="index.php?pg=deleteproduct&id=<?= $product['id'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Xóa</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>