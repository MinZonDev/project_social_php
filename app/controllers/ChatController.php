<?php
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
?>
