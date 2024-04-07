<?php
require_once '../app/models/TweetModel.php';
class HomeController {
    
    public function index() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["tweet_content"]) && !empty($_POST["tweet_content"])) {
                $tweet_model = new TweetModel();
                $tweet_model->create_tweet($_SESSION['user_id'], $_POST["tweet_content"], time(), null, 0, 0);
            }
            header('Location: index.php?controller=HomeController&action=index');
            exit;
        }

        $tweet_model = new TweetModel();
        $tweets = $tweet_model->get_tweets();

        require_once '../app/views/home/index.php';
    }
    
}

?>
