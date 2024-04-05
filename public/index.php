<?php
require_once '../core/App.php';
session_start();
// Kiểm tra nếu các tham số controller và action được truyền trong URL
$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Kiểm tra xem tên file controller có tồn tại không
if (file_exists('../app/controllers/' . $controller . '.php')) {
    require_once '../app/controllers/' . $controller . '.php';

    // Tạo đối tượng controller và gọi hàm action tương ứng
    $controller = new $controller;
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        // Xử lý hành động không tồn tại
        echo "Action $action not found in controller $controller";
    }
} else {
    // Xử lý controller không tồn tại
    echo "Controller $controller not found";
}
?>
