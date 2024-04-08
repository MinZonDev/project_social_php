<?php
class TweetModel {
    private $db;

    public function __construct() {
        require_once '../core/Database.php';
        $this->db = new Database();
    }

    public function create_tweet($userID, $content, $timestamp, $retweetID, $retweetCount, $likeCount) {
        $sql = "INSERT INTO tweets (UserID, Content, Timestamp, RetweetID, RetweetCount, LikeCount) VALUES (:userID, :content, :timestamp, :retweetID, :retweetCount, :likeCount)";
        $this->db->query($sql);
        $this->db->bind(':userID', $userID);
        $this->db->bind(':content', $content);
        $this->db->bind(':timestamp', $timestamp);
        $this->db->bind(':retweetID', $retweetID);
        $this->db->bind(':retweetCount', $retweetCount);
        $this->db->bind(':likeCount', $likeCount);

        $this->db->execute();
    }

    public function get_tweets() {
        $query = "SELECT * FROM tweets ORDER BY Timestamp DESC";
        return $this->db->result_set($query);
    }
    public function getUserTweets($userId) {
        $this->db->query('SELECT * FROM tweets WHERE UserID = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet(); // Phương thức resultSet() để trả về tất cả các dòng kết quả dưới dạng một mảng
    }
}
?>
