<?php
require_once "../dao/pdo.php";
include "../dao/global.php";

include "../dao/product.php";
include "../dao/user.php";
include "../dao/category.php";
include "../dao/brand.php";

include "view/header.php";

//index.php?pg=products

if (!isset($_GET['pg'])) {

    include "view/home.php";
} else {
    switch ($_GET['pg']) {

        /* Controller user */
        case 'users':
            $users = getAllUsers();
            include "view/user/users.php";
            break;

        case 'adduser':
            if (isset($_POST['adduser'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $name = $_POST['name'];
                $address = $_POST['address'] ?? '';
                $phone = $_POST['phone'] ?? '';
                $role = $_POST['role'];

                addUser($email, $password, $name, $address, $phone, $role);
            }
            include "view/user/adduser.php";
            break;

        case 'deleteuser':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteUserById($id);
            }
            $users = getAllUsers();
            include "view/user/users.php";
            break;

        case 'updateuser':
            if (isset($_GET['id'])) {
                $user = getUserById($_GET['id']);
                include "view/user/updateuser.php";
            }
            break;

        case 'handleupdateuser':
            if (isset($_POST['updateuser'])) {
                $id = $_POST['id'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $role = $_POST['role'];

                updateUser($id, $email, $password, $name, $address, $phone, $role);
            }
            $users = getAllUsers();
            include "view/user/users.php";
            break;









        /* Controller category */
        case 'categories':
            $categories = getAllCategories();
            include "view/category/categories.php";
            break;

        case 'addcategory':
            if (isset($_POST['addcategory'])) {
                $name = $_POST['name'];
                $order_number = $_POST['order_number'];

                addCategory($name, $order_number);
            }
            $next_order_number = getNextOrderNumber();
            include "view/category/addcategory.php";
            break;

        case 'updatecategory':
            if (isset($_GET['id'])) {
                $category = getCategoryById($_GET['id']);
                include "view/category/updatecategory.php";
            }
            break;

        case 'handleupdatecategory':
            if (isset($_POST['updatecategory'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $order_number = $_POST['order_number'];

                updateCategory($id, $name, $order_number);
            }
            $categories = getAllCategories();
            include "view/category/categories.php";
            break;


        case 'deletecategory':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteCategoryById($id);
            }
            $categories = getAllCategories();
            include "view/category/categories.php";
            break;












        /* Controller brand */
        case 'brands':
            $brands = getAllBrands();
            include "view/brand/brands.php";
            break;


        case 'addbrand':
            if (isset($_POST['addbrand'])) {
                $name = $_POST['name'];
                $order_number = $_POST['order_number'];
                addBrand($name, $order_number);
            }
            $next_order_number_brand = getNextOrderNumberBrand();
            include "view/brand/addbrand.php";
            break;

        case 'updatebrand':
            if (isset($_GET['id'])) {
                $brand = getBrandById($_GET['id']);
                include "view/brand/updatebrand.php";
            }
            break;

        case 'handleupdatebrand':
            if (isset($_POST['updatebrand'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $order_number = $_POST['order_number'];

                updateBrand($id, $name, $order_number);
            }


            $brands = getAllBrands();
            include "view/brand/brands.php";
            break;


        case 'deletebrand':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteBrandById($id);
            }
            $brands = getAllBrands();
            include "view/brand/brands.php";
            break;










        /* Controller product */
        case 'products':
            $products = getAllProducts();
            include "view/product/products.php";
            break;

        case 'addproduct':

            if (isset($_POST['addproduct'])) {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $short_desc = $_POST['short_desc'];
                $detail_desc = $_POST['detail_desc'];
                $view = $_POST['view'] ?? 0;
                $sold = $_POST['sold'] ?? 0;
                $brand_id = $_POST['brand_id'];
                $category_id = $_POST['category_id'];

                // upload ảnh
                $target_dir = IMG_PATH_ADMIN;
                $image_name = basename($_FILES["image"]["name"]); // tên file gốc mà user upload
                $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $new_image_name = time() . "_" . rand(1000, 9999) . "_" . $image_name . "." . $imageFileType;
                $target_file = $target_dir . $new_image_name;
                $uploadOk = 1;




                if ($_FILES["image"]["size"] > 10000000) {
                    echo "<script>alert('Tệp quá lớn! Chỉ hỗ trợ file < 10MB.');</script>";
                    $uploadOk = 0;
                }
                $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
                if (!in_array($imageFileType, $allowed_extensions)) {
                    echo "<script>alert('Chỉ cho phép file JPG, JPEG, PNG, GIF!');</script>";
                    $uploadOk = 0;
                }

                // Nếu ảnh hợp lệ, tiến hành upload
                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        addProduct($name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $new_image_name);
                    }
                }
            }

            $categories = getAllCategories();
            $products = getAllProducts();
            $brands = getAllBrands();
            include "view/product/addproduct.php";
            break;

        case 'deleteproduct':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = getProductById($id);
                if ($product) {
                    $image_path = IMG_PATH_ADMIN . $product['image'];
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                    deleteProductById($id);
                }
            }
            $products = getAllProducts();
            include "view/product/products.php";
            break;

        case 'updateproduct':

            if (isset($_GET['id'])) {
                $product = getProductById($_GET['id']);
            }
            $categories = getAllCategories();
            $brands = getAllBrands();
            include "view/product/updateproduct.php";
            break;

        case 'handleupdateproduct':
            if (isset($_POST['updateproduct'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $short_desc = $_POST['short_desc'];
                $detail_desc = $_POST['detail_desc'];
                $view = $_POST['view'] ?? 0;
                $sold = $_POST['sold'] ?? 0;
                $brand_id = $_POST['brand_id'];
                $category_id = $_POST['category_id'];
                $current_image = $_POST['current_image'];

                if ($_FILES['image']['name'] != '') {
                    $target_dir = IMG_PATH_ADMIN;
                    $image_name = basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    $new_image_name = time() . "_" . rand(1000, 9999) . "_" . $image_name . "." . $imageFileType;
                    $target_file = $target_dir . $new_image_name;
                    $uploadOk = 1;

                    if ($_FILES["image"]["size"] > 10000000) {
                        echo "<script>alert('Tệp quá lớn! Chỉ hỗ trợ file < 10MB.');</script>";
                        $uploadOk = 0;
                    }
                    $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
                    if (!in_array($imageFileType, $allowed_extensions)) {
                        echo "<script>alert('Chỉ cho phép file JPG, JPEG, PNG, GIF!');</script>";
                        $uploadOk = 0;
                    }

                    if ($uploadOk == 1) {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                            if (file_exists($target_dir . $current_image)) {
                                unlink($target_dir . $current_image);
                            }
                            $image = $new_image_name;
                        } else {
                            echo "<script>alert('Lỗi khi tải lên ảnh!');</script>";
                            $image = $current_image;
                        }
                    } else {
                        $image = $current_image;
                    }
                } else {
                    $image = $current_image;
                }

                updateProduct($id, $name, $price, $short_desc, $detail_desc, $view, $sold, $brand_id, $category_id, $image);
            }
            $products = getAllProducts();
            include "view/product/products.php";
            break;


















        default:
            include "view/home.php";
            break;
    }
}


include "view/footer.php";
