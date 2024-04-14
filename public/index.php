<?php
require_once '../core/App.php';
session_start();

// Kiểm tra nếu các tham số controller và action được truyền trong URL
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Kiểm tra xem tên file controller có tồn tại không
if (file_exists('../app/controllers/' . $controllerName . '.php')) {
    require_once '../app/controllers/' . $controllerName . '.php';

    // Tạo đối tượng controller và gọi hàm action tương ứng
    $controller = new $controllerName;

    // Kiểm tra nếu action là showByUsername và có tham số username được truyền
    if ($action === 'showByUsername' && isset($_GET['username'])) {
        $username = $_GET['username'];
        $controller->$action($username);
    } 
    // Kiểm tra nếu action là follow hoặc unfollow và có tham số userId được truyền
    elseif (($action === 'follow' || $action === 'unfollow') && isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        // Gọi hàm tương ứng với action
        $controller->$action($userId);
    } 
    // Xử lý các trường hợp còn lại
    else {
        // Gọi hàm action mặc định nếu không có tham số đặc biệt
        $controller->$action();
    }
} else {
    // Xử lý controller không tồn tại
    echo "Controller $controllerName not found";
}
?>
