<?php
    // Thông tin kết nối MySQL
    $servername = "localhost"; // Thay đổi thành tên máy chủ của bạn
    $username = "root"; // Thay đổi thành tên người dùng MySQL của bạn
    $password = ""; // Thay đổi thành mật khẩu MySQL của bạn
    $dbname = "chirp_social"; // Thay đổi thành tên cơ sở dữ liệu bạn muốn tạo

    // Tạo kết nối đến MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>