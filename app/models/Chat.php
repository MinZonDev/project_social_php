<?php

require_once 'core/Database.php';

class Chat {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function saveMessage($content) {
        $sql = "INSERT INTO messages (content, timestamp) VALUES (:content, NOW())";
        $this->db->query($sql);
        $this->db->bind(':content', $content);
        return $this->db->execute();
    }

    public function getMessages() {
        $sql = "SELECT content FROM messages ORDER BY timestamp DESC LIMIT 10";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
?>
