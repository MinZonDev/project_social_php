<?php
require_once '../core/Database.php';

class ChatController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function index()
    {
        require_once '../app/views/chat/chat.php ';// Update the path to point directly to chat.php
    }
}
?>
