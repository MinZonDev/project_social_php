<?php
session_start();

// Thực hiện kết nối đến MySQL
include 'config/connect.php';

// Lấy dữ liệu từ biểu mẫu đăng nhập
$email = $_POST['email'];
$password = $_POST['password'];

// Tìm người dùng trong cơ sở dữ liệu
$sql = "SELECT * FROM Users WHERE Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['Password'])) {
        // Đăng nhập thành công, chuyển hướng người dùng đến trang chính
        $_SESSION['userid'] = $row['UserID'];
        header("Location: index.php"); // Chuyển hướng đến trang chính
    } else {
        echo "Sai mật khẩu!";
    }
} else {
    echo "Không tìm thấy người dùng với email này!";
}

// Đóng kết nối MySQL
$conn->close();
?>
