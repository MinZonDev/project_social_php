<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
    <h2>Đăng ký</h2>
    <form action="register_process.php" method="post">
        <label for="username">Tên người dùng:</label><br>
        <input type="text" id="username" name="username" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Mật khẩu:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" value="Đăng ký">
    </form>
</body>
</html>
