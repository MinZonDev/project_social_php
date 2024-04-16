<?php
require_once 'core/Database.php';

class Chat {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function sendMessage($senderID, $receiverID, $messageContent) {
        // Lưu tin nhắn vào cơ sở dữ liệu
        $query = "INSERT INTO messages (SenderID, ReceiverID, Content) VALUES (?, ?, ?)";
        $params = array($senderID, $receiverID, $messageContent);
        $this->db->query($query);
        $this->db->bind(1, $senderID);
        $this->db->bind(2, $receiverID);
        $this->db->bind(3, $messageContent);
        $this->db->execute();

        // Gửi tin nhắn đến người nhận, lưu vào cơ sở dữ liệu, v.v.
        // Code xử lý gửi tin nhắn ở đây
    }

    public function receiveMessages($senderID, $receiverID) {
        // Lấy tin nhắn từ cơ sở dữ liệu giữa hai người dùng
        $query = "SELECT * FROM messages WHERE (SenderID = ? AND ReceiverID = ?) OR (SenderID = ? AND ReceiverID = ?) ORDER BY Timestamp ASC";
        $params = array($senderID, $receiverID, $receiverID, $senderID);
        $this->db->query($query);
        $this->db->bind(1, $senderID);
        $this->db->bind(2, $receiverID);
        $this->db->bind(3, $receiverID);
        $this->db->bind(4, $senderID);
        $messages = $this->db->fetchAll();

        // Trả về tin nhắn dưới dạng JSON
        return json_encode($messages);
    }
}
?>
