-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 11:43 AM
-- Server version: 8.0.37
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laptopshop123`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `order_number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `order_number`) VALUES
(1, 'Apple', 1),
(2, 'Dell', 2),
(3, 'HP', 3),
(4, 'Lenovo', 4),
(5, 'ASUS', 5),
(6, 'Acer', 6),
(7, 'Surface3', 7),
(8, 'Xiaomi9', 8),
(9, 'ABC', 9),
(10, '123451199', 10);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `total_price` bigint NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` int NOT NULL,
  `price` bigint NOT NULL,
  `quantity` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `order_number` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `order_number`) VALUES
(1, 'Doanh nhân', 1),
(2, 'Gaming - Đồ họa', 2),
(3, 'Mỏng nhẹ', 3),
(4, 'Sinh viên - Văn phòng', 4),
(5, 'AI', 6),
(6, 'ABC1', 71),
(8, 'XYZ', 72);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `total_price` bigint NOT NULL,
  `content` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `type_payment` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `price` bigint NOT NULL,
  `quantity` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `price` bigint DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `detail_desc` text COLLATE utf8mb3_vietnamese_ci,
  `short_desc` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `view` int DEFAULT NULL,
  `sold` int DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `detail_desc`, `short_desc`, `view`, `sold`, `brand_id`, `category_id`) VALUES
(1, 'Laptop Dell XPS 14 9440', 76990000, 'dell_xps_14_9440_graphite_1_ed2132563b.png', 'Mang trong mình DNA của dòng laptop flagship, Dell XPS 14 9440 U7 155H là tuyên ngôn phong cách của giới doanh nhân thành đạt. Với thiết kế tinh xảo tối giản, màn hình 3K sắc nét, bộ vi xử lý Intel Core Ultra 7 155H kết hợp cùng RTX 4050, đây chính là sản phẩm tối ưu cho những ai kiếm tìm một thiết bị làm việc vừa sang trọng, vừa mạnh mẽ.\nToát lên đẳng cấp qua phong cách tối giản\nNgay từ cái nhìn đầu tiên, Dell XPS 14 9440 U7 155H 71054773 đã tạo ấn tượng mạnh mẽ với thiết kế tối giản, thanh thoát, đậm chất doanh nhân. Sự liền mạch trong ngôn ngữ thiết kế, từ khung vỏ nhôm nguyên khối được cắt CNC, cho đến viền màn hình siêu mỏng, tất cả đều thể hiện sự đầu tư tỉ mỉ của Dell vào từng chi tiết.\n\nCảm giác cao cấp và chắc chắn là điều bạn có thể nhận thấy ngay khi cầm thiết bị trên tay. Bản lề vững vàng, mặt kính cường lực Gorilla Glass 3 bảo vệ màn hình khỏi va đập mang lại sự bền bỉ và sang trọng. Ngoài tính thẩm mỹ, XPS 14 9440 còn siêu nhẹ và cơ động, giúp bạn dễ dàng mang theo mọi lúc mọi nơi mà không cảm thấy nặng nề.\n\nBàn phím tối tân, hàng phím chức năng cảm ứng\nYếu tố tạo nên sự khác biệt lớn trong thiết kế của XPS 14 9440 nằm ở hệ thống bàn phím tràn viền với hành trình phím được tối ưu nhằm mang lại cảm giác gõ êm ái và chính xác. Tiết diện mặt phím lớn giúp hạn chế gõ nhầm phím ngay cả khi soạn thảo văn bản tốc độ cao.\n\nIntel Core Ultra 7 155H với nguồn sức mạnh ấn tượng\nẨn trong ngoại hình tinh tế là hiệu năng vượt ngoài mong đợi với chip Intel Core Ultra 7 155H 16 nhân, 22 luồng, tốc độ tối đa 4.8GHz. Nhờ công nghệ AI Engine, vi xử lý này có thể học hỏi và tối ưu hiệu suất dựa trên thói quen sử dụng của bạn, giúp tăng tốc xử lý tác vụ nặng, từ chỉnh sửa video, thiết kế đồ họa đến lập trình.\n\nRTX 4050: Lựa chọn lý tưởng cho gaming và sáng tạo\nNgoài sự mạnh mẽ của CPU, Dell XPS 14 9440 U7 155H 71054773 còn ghi điểm mạnh khi sở hữu card đồ họa GeForce RTX 4050 6GB VRAM mang lại hiệu năng đẳng cấp studio. RTX 4050 được trang bị Real-time Ray Tracing, giúp mô phỏng ánh sáng chân thực, mang lại trải nghiệm đồ họa tuyệt vời cho trải nghiệm game và sáng tạo nội dung chuyên nghiệp. Công nghệ DLSS 3.0 hỗ trợ bởi AI giúp nâng cao tốc độ khung hình mà vẫn duy trì chất lượng hình ảnh sắc nét.', 'Ultra7 155H /64GB/1TB/14.5\" 3.2K OLED Touch/Nvidia GeForce RTX4050 6GB/Win11/Office HS24/OS365', 0, 0, 2, 3),
(2, 'Laptop Dell XPS 13 9340 Ultra5', 50990000, 'dell_xps_13_9340_graphite_1_9e61a3a4e2.png', 'Mỏng nhẹ, đẳng cấp và mạnh mẽ, Dell XPS 13 9340 là mẫu laptop flagship đột phá trong phân khúc multimedia và ultrabook. Với hiệu suất tối ưu từ Intel Core Ultra 5-125H, màn hình QHD+ cảm ứng và card đồ họa Intel Arc thế hệ mới, sản phẩm hứa hẹn cung cấp sự trợ giúp chuyên nghiệp tối đa.\r\n\r\nThiết kế độc bản, tối giản mà đầy lôi cuốn\r\nSo với các phiên bản tiền nhiệm, Dell XPS 13 9340 cho thấy sự kế thừa trong ngôn ngữ thiết kế khi đề cao tính tối giản đặc trưng của dòng XPS. Phần bàn phím và mặt cảm ứng được gia công phẳng hoàn toàn, tạo cảm giác liền mạch, hiện đại và thêm phần sang trọng. Chạm vào bất cứ điểm nào trên chiếc ultrabook, bạn lập tức cảm nhận được đẳng cấp mà ít mẫu laptop nào sánh bằng.\r\n\r\nMàn hình QHD+ đáp ứng chuẩn màu khắt khe\r\nDell XPS 13 9340 sở hữu màn hình OLED cảm ứng 13.4 inch với độ phân giải QHD+ (2560 x 1600 pixels), cung cấp chất lượng hiển thị sắc nét với các gam màu sâu và độ tương phản cao. Các công nghệ như Anti-Reflect cùng EyeSafe từ Dell cũng hỗ trợ rất tốt cho những người làm việc văn phòng, phải sử dụng laptop nhiều giờ mỗi ngày, giúp bảo vệ mắt hiệu quả hơn.\r\n\r\nTrang bị phím cảm ứng và touchpad đột phá\r\nKhác với các dòng laptop truyền thống, Dell XPS 13 9340 đã loại bỏ hàng phím chức năng F và thay thế bằng dãy phím cảm ứng, tạo nên thiết kế hiện đại, liền mạch và tối giản. Các phím bấm bên dưới có kích thước lớn, độ nảy tốt, giúp soạn thảo văn bản nhanh chóng và thoải mái.', '125H/AI/16GB/1TB/13.4\" QHD+/Win11/Office HS24/OS365', 0, 0, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb3_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `address`, `phone`, `role`) VALUES
(1, 'admin@gmail.com', '123456', 'ADMIN', 'TP Hồ Chí Minh', '0867532555', 'ADMIN'),
(2, 'user@gmail.com', '123456', 'USER', 'TP Hồ Chí Minh', '0867532555', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
