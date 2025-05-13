<?php
ob_start();
session_start();
require_once "../dao/pdo.php";
include "../dao/global.php";

include "../dao/product.php";
include "../dao/user.php";
include "../dao/category.php";
include "../dao/brand.php";
include "../dao/order.php";
include "../dao/slide.php";
include "view/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}


if ($_SESSION['user']['role'] !== 'ADMIN') {
    header("Location: ../index.php");
    exit();
}



if (!isset($_GET['pg'])) {

    $monthly_revenue = getMonthlyRevenue();
    $yearly_revenue = getYearlyRevenue();
    $total_users = getTotalUsers();
    $pending_orders = getPendingOrders();
    $revenue_by_month = getRevenueByMonth();
    $product_by_category = getProductByCategory();

    include "view/home.php";
} else {
    switch ($_GET['pg']) {

        case 'slides':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $pageSize;

            // Sắp xếp
            $sort = isset($_GET['sort'])  ? $_GET['sort'] : 'order_number';
            $order = isset($_GET['order'])  ? $_GET['order'] : 'DESC';

            // Phân trang
            $total_slides = getTotalSlides();
            $total_pages = ceil($total_slides / $pageSize);

            // Danh sách slides
            $slides = getSlidesWithSort($pageSize, $offset, $sort, $order);

            include "view/slide/slides.php";
            break;

        case 'addslide':
            if (isset($_POST['addslide'])) {
                $link = $_POST['link'];
                $order_number = $_POST['order_number'];

                // Upload ảnh
                $target_dir = IMG_PATH_ADMIN;
                $image_name = basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                $new_image_name = time() . "_" . rand(1000, 9999) . "_" . $image_name;
                $target_file = $target_dir . $new_image_name;
                $uploadOk = 1;

                if ($_FILES["image"]["size"] > 10000000) {
                    echo "<script>alert('Tệp quá lớn! Chỉ hỗ trợ file < 10MB.');</script>";
                    $uploadOk = 0;
                }
                $allowed_extensions = ["jpg", "jpeg", "png", "gif", "webp"];
                if (!in_array($imageFileType, $allowed_extensions)) {
                    echo "<script>alert('Chỉ cho phép file JPG, JPEG, PNG, GIF, WEBP!');</script>";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        addSlide($link, $order_number, $new_image_name);
                    } else {
                        echo "<script>alert('Lỗi khi tải lên ảnh!');</script>";
                    }
                }
            }
            $next_order_number_slide = getNextOrderNumberSlide();
            include "view/slide/addslide.php";
            break;

        case 'updateslide':
            if (isset($_GET['id'])) {
                $slide = getSlideById($_GET['id']);
                if (!$slide) {
                    echo "<script>alert('Slide không tồn tại!'); window.location='index.php?pg=slides';</script>";
                    exit();
                }
                include "view/slide/updateslide.php";
            }
            break;

        case 'handleupdateslide':
            if (isset($_POST['updateslide'])) {
                $id = $_POST['id'];
                $link = $_POST['link'];
                $order_number = $_POST['order_number'];
                $current_image = $_POST['current_image'];

                if ($_FILES['image']['name'] != '') {
                    $target_dir = IMG_PATH_ADMIN;
                    $image_name = basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    $new_image_name = time() . "_" . rand(1000, 9999) . "_" . $image_name;
                    $target_file = $target_dir . $new_image_name;
                    $uploadOk = 1;

                    if ($_FILES["image"]["size"] > 10000000) {
                        echo "<script>alert('Tệp quá lớn! Chỉ hỗ trợ file < 10MB.');</script>";
                        $uploadOk = 0;
                    }
                    $allowed_extensions = ["jpg", "jpeg", "png", "gif", "webp"];
                    if (!in_array($imageFileType, $allowed_extensions)) {
                        echo "<script>alert('Chỉ cho phép file JPG, JPEG, PNG, GIF, WEBP!');</script>";
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

                updateSlide($id, $link, $order_number, $image);
            }
            header("Location: index.php?pg=slides");
            exit();
            break;

        case 'deleteslide':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $slide = getSlideById($id);
                if ($slide) {
                    $image_path = IMG_PATH_ADMIN . $slide['image'];
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                    deleteSlideById($id);
                }
            }
            header("Location: index.php?pg=slides");
            exit();
            break;

        /* COntroller order*/
        case 'orders':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $pageSize;

            // Lọc
            $status = isset($_GET['status']) ? $_GET['status'] : null;
            $search = isset($_GET['search']) ? $_GET['search'] : null;

            // Sắp xếp
            $sort = isset($_GET['sort']) && is_string($_GET['sort']) ? $_GET['sort'] : 'id';
            $order = isset($_GET['order']) && is_string($_GET['order']) ? $_GET['order'] : 'DESC';
            // Phân trang
            $total_orders = getTotalOrdersWithFilters($status, $search);
            $total_pages = ceil($total_orders / $pageSize);

            // Danh sách đơn hàng
            $orders = getOrdersWithFilters($pageSize, $offset, $status, $search, $sort, $order);

            include "view/order/orders.php";
            break;

        case 'orderdetail':
            // Lấy order_id từ URL
            $order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;

            // Lấy thông tin đơn hàng
            try {
                $order = getOrderById($order_id);
                if (!$order) {
                    throw new Exception("Đơn hàng không tồn tại.");
                }

                $order_details = getOrderDetails($order_id);

                include "view/order/orderdetail.php";
            } catch (Exception $e) {
                header("Location: index.php?pg=orders");
                exit();
            }
            break;

        /* Controller user */
        case 'users':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $offset = ($current_page - 1) * $pageSize;

            // sort
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
            $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

            // paging
            $total_users = getTotalUsers();
            $total_pages = ceil($total_users / $pageSize);

            // product list
            $users = getUsersWithSort($pageSize, $offset, $sort, $order);

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
                if (isEmailExists($email, null)) {
                    header("Location: index.php?pg=users&pg=adduser&error=email");
                    exit();
                }
                addUser($email, $password, $name, $address, $phone, $role);
            }
            include "view/user/adduser.php";
            break;

        case 'deleteuser':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteUserById($id);
            }
            header("Location: index.php?pg=users");
            exit();
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
                if (isEmailExists($email, $id)) {
                    header("Location: index.php?pg=users&pg=updateuser&id=$id&error=email");
                    exit();
                }
                updateUser($id, $email, $password, $name, $address, $phone, $role);
            }
            header("Location: index.php?pg=users");
            exit();
            break;









        /* Controller category */
        case 'categories':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $offset = ($current_page - 1) * $pageSize;

            // sort
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'order_number';
            $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

            // paging
            $total_categories = getTotalCategories();
            $total_pages = ceil($total_categories / $pageSize);

            // product list
            $categories = getCategoriesWithSort($pageSize, $offset, $sort, $order);

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
            header("Location: index.php?pg=categories");
            exit();
            break;


        case 'deletecategory':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteCategoryById($id);
            }
            header("Location: index.php?pg=categories");
            exit();
            break;












        /* Controller brand */
        case 'brands':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $offset = ($current_page - 1) * $pageSize;

            // sort
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'order_number';
            $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

            // paging
            $total_brands = getTotalBrands();
            $total_pages = ceil($total_brands / $pageSize);

            // product list
            $brands = getBrandsWithSort($pageSize, $offset, $sort, $order);

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
            header("Location: index.php?pg=brands");
            exit();

            $brands = getAllBrands();
            include "view/brand/brands.php";
            break;


        case 'deletebrand':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                deleteBrandById($id);
            }
            header("Location: index.php?pg=brands");
            exit();
            break;










        /* Controller product */
        case 'products':
            $pageSize = 10;
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

            $offset = ($current_page - 1) * $pageSize;

            // fitler
            $brand_id = isset($_GET['brand']) ? $_GET['brand'] : null;
            $category_id = isset($_GET['category']) ? $_GET['category'] : null;

            // sort
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
            $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

            // data filter
            $categories = getAllCategories();
            $brands = getAllBrands();

            // paging
            $total_products = getTotalProductsWithFilters($brand_id, $category_id);
            $total_pages = ceil($total_products / $pageSize);

            // product list
            $products = getProductsWithFilters($pageSize, $offset, $brand_id, $category_id, $sort, $order);

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
                    $new_image_name = time() . "_" . rand(1000, 9999) . "_" . $image_name;
                    $target_file = $target_dir . $new_image_name;
                    $uploadOk = 1;

                    if ($_FILES["image"]["size"] > 10000000) {
                        echo "<script>alert('Tệp quá lớn! Chỉ hỗ trợ file < 10MB.');</script>";
                        $uploadOk = 0;
                    }
                    $allowed_extensions = ["jpg", "jpeg", "png", "gif", "webp"];
                    if (!in_array($imageFileType, $allowed_extensions)) {
                        echo "<script>alert('Chỉ cho phép file JPG, JPEG, PNG, WEBP, GIF!');</script>";
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

            header("Location: index.php?pg=products");
            exit();
            break;


















        default:
            $monthly_revenue = getMonthlyRevenue();
            $yearly_revenue = getYearlyRevenue();
            $total_users = getTotalUsers();
            $pending_orders = getPendingOrders();
            $revenue_by_month = getRevenueByMonth();
            $product_by_category = getProductByCategory();
            include "view/home.php";
            break;
    }
}


include "view/footer.php";
ob_end_flush();
