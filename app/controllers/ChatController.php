<?php

// Import model Chat
require_once 'models/Chat.php';

class ChatController {
    private $chatModel;

    // Khởi tạo đối tượng ChatModel
    public function __construct() {
        $this->chatModel = new Chat();
    }

    // Phương thức hiển thị trang chat
    public function index() {
        // Hiển thị trang chat
        include 'views/chat.php';
    }

    // Phương thức gửi tin nhắn
    public function sendMessage() {
        // Kiểm tra xem có dữ liệu được gửi từ form không
        if(isset($_POST['message'])) {
            $message = $_POST['message'];
            
            // Lưu tin nhắn vào cơ sở dữ liệu
            $this->chatModel->saveMessage($message);
            
            // Gửi tin nhắn đến tất cả các người dùng
            $this->sendToAll($message);
        }
    }

    // Phương thức gửi tin nhắn đến tất cả người dùng
    private function sendToAll($message) {
        // Gửi tin nhắn đến tất cả các người dùng (sử dụng WebSockets hoặc AJAX)
        // Phương thức này phụ thuộc vào cách bạn triển khai giao tiếp thời gian thực.
    }
}

?>
