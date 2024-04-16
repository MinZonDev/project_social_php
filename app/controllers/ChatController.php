<?php
<<<<<<< HEAD
require_once 'core/Database.php';

class ChatController {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function chatPage() {
        // Hiển thị giao diện chat
        include_once 'chat_page.php';
    }

    public function sendMessage($senderID, $receiverID, $messageContent) {
        // Lưu tin nhắn vào cơ sở dữ liệu
        $query = "INSERT INTO messages (SenderID, ReceiverID, Content) VALUES (?, ?, ?)";
        $params = array($senderID, $receiverID, $messageContent);
        $this->db->execute($query, $params);

        // Gửi tin nhắn đến người nhận, lưu vào cơ sở dữ liệu, v.v.
        // Code xử lý gửi tin nhắn ở đây
    }

    public function receiveMessages($senderID, $receiverID) {
        // Lấy tin nhắn từ cơ sở dữ liệu giữa hai người dùng
        $query = "SELECT * FROM messages WHERE (SenderID = ? AND ReceiverID = ?) OR (SenderID = ? AND ReceiverID = ?) ORDER BY Timestamp ASC";
        $params = array($senderID, $receiverID, $receiverID, $senderID);
        $messages = $this->db->fetchAll($query, $params);

        // Trả về tin nhắn dưới dạng JSON
        return json_encode($messages);
    }
}
=======

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

>>>>>>> 48cdc22bdb8ed63689fb55a82dde68efb8d21e3e
?>
