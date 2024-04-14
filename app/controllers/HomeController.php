<?php
require_once '../app/models/Tweet.php';

class HomeController {
    
    public function index() {
        // Kiểm tra xem người dùng đã đăng nhập chưa và có thông tin đăng nhập hợp lệ không
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Nếu chưa đăng nhập hoặc thiếu thông tin đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Tạo một đối tượng Tweet để lấy danh sách bài viết
        $tweetModel = new Tweet();
        $tweets = $tweetModel->getTweets();

        // Load view for homepage và truyền danh sách bài viết vào
        require_once '../app/views/home/index.php';
    }
    
}

?>