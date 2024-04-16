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
    public function getTweets()
    {
        $this->db->query('SELECT tweets.*, users.Username, users.Avatar FROM tweets JOIN users ON tweets.UserID = users.UserID ORDER BY tweets.Timestamp DESC');
        return $this->db->resultSet();
    }
    public function getTweetById($tweetId)
    {
        $this->db->query('SELECT * FROM tweets WHERE TweetID = :tweet_id');
        $this->db->bind(':tweet_id', $tweetId);
        return $this->db->single();
    }

    public function getTweetsByUserId($userId)
    {
        $this->db->query('SELECT tweets.*, users.Username, users.Avatar 
                          FROM tweets 
                          JOIN users ON tweets.UserID = users.UserID 
                          WHERE tweets.UserID = :user_id 
                          ORDER BY tweets.Timestamp DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    public function deleteTweet($tweetId)
    {
        // Kiểm tra xem bài viết có lượt like hay không
        $likeCount = $this->getLikesCount($tweetId);
        if ($likeCount > 0) {
            // Nếu có lượt like, không thực hiện xóa và trả về false để thông báo cho người dùng
            return false;
        }

        // Nếu không có lượt like, tiến hành xóa bài viết
        $this->deleteLikes($tweetId); // Xóa tất cả các like liên quan đến bài viết
        $this->db->query('DELETE FROM tweets WHERE TweetID = :tweet_id');
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();

        // Trả về true để thông báo cho người dùng rằng bài viết đã được xóa thành công
        return true;
    }


    public function editTweet($tweetId, $content)
    {
        $this->db->query('UPDATE tweets SET Content = :content WHERE TweetID = :tweet_id');
        $this->db->bind(':content', $content);
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();
    }
    public function getLikesCount($tweetId)
    {
        $this->db->query('SELECT COUNT(*) as likes_count FROM likes WHERE TweetID = :tweet_id');
        $this->db->bind(':tweet_id', $tweetId);
        $row = $this->db->single();
        return $row ? $row['likes_count'] : 0;
    }

    public function deleteLikes($tweetId)
    {
        $this->db->query('DELETE FROM likes WHERE TweetID = :tweet_id');
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->execute();
    }

    public function addComment($userId, $tweetId, $content)
    {
        $this->db->query('INSERT INTO comments (UserID, TweetID, Content) VALUES (:user_id, :tweet_id, :content)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':tweet_id', $tweetId);
        $this->db->bind(':content', $content);
        $this->db->execute();
    }

    public function getCommentsByTweetId($tweetId)
    {
        $this->db->query('SELECT * FROM comments WHERE TweetID = :tweet_id');
        $this->db->bind(':tweet_id', $tweetId);
        return $this->db->resultSet();
    }
    public function getCommentById($commentId)
    {
        // Assuming you have a method in your Tweet model to retrieve a comment by its ID
        $tweetModel = new Tweet();
        $comment = $tweetModel->getCommentById($commentId);

        // Do something with the retrieved comment, like returning it or rendering a view
        return $comment;
    }


    public function deleteComment($commentId)
    {
        $this->db->query('DELETE FROM comments WHERE CommentID = :comment_id');
        $this->db->bind(':comment_id', $commentId);
        $this->db->execute();
    }
    public function getCommentsWithUserInfoByTweetId($tweetId)
    {
        $this->db->query('SELECT comments.*, users.Username, users.Avatar 
                      FROM comments 
                      JOIN users ON comments.UserID = users.UserID 
                      WHERE comments.TweetID = :tweet_id 
                      ORDER BY comments.Timestamp ASC');
        $this->db->bind(':tweet_id', $tweetId);
        return $this->db->resultSet();
    }


}
?>