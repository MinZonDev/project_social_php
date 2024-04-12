<?php
require_once '../app/models/Tweet.php';

class TweetController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $content = trim($_POST['content']);

                $tweetModel = new Tweet();
                $tweetModel->addTweet($userId, $content);

                // Redirect or do something else after adding the tweet
                header('Location: index.php?controller=TweetController&action=show');
                exit;
            } else {
                // Handle case when user is not logged in
                // Redirect to login page or show an error message
                echo "Please log in to add a tweet.";
            }
        } else {
            // Handle case when request method is not POST
            // Redirect to an appropriate page or show an error message
            echo "Invalid request method.";
        }
    }

    public function show()
    {
        $tweetModel = new Tweet();
        $tweets = $tweetModel->getAllTweets();

        // Load view and pass tweets data to it
        require_once '../app/views/tweet/index.php';
    }
}
?>
