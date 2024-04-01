<?php
// Thực hiện kết nối đến MySQL
include 'config/connect.php';

// Lấy dữ liệu từ biểu mẫu đăng ký
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Mã hóa mật khẩu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Thêm người dùng vào cơ sở dữ liệu và lấy thời gian hiện tại
$date_joined = date('Y-m-d H:i:s');

$sql = "INSERT INTO Users (Username, Email, Password, DateJoined) VALUES ('$username', '$email', '$hashed_password', '$date_joined')";
if ($conn->query($sql) === TRUE) {
    echo "Đăng ký thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối MySQL
$conn->close();
?>
