# XLaptopshop - Trang Web Bán Laptop (PHP MVC)

## Giới thiệu

XLaptopshop là một trang web bán laptop được xây dựng bằng PHP thuần theo mô hình MVC (Model-View-Controller). Trang web cung cấp các tính năng chính như:

- Xem danh sách sản phẩm, lọc và sắp xếp theo thương hiệu, danh mục, giá.
- Hỗ trợ thanh toán qua VNPay.
- Xem chi tiết sản phẩm và thêm vào giỏ hàng.
- Quản lý giỏ hàng, thanh toán và theo dõi đơn hàng.
- Đăng ký, đăng nhập, quản lý hồ sơ người dùng, quên mật khẩu và thay đổi mật khẩu.


## Yêu cầu để chạy trang web

Để chạy trang web, bạn cần cài đặt các công cụ sau:

- **Host**: phải chạy trang web trên localhost:3000.
- **PHP**: Phiên bản 7.4 trở lên.
- **MySQL**: Để lưu trữ cơ sở dữ liệu.
- **Web Server**: Apache (có thể sử dụng XAMPP, WAMP hoặc MAMP).
- **Visual Studio Code (VS Code)**: Để chạy localhost:3000.
- **VS Code Extension**: Cài đặt extension `PHP Server` để chạy trang web trên localhost.

## Hướng dẫn cài đặt và chạy

### Bước 1: Clone mã nguồn từ GitHub
- Mở terminal hoặc Git Bash.
- Clone kho mã nguồn từ GitHub:
  ```bash
  git clone https://github.com/zdat5624/web-php.git
  ```
- Di chuyển vào thư mục dự án:
  ```bash
  cd web-php
  ```

### Bước 2: Thiết lập cơ sở dữ liệu
1. Khởi động MySQL (thông qua XAMPP/WAMP hoặc MySQL CLI).
2. Tạo một cơ sở dữ liệu mới với tên chính xác là `laptopshop123`.
   ```sql
   CREATE DATABASE laptopshop123;
   ```
3. Import file dump cơ sở dữ liệu từ thư mục `document/laptopshop123.sql`:
   - Sử dụng phpMyAdmin hoặc MySQL CLI để import file dump `laptopshop123.sql`.
   
4. Cấu hình kết nối cơ sở dữ liệu trong file `dao/pdo.php`:
   - Mở file `dao/pdo.php` và chỉnh sửa thông tin kết nối (username, password, database name) phù hợp với môi trường của bạn.
   - Ví dụ:
     ```php
      $dburl = "mysql:host=localhost;dbname=laptopshop123;charset=utf8";
      $username = 'root';
      //$password = ''; hoặc $password = '123456';
      $password = '123456';
     ```

### Bước 3: Chạy trang web trên localhost (bắt buộc là cổng 3000), với vs code thì mặt định sẽ chạy trên cổng 300
1. Mở dự án trong Visual Studio Code:
   - Mở VS Code, chọn `File > Open Folder` và chọn thư mục `web-php` vừa clone.
2. Cài đặt extension `PHP Server`:
   - Vào `Extensions Marketplace` trong VS Code (Ctrl+Shift+X hoặc Cmd+Shift+X trên macOS).
   - Tìm kiếm `PHP Server` và cài đặt.
3. Chạy trang web:
   - Nhấn chuột phải vào file `index.php` trong VS Code, chọn `PHP Server: Serve Project`.
   - VS Code sẽ mở một server localhost (mặc định là cổng 3000). Nếu không phải cổng 3000, bạn có thể thay đổi cổng trong cài đặt của `PHP Server` (truy cập `Settings > Extensions > PHP Server` và chỉnh sửa `Port` thành 3000).
4. Truy cập trang web:
   - Mở trình duyệt và truy cập `http://localhost:3000`.

### Bước 4: Sử dụng trang web
- Trang chủ: Xem các sản phẩm mới nhất và bán chạy nhất.
- Đăng ký/Đăng nhập: Sử dụng tính năng đăng ký và đăng nhập để mua hàng.
- Giỏ hàng: Thêm sản phẩm vào giỏ hàng, thanh toán và xem lịch sử đơn hàng.
- Đặt hàng: cod hoặc VNPAY
- Các tài khoản:
  1. email: admin@gmail.com, mật khẩu: 1234567
  2. email: user1@gmail.com, mật khẩu 123456