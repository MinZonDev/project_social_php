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

                $imagePath = '';
                if ($_FILES['image']['size'] > 0) {
                    $imagePath = $this->uploadImage($_FILES['image']);
                }

                $tweetModel = new Tweet();
                $tweetModel->addTweetWithImage($userId, $content, $imagePath);

                header('Location: index.php?controller=TweetController&action=show');
                exit;
            } else {
                echo "Please log in to add a tweet.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    private function uploadImage($file)
    {
        $targetDir = "../app/assets/images/"; // Thư mục lưu trữ hình ảnh tải lên
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra xem thư mục lưu trữ hình ảnh đã tồn tại chưa, nếu chưa thì tạo mới
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Kiểm tra xem tệp đã tồn tại chưa
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Kiểm tra kích thước của tệp
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Cho phép chỉ tải lên các loại hình ảnh cụ thể
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Kiểm tra nếu $uploadOk bị thiết lập thành 0 do có lỗi
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // nếu mọi thứ đều ổn, cố gắng tải lên tệp
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($file["name"])) . " has been uploaded.";
                return basename($file["name"]); // Trả về tên của tệp đã tải lên
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    public function show()
    {
        $tweetModel = new Tweet();
        $tweets = $tweetModel->getAllTweets();

        require_once '../app/views/tweet/index.php';
    }

    public function likeTweet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet_id'])) {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $tweetId = $_POST['tweet_id'];

                $tweetModel = new Tweet();
                $tweetModel->likeTweet($tweetId, $userId);
            }
        }
    }

    public function unlikeTweet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet_id'])) {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $tweetId = $_POST['tweet_id'];

                $tweetModel = new Tweet();
                $tweetModel->unlikeTweet($tweetId, $userId);
            }
        }
    }

    public function deleteTweet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet_id'])) {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $tweetId = $_POST['tweet_id'];

                $tweetModel = new Tweet();
                $tweet = $tweetModel->getTweetById($tweetId);

                if ($tweet && $tweet['UserID'] == $userId) {
                    // Kiểm tra xem bài viết có lượt like hay không
                    $likesCount = $tweetModel->getLikesCount($tweetId);
                    if ($likesCount > 0) {
                        // Nếu có lượt like, xóa trước các like của bài viết
                        $tweetModel->deleteLikes($tweetId);
                    }
                    // Tiến hành xóa bài viết
                    $tweetModel->deleteTweet($tweetId);
                }
            }
        }
    }

    public function editTweet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tweet_id'])) {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $tweetId = $_POST['tweet_id'];
                $content = trim($_POST['content']);

                $tweetModel = new Tweet();
                $tweet = $tweetModel->getTweetById($tweetId);

                if ($tweet && $tweet['UserID'] == $userId) {
                    // Tiến hành chỉnh sửa thông tin bài viết
                    $tweetModel->editTweet($tweetId, $content);
                }
            }
        }
    }

}
?>