<?php
require_once '../core/Database.php';

class Tweet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTweet($userId, $content)
    {
        $this->db->query('INSERT INTO tweets (UserID, Content) VALUES (:user_id, :content)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':content', $content);
        $this->db->execute();
    }

    public function getAllTweets()
    {
        $this->db->query('SELECT * FROM tweets ORDER BY Timestamp DESC');
        return $this->db->resultSet();
    }
}
?>
