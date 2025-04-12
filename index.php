<?php
ob_start();
session_start();
// nhúng kết nối csdl
require_once "dao/pdo.php";
require_once "dao/product.php";
require_once "dao/category.php";
require_once "dao/brand.php";
require_once "dao/cart.php";
require_once "dao/global.php";

$categories = getAllCategories();
include "view/header.php";

if (!isset($_GET['pg'])) {
    $newProducts = getNewProducts();
    $bestSellingProducts = getBestSellingProducts();
    $brands = getAllBrands();
    include "view/home.php";
} else {
    switch ($_GET['pg']) {


        case 'logout':
            session_unset(); // Xóa tất cả biến session
            session_destroy(); // Hủy session
            header("Location: index.php");
            exit();
            break;

        case 'products':



            // fitler
            $brand_id = isset($_GET['brand']) ? $_GET['brand'] : null;
            $category_id = isset($_GET['category']) ? $_GET['category'] : null;
            $price_range = isset($_GET['price']) ? $_GET['price'] : null;

            $min_price = null;
            $max_price = null;
            // check '' or null
            if ($price_range) {
                $prices = explode('-', $price_range);
                $min_price = (int)$prices[0];
                $max_price = (int)$prices[1];
            }

            // sort
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'new';
            switch ($sort) {
                case 'new':
                    $sort_label = 'Mới nhất';
                    break;
                case 'sold':
                    $sort_label = 'Bán chạy nhất';
                    break;
                case 'view':
                    $sort_label = 'Xem nhiều nhất';
                    break;
                case 'pricedesc':
                    $sort_label = 'Giá cao nhất';
                    break;
                case 'priceasc':
                    $sort_label = 'Giá thấp nhất';
                    break;
                default:
                    $sort_label = 'Mới nhất';
                    break;
            }

            // search
            $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';


            //paging
            $pageSize = 9;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $total_products = getTotalProductsWithFiltersForUser($brand_id, $category_id, $min_price, $max_price, $keyword);
            $total_pages = ceil($total_products / $pageSize);

            $offset = ($current_page - 1) * $pageSize;
            $products = getProductsWithFiltersForUser($pageSize, $offset, $brand_id, $category_id, $min_price, $max_price, $sort, $keyword);


            $brands = getAllBrands();
            $categories = getAllCategories();
            include "view/products.php";
            break;

        case 'productdetail':

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $product = getProductById($id);

            include "view/productdetail.php";
            break;

        case 'contact':
            include "view/contact.php";
            break;

        case 'cart':
            if (!isset($_SESSION['user'])) {
                header("Location: index.php");
                exit();
            }
            $user_id = $_SESSION['user']['id'];
            $cart = getCartByUserId($user_id);
            if (!$cart) {
                $cart = createCart($user_id);
            }
            $cart_details = getCartDetails($cart['id']);
            include "view/cart.php";
            break;

        case 'checkout':
            include "view/checkout.php";
            break;

        default:
            $newProducts = getNewProducts();
            $bestSellingProducts = getBestSellingProducts();
            $brands = getAllBrands();
            include "view/home.php";
            break;
    }
}


include "view/footer.php";
