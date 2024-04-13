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

                // Xử lý tải lên hình ảnh
                $imagePath = '';
                if ($_FILES['image']['size'] > 0) {
                    $imagePath = $this->uploadImage($_FILES['image']);
                }

                $tweetModel = new Tweet();
                $tweetModel->addTweetWithImage($userId, $content, $imagePath);

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

        // Load view and pass tweets data to it
        require_once '../app/views/tweet/index.php';
    }
}
?>