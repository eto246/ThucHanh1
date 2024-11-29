<?php
$servername = "localhost";  // Máy chủ MySQL
$username = "root";         // Tên người dùng (mặc định là root)
$password = "";             // Mật khẩu (trống nếu không đặt)
$database = "flower_th1";  // Đảm bảo tên cơ sở dữ liệu đúng

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
