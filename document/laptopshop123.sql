-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 12:15 PM
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
  `cart_id` int NOT NULL,
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
(6, 'ABC1', 71);

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
(2, 'Laptop Dell XPS 13 9340 Ultra5', 50990000, 'dell_xps_13_9340_graphite_1_9e61a3a4e2.png', 'Mỏng nhẹ, đẳng cấp và mạnh mẽ, Dell XPS 13 9340 là mẫu laptop flagship đột phá trong phân khúc multimedia và ultrabook. Với hiệu suất tối ưu từ Intel Core Ultra 5-125H, màn hình QHD+ cảm ứng và card đồ họa Intel Arc thế hệ mới, sản phẩm hứa hẹn cung cấp sự trợ giúp chuyên nghiệp tối đa.\r\n\r\nThiết kế độc bản, tối giản mà đầy lôi cuốn\r\nSo với các phiên bản tiền nhiệm, Dell XPS 13 9340 cho thấy sự kế thừa trong ngôn ngữ thiết kế khi đề cao tính tối giản đặc trưng của dòng XPS. Phần bàn phím và mặt cảm ứng được gia công phẳng hoàn toàn, tạo cảm giác liền mạch, hiện đại và thêm phần sang trọng. Chạm vào bất cứ điểm nào trên chiếc ultrabook, bạn lập tức cảm nhận được đẳng cấp mà ít mẫu laptop nào sánh bằng.\r\n\r\nMàn hình QHD+ đáp ứng chuẩn màu khắt khe\r\nDell XPS 13 9340 sở hữu màn hình OLED cảm ứng 13.4 inch với độ phân giải QHD+ (2560 x 1600 pixels), cung cấp chất lượng hiển thị sắc nét với các gam màu sâu và độ tương phản cao. Các công nghệ như Anti-Reflect cùng EyeSafe từ Dell cũng hỗ trợ rất tốt cho những người làm việc văn phòng, phải sử dụng laptop nhiều giờ mỗi ngày, giúp bảo vệ mắt hiệu quả hơn.\r\n\r\nTrang bị phím cảm ứng và touchpad đột phá\r\nKhác với các dòng laptop truyền thống, Dell XPS 13 9340 đã loại bỏ hàng phím chức năng F và thay thế bằng dãy phím cảm ứng, tạo nên thiết kế hiện đại, liền mạch và tối giản. Các phím bấm bên dưới có kích thước lớn, độ nảy tốt, giúp soạn thảo văn bản nhanh chóng và thoải mái.', '125H/AI/16GB/1TB/13.4\" QHD+/Win11/Office HS24/OS365', 0, 0, 2, 3),
(10, 'MacBook Air 15 inch M2 2023', 27490000, '1743089173_1085_inch-xanh-2.jpg.jpg', 'MacBook Air M2 2023 giờ đây sẽ mở ra trải nghiệm hình ảnh rộng lớn hơn khi gia tăng kích cỡ màn hình Liquid Retina lên ngưỡng 15 inch ấn tượng. Độ tương thích tuyệt đối giữa chip M2 và nền tảng macOS đem lại trải nghiệm mượt mà và chuyên nghiệp nhất, giúp phản hồi cực nhanh mọi tác vụ của bạn.\r\nBền bỉ, tinh xảo với độ hoàn thiện ấn tượng\r\nPhát huy truyền thống mỏng nhẹ vốn có của dòng MacBook Air, phiên bản MacBook Air M2 2023 dù mở rộng màn hình lên mức 15 inch nhưng vẫn đảm bảo độ tinh xảo và cao cấp. Từng chi tiết, từng góc cạnh trên thiết bị đều được trau chuốt tỉ mỉ và chế tác từ chất liệu nhôm tái chế bền bỉ mà thân thiện với môi trường. Đặc biệt, sản phẩm có cấu trúc hoạt động không quạt gió, duy trì độ êm ái khi vận hành ngay cả khi chạy tác vụ nặng với khối lượng lớn.\r\nBốn lựa chọn màu sắc cao cấp và sang trọng\r\nMacBook Air M2 15 inch đem đến cho bạn bốn lựa chọn về màu sắc sang trọng, bao gồm: Đen, Vàng, Xám và Bạc. Tất cả các tùy chọn này đều được tinh chỉnh nhằm phát huy tối đa vẻ cao cấp và lịch thiệp mà sản phẩm hướng tới, cực kỳ phù hợp với giới văn phòng, doanh nhân. Với mỗi màu sắc, Apple lại trang bị sẵn một bộ cáp sạc MagSafe cùng tone màu trong hộp đựng sản phẩm.', 'Apple M28CPU 10GPU 8GB/256GB', 0, 0, 1, 2),
(11, 'MacBook Air 13 inch M1 2020', 16990000, '1743089294_2953_2020-gray-4.jpg.jpg', 'Chiếc MacBook Air có hiệu năng đột phá nhất từ trước đến nay đã xuất hiện. Bộ vi xử lý Apple M1 hoàn toàn mới đưa sức mạnh của MacBook Air M1 13 inch 2020 vượt xa khỏi mong đợi người dùng, có thể chạy được những tác vụ nặng và thời lượng pin đáng kinh ngạc.\r\n\r\nLần đầu tiên Apple sử dụng con chip do chính mình sản xuất cho dòng máy Macbook. Bộ vi xử lý Apple M1 với 16 tỉ bóng bán dẫn, bao gồm 8 nhân cực mạnh, trong đó có 4 nhân hiệu năng cao và 4 nhân tiết kiệm điện, mang đến cho MacBook Air M1 tốc độ xử lý tuyệt vời, đồng thời kéo dài thời lượng pin. Nhờ vậy MacBook Air M1 2020 có hiệu suất nhanh gấp 3,5 lần thế hệ cũ, cho bạn làm việc với cả những công việc chuyên nghiệp, những tác vụ nặng mà không thể chạy được trên MacBook Air trước đây.\r\nKhả năng xử lý đồ họa đỉnh cao\r\nMacBook Air M1 13 inch 2020 có khả năng đồ họa khó tin trên một chiếc laptop siêu nhỏ gọn. GPU tích hợp trên Apple M1 có tới 8 nhân và là GPU tích hợp mạnh nhất thế giới laptop hiện nay. So với thế hệ trước, MacBook Air M1 2020 có khả năng xử lý đồ họa mạnh gấp 5 lần. Giờ đây ngay trên chiếc MacBook Air cực kỳ di động, bạn đã có thể xem và chỉnh sửa video 4K mượt mà, thậm chí là chơi game cũng như chạy các tác vụ đồ họa chuyên sâu.', 'Apple M1 8CPU 7GPU 8GB/256GB', 0, 0, 1, 4),
(12, 'Laptop Asus TUF Gaming A15 FA506NCR-HN047W', 19490000, '1743089414_1018_2021_asus_tuf_gaming.png.png', 'Sở hữu sức mạnh phần cứng ấn tượng và thiết kế chuẩn gaming, Asus TUF FA506NCR-HN047W mang lại trải nghiệm chơi game mượt mà, tốc độ cùng năng lực đa nhiệm ấn tượng. Sản phẩm được tích hợp chip AMD Ryzen 7 7435HS mạnh mẽ, card đồ họa RTX 3050 và màn hình 144Hz.\r\nAMD Ryzen 7 7435HS với sức mạnh ấn tượng\r\nQuyết định sức mạnh hiệu năng của Asus TUF FA506NCR-HN047W là chip AMD Ryzen 7 7435HS với 8 nhân, 16 luồng, tốc độ tối đa lên đến 4.55GHz. Bộ vi xử lý cung cấp hiệu năng mạnh mẽ cho các tựa game AAA, đồng thời đảm bảo khả năng đa nhiệm xuất sắc, giúp bạn dễ dàng chuyển đổi giữa các phần mềm mà không gặp tình trạng giật lag.\r\nChinh phục mọi tựa game với RTX 3050\r\nVề hiệu suất đồ họa, Asus TUF FA506NCR-HN047W sở hữu card đồ họa NVIDIA GeForce RTX 3050 4GB – dòng GPU tầm trung cung cấp trải nghiệm gaming chân thực với công nghệ Ray Tracing thời gian thực. Bạn sẽ được tận hưởng các hiệu ứng ánh sáng, đổ bóng, phản chiếu sắc nét, giúp thế giới game sống động không kém gì những bộ phim bom tấn.', '7435HS/16GB/512GB/15.6\" 144Hz/Nvidia GeForce RTX3050 4GB/Win 11', 0, 0, 5, 2),
(13, 'Laptop Asus Gaming Vivobook K3605ZF-RP634W', 16990000, '1743089566_4891_00910139_asus_gaming_vivobook.png.png', 'Giải pháp tuyệt vời để giải trí, sáng tạo và học tập dành cho các bạn học sinh/sinh viên, chiếc laptop gaming Asus Vivobook K3605ZF-RP634W ghi điểm nhờ mức giá rất tốt, khả năng đa nhiệm bền bỉ và được trang bị card đồ họa RTX2050 hết sức xịn sò. Chip xử lý Intel Core i5-12500H sẽ cung cấp sức mạnh tuyệt vời cho mọi tác vụ bạn dùng.\r\nKhai mở hiệu năng gaming ấn tượng\r\nTrọng tâm trong sức mạnh đồ họa của laptop Vivobook K3605ZF-RP634W nằm ở bộ GPU GeForce RTX 2050 xây dựng trên kiến trúc Ampere GA107 của NVIDIA với nhiều cải tiến ở công nghệ dò tia và cung cấp hiệu năng chiến game cực tốt. Nhờ vậy, người dùng sẽ thoải mái chơi các tựa game cực hot hiện nay như Dota 2 Reborn, GTA V hay The Witcher 3 với mức FPS cực kỳ ấn tượng.\r\nChip mạnh mẽ và cấu hình tuyệt vời\r\nDù có mức giá lên kệ dễ tiếp cận hơn nhiều so với mặt bằng chung của dòng laptop gaming nhưng Vivobook K3605ZF-RP634W vẫn sở hữu thông số cấu hình hết sức ấn tượng với chip Intel Core i5-12500H – bộ vi xử lý có xung nhịp 2.5GHz đi kèm công nghệ Turbo Boost tối ưu hiệu năng cực tốt.', 'i5-12500H/16GB/512GB/16\"/Nvidia GeForce RTX2050 4GB/Win11', 0, 0, 5, 2),
(14, 'Laptop Acer Aspire 3 A315-44P-R5QG', 12990000, '1743090034_3888_50618_laptop_acer_aspire_3_a315_44p_r5qg_nx_ksjsv_001__1_.jpg.jpg', 'Laptop Acer Aspire 3 A315-44P-R5QG NX.KSJSV.001 là sự kết hợp hoàn hảo giữa hiệu năng mạnh mẽ và thiết kế tinh tế, đáp ứng nhu cầu làm việc, học tập và giải trí hàng ngày. Với cấu hình mạnh mẽ cùng khả năng nâng cấp linh hoạt, sản phẩm này phù hợp với người dùng từ sinh viên đến nhân viên văn phòng.\r\nCPU: AMD Ryzen 7 5700U(8 nhân, 16 luồng,upto 4.30 GHz, 12MB)\r\nVGA: AMD Radeon™ Graphics\r\nMàn hình: 15.6 inch FHD(1920 x 1080) IPS 60Hz Acer ComfyView™ LED-backlit TFT LCD\r\nRAM: 2*8GB DDR4 3200Mhz (nâng cấp tối đa 32GB)\r\nỔ cứng: 512GB PCIe NVMe SSD (nâng cấp tối đa 2TB PCIe Gen4, 16 Gb/s, NVMe)\r\nPin: 50 Wh 3-cell\r\nCân nặng: 1.7 kg\r\nMàu sắc: Bạc\r\nOS: Windows 11 Home', 'AMD Ryzen 7 5700U | 15.6 inch FHD | 16GB | 512GB | Win 11', 0, 0, 6, 4),
(15, 'Laptop Acer Aspire Lite AL16-51P-72S2', 15990000, '1743090166_3927_49839_laptop_acer_aspire_lite_al16_51p_72s2.jpg.jpg', 'Acer Aspire Lite AL16-51P-72S2_NX.KX0SV.002 là dòng laptop văn phòng được thiết kế để mang đến trải nghiệm làm việc tối ưu. Với cấu hình mạnh mẽ, thiết kế chắc chắn và các tính năng tiện ích, chiếc Laptop Acer này phù hợp cho các tác vụ công việc hàng ngày lẫn giải trí cơ bản.\r\nCPU: Intel Core i7-1255U (upto 4.7 GHz, 12MB)\r\nRAM: 1*16GB 4800MHz DDR5 (2 khe, Nâng cấp tối đa 64 GB, cắm sẵn 16GB)\r\nỔ cứng: 512GB PCIe NVMe SSD\r\nVGA: Intel® Iris® Xe Graphics eligible\r\nMàn hình: 16\" FHD+(1920 x 1200) IPS (16:10) 45% NTSC 60Hz Acer ComfyView™ LED-backlit TFT LCD\r\nOS: Windows 11 Home SL\r\nPin: 58Whr 3-cell\r\nCân nặng: 1.8 kg\r\nMàu sắc: Xám', 'Intel Core i7-1255U | 16GB | 512GB | 16 inch FHD+ | Win 11', 0, 0, 6, 4),
(16, 'Laptop Acer Aspire 5 A514-55-5954', 12990000, '1743090248_1242_42872_4.jpg.jpg', 'CPU: Intel Core i5-1235U (upto 4.40 GHz, 12MB)\r\nRAM: 8GB (4GB onboard + 4GB So-dim) DDR4 2666Hz (1 khe, Nâng cấp tối đa 20GB)\r\nỔ cứng: 512GB PCIe NVMe SSD (nâng cấp tối đa 1 TB HDD và 1 TB SSD PCIe Gen3 8 Gb/s up to 4 lanes, NVMe)\r\nVGA: Intel Iris Xe Graphics\r\nMàn hình: 14.0 inch FHD(1920 x 1080), 60Hz Acer ComfyView™ IPS LED LCD\r\nPin: 3cell, 50Wh\r\nCân nặng: 1.4 kg\r\nMàu sắc: Steel Gray\r\nTính năng: Đèn nền bàn phím, Bảo mật vân tay\r\nOS: Windows 11 Home\r\n\r\nAcer Aspire 5 A514-55-5954 NX.K5BSV.001 là chiếc laptop - máy tính xách tay dành cho sinh viên & nhân viên văn phòng. Mẫu laptop Acer này sở hữu màn hình 14 inch, thiết kế nhỏ gọn cùng cấu hình core i5 chuyên dụng cho công việc, học tập và giải trí nhẹ nhàng, kèm tính năng bảo mật hiệu quả.\r\n\r\nAcer Aspire 5 A514-55-5954 NX.K5BSV.001 thuộc dòng laptop Aspire - đây là dòng laptop tầm trung rất được nhiều bạn sinh viên và giới nhân viên văn phòng bởi mức giá phải chăng, phong cách thiết kế tối giản thanh lịch, cùng với đó là kích thước gọn gàng, cân nặng nhẹ. \r\n\r\nPhần vỏ của laptop được làm từ chất liệu nhựa giả kim phủ lớp sơn màu kim loại xám. Các góc của laptop được bo tròn nhẹ, đường nét ở cạnh vuông vức và được gia công rất chắc chắn. Những điểm này đã tạo nên cho chiếc laptop Acer này một vẻ ngoài tinh tế như những chiếc laptop thuộc phân khúc cao cấp.\r\n\r\nKích thước của máy 32,8 x 22,1 cm, nặng chỉ 1,4kg và mỏng chỉ 1,79 cm. Đây là kích thước rất gọn nhẹ cho một chiếc máy 14 inch để bạn có thể dễ dàng cho vào balo, túi xách hay cầm nắm vừa tay để sử dụng nhiều môi trường làm việc khác nhau. ', 'Core i5-1235U | 8GB | 512G | Intel Iris Xe | 14.0 inch FHD IPS | Win 11', 0, 0, 6, 4),
(17, 'Laptop Acer Aspire 7 A715-76-728X', 16990000, '1743090605_8057_50618_laptop_acer_aspire_3_a315_44p_r5qg_nx_ksjsv_001__1_ (1).jpg.jpg', 'CPU: Intel Core i7-12650H (up to 4.7GHz, 24MB)\r\nRAM: 16GB (8x2) DDR4 3200MHz (2 slot, up to 32GB )\r\nỔ cứng: 512GB PCIe NVMe SSD\r\nVGA: Intel® UHD Graphics\r\nMàn hình: 15.6inch FHD (1920 x 1080) IPS SlimBezel, 60Hz\r\nPin: 3-cell, 50Wh\r\nCân nặng: 2.1kg\r\nMàu sắc: Đen\r\nOS: Windows 11 Home\r\n\r\n', 'Intel Core i7-12650H | 16GB | 512GB | Intel UHD | 15.6 inch FHD | Win 11', 0, 0, 6, 4),
(18, 'Laptop Lenovo ThinkPad P14s Gen 5 21G2004XVA', 37990000, '1743090757_2806_50902_laptop_lenovo_thinkpad_p14s_gen_5_21g2004xva__4_.jpg.jpg', 'CPU: Intel Core Ultra 5 125H, 14C (4P + 8E + 2LPE) / 18T, Max Turbo up to 4.5GHz, 18MB\r\nVGA: NVIDIA RTX 500 Ada Generation 4GB GDDR6\r\nMàn hình: 14.5\" WUXGA (1920x1200) IPS 300nits Anti-glare, 45% NTSC, 60Hz, Eyesafe®, TÜV Low Blue Light\r\nRAM: 2x 16GB SO-DIMM DDR5-5600 Non-ECC (Up to 96GB (2x 48GB DDR5 SO-DIMM)\r\nỔ cứng: 1TB SSD M.2 2280 PCIe® 4.0x4 Performance NVMe® Opal 2.0\r\nPin: 75Wh\r\nCân nặng: 1.61 kg\r\nTính năng: Bảo mật vân tay,…\r\nMàu sắc: Đen\r\nOS: NoOS\r\n\r\nLenovo ThinkPad P14s Gen 5 21G2004XVA là chiếc laptop workstation di động mạnh mẽ, được thiết kế để đáp ứng nhu cầu của các chuyên gia sáng tạo nội dung, kỹ sư và nhà thiết kế đồ họa. Với bộ vi xử lý Intel Core Ultra 5 125H, card đồ họa NVIDIA RTX 500 Ada Generation 4GB GDDR6, và màn hình 14.5 inch WUXGA chuẩn màu, sản phẩm mang lại sự cân bằng hoàn hảo giữa hiệu suất, tính di động và độ bền.\r\n\r\nThiết kế\r\nThinkPad P14s Gen 5 giữ nguyên phong cách thiết kế tối giản và chắc chắn đặc trưng của dòng ThinkPad, với màu đen thanh lịch và khung máy bền bỉ. Với trọng lượng 1.61 kg và kích thước gọn nhẹ, đây là một trong những mẫu máy workstation nhẹ nhất, giúp người dùng dễ dàng mang theo khi di chuyển. Máy được trang bị bàn phím có đèn nền, mang lại sự tiện lợi khi làm việc trong môi trường ánh sáng yếu, cùng cảm biến vân tay tích hợp để đảm bảo bảo mật.', 'Intel Core Ultra 5 125H | RTX 500 Ada | 14.5 inch WUXGA | 32GB | 1TB | NoOS | Đen', 0, 0, 4, 1),
(19, 'Laptop Lenovo Legion Pro 5 16IRX9 83DF0047VN', 45990000, '1743090837_9565_47463_laptop_lenovo_legion_pro_5_16irx9_83df0047vn__intel_core_i9_14900hx__4_.jpg.jpg', 'CPU: Intel Core i9-14900HX (up to 5.8GHz 36MB)\r\nVGA: NVIDIA GeForce RTX 4060 8GB (AI TOPS: 233)\r\nMàn hình: 16 inch WQXGA (2560x1600) IPS 500nits Anti-glare, 100% DCI-P3, 240Hz, DisplayHDR™ 400, Dolby Vision®, G-SYNC®, Low Blue Light, High Gaming Performance\r\nRAM: 32GB (16x2) DDR5-5600 (2 khe, up to 32GB)\r\nỔ cứng: 1TB SSD M.2 2280 PCIe® 4.0x4 NVMe®\r\nPin: 80WHr\r\nCân nặng: 2.5 kg\r\nMàu sắc: Xám\r\nOS: Windows 11 Home\r\nChức năng: Bàn phím 4-Zone RGB Backlit\r\n\r\nLenovo Legion Pro 5 16IRX9 83DF0047VN là một chiếc laptop gaming cao cấp với cấu hình mạnh mẽ, thiết kế tối ưu và khả năng xử lý tuyệt vời. Được trang bị bộ xử lý Intel Core i9-14900HX và card đồ họa NVIDIA GeForce RTX 4060, chiếc Lenovo Legion này là lựa chọn hoàn hảo cho game thủ và người dùng đòi hỏi hiệu suất cao.\r\n\r\nThiết Kế Bền Bỉ, Tinh Tế Với Vỏ Nhựa Cứng Cáp\r\nLegion Pro 5 sở hữu thiết kế mạnh mẽ, sang trọng đặc trưng của dòng máy Legion nổi tiếng.  Chất lượng Build siêu hạng cực kỳ cứng cáp với vỏ nhựa xám Obsidian mang tới cho Legion sự chắc chắn, không hề có hiện tượng ọp ẹp ở bất kỳ mặt nào của máy. Máy có cân nặng 2.5 kg, phù hợp hơn với các setup cố định phù hợp với những anh em chú trọng vào hiệu năng mạnh mẽ thay vì tính di động.\r\n\r\nHiệu Năng Cực Đỉnh Với Intel Core i9-14900HX Và RTX 4060\r\nSở hữu CPU Intel Core i9-14900HX với 24 nhân 32 luồng, tốc độ tối đa 5.8GHz cùng bộ nhớ đệm 36MB, Lenovo Legion Pro 5 dễ dàng xử lý các tác vụ phức tạp, từ chơi game cho đến các phần mềm đồ họa chuyên nghiệp. Hiệu suất của 14900HX là không phải bàn cãi, đây có thể coi như là chiếc CPU Laptop mạnh mẽ nhất ở thời điểm hiện tại. Cho thử nghiệm với Cinebench R23, i9-14900HX đạt tới 27232 điểm thể hiện sức mạnh áp đảo so với mọi chiếc CPU Laptop thời điểm hiện tại. Mức nhiệt độ trung bình khi chạy Benchmark là 80 độ khi ở chế độ Performance.', 'Intel Core i9-14900HX | RTX 4060 |16inch WQXGA | 32GB | 1TB SSD | Win 11 | Grey', 0, 0, 4, 1),
(20, 'Laptop Lenovo Legion 5 16IRX9 83DG004YVN', 39990000, '1743090936_9472_47464_47461_laptop_lenovo_legion_pro_7_16irx9h_83de001mvnvvvv.jpg.jpg', 'CPU: Intel Core i7-14650HX\r\nVGA: NVIDIA® GeForce RTX™ 4060 8GB GDDR6 (AI TOPS: 233)\r\nMàn hình: 16 inch WQXGA (2560x1600) AG, 350nits, 165Hz\r\nRAM: 16GB\r\nỔ cứng: 512GB M.2 2280 PCIe 4.0x4 NVMe SSD\r\nPin: 80Wh\r\nCân nặng:\r\nMàu sắc:Xám\r\nOS: Windows 11 Home\r\nChức năng: Bàn phím Led RGB\r\n\r\nLaptop Lenovo Legion 5 16IRX9 83DG004YVN\r\nKhi bạn đang tìm kiếm một chiếc laptop gaming cao cấp, Lenovo Legion 5 16IRX9 83DG004YVN không chỉ đáp ứng mà còn vượt trội hơn cả những kỳ vọng của bạn.\r\nLenovo Legion 5 được trang bị vi xử lý Intel Core i7-14650HX và card đồ họa RTX 4060, mang lại hiệu suất mạnh mẽ cho mọi trò chơi và ứng dụng đồ họa. Dù bạn đang chơi game đồ họa cao, làm việc với phần mềm thiết kế, chỉnh sửa video hay lập trình, máy này luôn đảm bảo trải nghiệm mượt mà và nhanh chóng.\r\n\r\nBộ Nhớ RAM 16GB DDR5 và SSD 512GB NVMe Siêu Nhanh\r\nVới RAM 16GB DDR5 và SSD 512GB NVMe, Lenovo Legion 5 không chỉ cung cấp khả năng xử lý đa nhiệm mạnh mẽ mà còn đảm bảo tốc độ truy cập dữ liệu siêu nhanh. Bạn sẽ thấy sự khác biệt rõ rệt trong mọi tác vụ, từ khởi động máy, chạy ứng dụng đến truy cập dữ liệu.\r\n\r\n \r\n\r\nMàn Hình 16 inch 165Hz Độ Phân Giải 2560x1600\r\nMàn hình của sản phẩm Lenovo Legion này lớn 16 inch với tần số quét 165Hz và độ phân giải 2560x1600 mang đến hình ảnh sắc nét và trải nghiệm chơi game mượt mà, tối ưu hóa mọi chi tiết hình ảnh. Đây là yếu tố quan trọng không chỉ cho game thủ mà còn cho những người làm việc với hình ảnh và video.\r\n', 'Intel Core i7-14650HX | RTX 4060 |16 inch WQXGA 165Hz | 16GB | 512GB SSD | Win 11 | Grey', 0, 0, 4, 1),
(21, 'Laptop Lenovo Legion 7 16IRX9 83FD006JVN', 59900000, '1743091039_5010_48683_laptop_lenovo_legion_7_16irx9_83fd006jvn__intel_core_i9_14900hxlaptop_lenovo_legion_7_16irx9_83fd006jvn__intel_core_i9_14900hx__4_.jpg.jpg', 'CPU: Intel Core i9-14900HX (24C/32T, P-core 2.2 / 5.8GHz 36MB)\r\nVGA: NVIDIA® GeForce RTX™ 4070 8GB GDDR6 (AI TOPS: 321)\r\nMàn hình: 16\" 3.2K (3200x2000) IPS 430nits Anti-glare, 100% DCI-P3, 165Hz, Dolby® Vision®, G-SYNC®, Low Blue Light\r\nRAM: 2x 16GB SO-DIMM DDR5-5600(2x SO-DIMM socket, Up to 32GB)\r\nỔ cứng: 1TB SSD M.2 2280 PCIe® 4.0x4 NVMe\r\nPin: 99.9Wh\r\nCân nặng: 2.24 kg\r\nMàu sắc: Trắng\r\nOS: Windows 11 Home\r\nChức năng: Bàn phím Per-key RGB\r\n\r\nLaptop Lenovo Legion 7 16IRX9 83FD006JVN\r\nNếu bạn đang tìm kiếm một chiếc laptop gaming cao cấp không chỉ mạnh mẽ về hiệu năng mà còn đẳng cấp về thiết kế, Laptop Lenovo Legion 7 16IRX9 83FD006JVN chính là lựa chọn không thể bỏ qua.\r\nHiệu Năng Đỉnh Cao với Intel Core i9-14900HX và RTX 4070\r\nTrái tim của Lenovo Legion 5 16IRX9 83DG0051VN là vi xử lý Intel Core i9-14900HX, một trong những CPU mạnh mẽ nhất hiện nay, cùng với card đồ họa RTX 4070 8GB GDDR6, tạo nên sức mạnh đáng kinh ngạc cho mọi trò chơi và ứng dụng đồ họa. Với cấu hình này, bạn có thể chơi các tựa game mới nhất ở cài đặt đồ họa cao, làm việc với các phần mềm thiết kế đồ họa, chỉnh sửa video hay lập trình mà không lo về vấn đề giật lag.\r\n\r\nRAM 32GB DDR5 - Hiệu Suất Ấn Tượng\r\nVới RAM 16GB DDR5, Laptop Lenovo Legion 7 16IRX9 83FD006JVN không chỉ đáp ứng nhu cầu gaming mà còn là một sự lựa chọn hoàn hảo cho các công việc đòi hỏi khả năng xử lý đa nhiệm và tốc độ cao như thiết kế đồ họa, chỉnh sửa video và phát triển phần mềm.\r\n\r\nMàn Hình 16 inch 165Hz Độ Phân Giải 3.2K\r\nMàn hình 16 inch của laptop với tần số quét 165Hz và độ phân giải 3.2K (3200x2000) mang lại trải nghiệm hình ảnh sắc nét, màu sắc sống động, và độ mượt mà tuyệt vời. Đây là điểm cộng lớn cho game thủ và những người làm trong lĩnh vực sáng tạo nội dung, nơi mà chất lượng hình ảnh là yếu tố quan trọng. Tần số quét 165Hz bắt kịp từng chuyển động để mang lại lợi thế cho bạn trong những tựa Game FPS hành động tốc độ cao.', 'Intel Core i9-14900HX | RTX 4070 |32GB | 1TB | 16 inch 3.2K | Win 11 | Trắng', 0, 0, 4, 1),
(22, 'Laptop HP ENVY X360 14-fc0084TU A19BTPA', 35190000, '1743091142_2594_49142_laptop_hp_envy_x360_14_fc0084tu_a19btpa_anphatcomputer_1.jpg.jpg', 'CPU: Intel Core Ultra 7 155U (up to 4.8 GHz, 12 MB L3 cache, 12 cores, 14 threads)\r\nRAM: 32 GB LPDDR5-6400 MHz RAM (onboard)\r\nỔ cứng: 1 TB PCIe® Gen4 NVMe™ M.2 SSD\r\nVGA: Intel® Graphics\r\nMàn hình: 14\" 2.8K (2880 x 1800), OLED, multitouch-enabled, 48-120 Hz, 0.2 ms response time, UWVA, edge-to-edge glass, micro-edge, Corning® Gorilla® Glass NBT™, Low Blue Light, SDR 400 nits, HDR 500 nits, 100% DCI-P3\r\nPin: 3-cell, 59 Wh\r\nTính năng: Đèn nền bàn phím\r\nCân nặng: 1.34 kg\r\nMàu sắc: Bạc\r\nOS: Windows 11 Home\r\n\r\nLaptop HP ENVY X360 14-fc0084TU A19BTPA\r\nLaptop HP ENVY X360 14-fc0084TU A19BTPA là sự kết hợp hoàn hảo giữa hiệu năng mạnh mẽ, thiết kế sang trọng và các tính năng hiện đại, mang lại trải nghiệm tuyệt vời cho người dùng cần một chiếc máy tính xách tay linh hoạt phục vụ công việc sáng tạo, giải trí và đa nhiệm. Với cấu hình cao cấp cùng thiết kế mỏng nhẹ, sản phẩm này xứng đáng là người bạn đồng hành lý tưởng cho các chuyên gia và người dùng đam mê công nghệ.\r\n\r\nHiệu năng vượt trội với Intel Core Ultra 7\r\nLaptop HP ENVY X360 14-fc0084TU A19BTPA được trang bị bộ vi xử lý Intel Core Ultra 7-155U thế hệ mới nhất, với bộ nhớ đệm 12MB và tốc độ tối đa lên đến 4.8 GHz. Vi xử lý này cung cấp hiệu suất mạnh mẽ cho các tác vụ đa nhiệm, giúp bạn dễ dàng xử lý mọi công việc từ văn phòng, lập trình cho đến chỉnh sửa đồ họa. Với khả năng tiết kiệm năng lượng và hiệu quả cao, bạn có thể yên tâm làm việc lâu dài mà không lo lắng về tình trạng máy quá nhiệt.\r\nRAM LPDDR5 và ổ cứng SSD tốc độ cao\r\nLaptop HP ENVY X360 được trang bị 32 GB RAM LPDDR5-6400 MHz, cung cấp khả năng xử lý nhanh chóng và mượt mà, ngay cả khi bạn mở nhiều ứng dụng cùng lúc. Bộ nhớ RAM tốc độ cao này giúp tối ưu hóa hiệu suất, giảm thiểu tình trạng giật lag trong quá trình sử dụng. Ổ cứng SSD PCIe® Gen4 NVMe™ M.2 dung lượng 1 TB không chỉ mang lại không gian lưu trữ rộng rãi mà còn đảm bảo tốc độ truy xuất dữ liệu vượt trội, giúp khởi động máy và ứng dụng gần như ngay lập tức.', 'Intel Core Ultra 7 155U | 32GB | 1TB | 14 inch 2.8K | Win 11 | Bạc', 0, 0, 3, 1),
(23, 'Laptop Dell Mobile Precision Workstation 5680 71023332', 57900000, '1743091253_5611_46984_laptop_dell_mobile_precision_workstation_5680_71023332__1_.jpg.jpg', 'CPU: Intel Core i7-13800H (upto 5.2 GHz, 24MB)\r\nRAM: 16GB DDR5 4800MHz\r\nỔ cứng: 512GB M.2 2230 Gen 4 PCIe NVMe SSD\r\nVGA: NVIDIA RTX 2000 Ada 8GB\r\nMàn hình: 16 inch FHD+ 1920x1200, WVA, 60Hz, anti-glare, non-touch, 45% NTSC, 250 nits\r\nPin: 6-cell 100Wh\r\nCân nặng:\r\nOS: Ubuntu\r\n\r\nLaptop Dell Mobile Precision Workstation 5680 71023332\r\nDell Mobile Precision Workstation 5680 là dòng laptop – máy tính xách tay thuộc phân khúc máy trạm cao cấp của Dell, được lấy cảm hứng thiết kế từ dòng laptop doanh nhân cao cấp XPS 15, nhưng màu sắc của máy được thay đổi thành Titan Gray, vẻ ngoài cũng mạnh mẽ, chắn chắn hơn. Với thiết kế bền bỉ, màn hình độ phân giải sắc nét và đặc biệt là hiệu năng mạnh mẽ, đây sẽ là mẫu laptop Dell dành riêng cho những ai đang cần một thiết bị mỏng nhẹ nhưng lại có thể đáp ứng tốt cho các tác vụ nặng như thiết kế hình ảnh, dựng 3D, render video và nhiều hơn thế nữa.\r\n\r\nThiết kế sang trọng, siêu cấp bền bỉ\r\n\r\nDell Mobile Precision Workstation 5680 thừa hưởng một thiết kế sang trọng, mỏng nhẹ và tinh tế đến từ dòng XPS. Dell Mobile Precision Workstation 5680 được nhiều người dùng ví von là một chiếc Workstation “ẩn mình” trong một chiếc máy doanh nhân hiện đại.\r\n\r\nHiệu năng mạnh mẽ với CPU Intel\r\n\r\nDell Mobile Precision Workstation 5680 được trang bị một cấu hình cực “ngon” trong phân khúc giá, bao gồm CPU Intel Core i7-13800H, 14 nhân / 20 luồng, một con chip hiệu năng cao cùng với card đồ họa rời NVIDIA RTX 2000 Ada 8GB. Với cấu hình này, Dell Mobile Precision Workstation 5680 có thể đáp ứng tối đa các nhu cầu đòi hỏi sự mạnh mẽ.\r\n\r\n', 'Intel Core i7-13800H | 16GB | 512GB | RTX 2000 Ada 8GB | 16 inch FHD+ | Ubuntu', 0, 0, 2, 1),
(24, 'Laptop Asus Vivobook 14 OLED A1405VA-KM095W', 16990000, '1743091365_9397_44758_laptop_asus_vivobook_14_oled_a1405va_km095w__2_.jpg.jpg', 'CPU: Intel Core i5-13500H (upto 4.7GHz, 18MB)\r\nRAM: 16GB (8GB DDR4 on board + 8GB DDR4 SO-DIMM)\r\nỔ cứng: 512GB M.2 NVMe™ PCIe® 3.0 SSD\r\nVGA: Intel Iris Xᵉ Graphics\r\nMàn hình: 14 inch 2.8K (2880 x 1800) OLED 16:10 aspect ratio, 0.2ms response time, 90Hz refresh rate, 100% DCI-P3 color gamut, 600nits HDR peak brightness, VESA CERTIFIED Display HDR True Black 600, Glossy display\r\nPin: 3 cell /50WHrs\r\nCân nặng: 1.6 kg\r\nTính năng: Bảo mật vân tay\r\nMàu sắc: Bạc\r\nOS: Windows 11 Home\r\n\r\nLaptop Asus Vivobook Pro 14 OLED A1405VA-KM095W\r\nTuyên ngôn sức mạnh. Sống động thị giác \r\nTỏa sáng với cả thế giới cùng ASUS Vivobook 14 OLED mạnh mẽ, chiếc laptop tích hợp nhiều tính năng với màn hình OLED rực rỡ, gam màu DCI-P3 đẳng cấp điện ảnh. Mọi thứ trở nên dễ dàng hơn nhờ những tiện ích thân thiện với người dùng bao gồm bản lề mở phẳng 180°, nắp che webcam vật lý và các phím chức năng chuyên dụng. Bảo vệ sức khỏe an toàn với ASUS kháng khuẩn Guard Plus trên các bề mặt thường xuyên chạm vào. Bắt đầu ngày mới đầy hứng khởi với ASUS Vivobook 14/15 OLED!\r\n\r\nHiệu năng mạnh mẽ hàng đầu phân khúc\r\nASUS Vivobook 14 OLED giúp bạn hoàn thành mọi tác vụ một cách nhanh chóng ở bất cứ đâu, dù ở cơ quan, ở nhà hay khi đi ra ngoài. Bộ vi xử lý Intel® Core™ thế hệ thứ 13 cùng bộ nhớ RAM DDR4 lên đến 16GB, bộ nhớ SSD 512GB và công nghệ kết nối WiFi 6E tiên tiến giúp mọi thứ trở nên dễ dàng.', 'Core i5-13500H | 16GB | 512GB | Intel Iris Xe | 14 inch 2.8K OLED | Win 11 | Bạc', 0, 0, 5, 3),
(25, 'Laptop Lenovo IdeaPad Slim 3 14IRH10 83K00008VN', 15490000, '1743091449_6674_51729_laptop_lenovo_ideapad_slim_3_14irh10_83k00008vn__3_.jpg.jpg', 'CPU: Intel Core i5-13420H, (8C/ 12T, upto 4.6GHz, 12MB)\r\nRAM: 8GB Soldered DDR5-4800 + 8GB SO-DIMM DDR5-4800 (tối đa 24GB)\r\nỔ cứng: 512GB SSD M.2 2242 PCIe® 4.0x4 NVMe\r\nVGA: Integrated Intel UHD Graphics\r\nMàn hình: 14\" WUXGA (1920x1200) IPS 300nits Anti-glare, 45% NTSC\r\nPin: 60Wh\r\nCân nặng: 1.43 kg\r\nMàu sắc: Luna Grey\r\nOS: Windows 11 Home SL\r\n\r\nLaptop Lenovo IdeaPad Slim 3 14IRH10 83K00008VN', 'Intel Core i5-13420H | 16GB | 512GB | Intel UHD | 14 inch WUXGA | Win 11 | Xám', 0, 0, 4, 3);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
