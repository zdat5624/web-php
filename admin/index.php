<?php
// nhúng kết nối csdl
include "../dao/pdo.php";
// include "dao/danhmuc.php";
// include "dao/sanpham.php";

include "view/header.php";
//data dành cho trang chủ
// $dssp_new=get_dssp_new(4);
// $dssp_best=get_dssp_best(2);
// $dssp_view=get_dssp_view(4);


if (!isset($_GET['pg'])) {

    include "view/home.php";
} else {
    switch ($_GET['pg']) {

        /* Controller user */
        case 'users':

            include "view/user/users.php";
            break;

        /* Controller category */
        case 'categories':

            include "view/category/categories.php";
            break;

        /* Controller brand */
        case 'brands':

            include "view/brand/brands.php";
            break;

        /* Controller product */
        case 'products':

            include "view/product/products.php";
            break;

        default:
            include "view/home.php";
            break;
    }
}


include "view/footer.php";
