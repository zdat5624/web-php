<?php
// nhúng kết nối csdl
require_once "dao/pdo.php";
require_once "dao/product.php";
require_once "dao/category.php";

$categories = getAllCategories();
include "view/header.php";

if (!isset($_GET['pg'])) {
    $newProducts = getNewProducts();
    $bestSellingProducts = getBestSellingProducts();
    include "view/home.php";
} else {
    switch ($_GET['pg']) {
        case 'products':


            include "view/products.php";
            break;

        case 'productdetail':

            include "view/productdetail.php";
            break;

        case 'contact':
            include "view/contact.php";
            break;

        case 'cart':
            include "view/cart.php";
            break;

        case 'checkout':
            include "view/checkout.php";
            break;

        default:
            include "view/home.php";
            break;
    }
}


include "view/footer.php";
