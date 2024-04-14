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
        $this->db->bind(':image_url', $imageName);
        $this->db->execute();
    }

    public function getAllTweets()
    {
        $this->db->query('SELECT tweets.*, users.Username, users.Avatar FROM tweets JOIN users ON tweets.UserID = users.UserID ORDER BY tweets.Timestamp DESC');
        return $this->db->resultSet();
    }

    public function likeTweet($tweetId, $userId)
    {
        $this->db->query('INSERT INTO likes (UserID, TweetID) VALUES (:user_id, :tweet_id)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();

        $this->updateLikeCount($tweetId, 1);
    }

    public function unlikeTweet($tweetId, $userId)
    {
        $this->db->query('DELETE FROM likes WHERE UserID = :user_id AND TweetID = :tweet_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();

        $this->updateLikeCount($tweetId, -1);
    }

    private function updateLikeCount($tweetId, $increment)
    {
        $this->db->query('UPDATE tweets SET LikeCount = LikeCount + :increment WHERE TweetID = :tweet_id');
        $this->db->bind(':increment', $increment);
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();
    }

    public function isTweetLiked($tweetId, $userId)
    {
        $this->db->query('SELECT * FROM likes WHERE TweetID = :tweet_id AND UserID = :user_id');
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->bind(':user_id', $userId);
        $this->db->execute();

        return $this->db->rowCount() > 0;
    }
}
?>
