<?php
require_once '../core/Database.php';

class Tweet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

}
?>