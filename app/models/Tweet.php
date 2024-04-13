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
    public function addTweetWithImage($userId, $content, $imageName)
{
    $this->db->query('INSERT INTO tweets (UserID, Content, ImageURL) VALUES (:user_id, :content, :image_url)');
    $this->db->bind(':user_id', $userId);
    $this->db->bind(':content', $content);
    $this->db->bind(':image_url', $imageName); // Lưu tên của tệp ảnh vào cơ sở dữ liệu
    $this->db->execute();
}

    public function getAllTweets()
    {
        $this->db->query('SELECT tweets.*, users.Username FROM tweets JOIN users ON tweets.UserID = users.UserID ORDER BY tweets.Timestamp DESC');
        return $this->db->resultSet();
    }

    public function getTweetsByUserId($userId) {
        $this->db->query('SELECT * FROM tweets WHERE UserID = :user_id ORDER BY Timestamp DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getTweets() {
        $this->db->query('SELECT tweets.*, users.Username, users.Avatar FROM tweets JOIN users ON tweets.UserID = users.UserID ORDER BY tweets.Timestamp DESC');
        return $this->db->resultSet();
    }
    

}
?>
