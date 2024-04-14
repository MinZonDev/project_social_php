<?php
require_once '../app/models/User.php';
require_once '../app/models/Tweet.php';
class ProfileController
{
    public function show()
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        $userModel = new User();
        $currentUser = $userModel->getUserById($_SESSION['user_id']);
        $tweetModel = new Tweet();

        // Lấy thông tin người dùng hiện tại
        $data = [
            'username' => $currentUser['Username'],
            'email' => $currentUser['Email'],
            'avatar' => $currentUser['Avatar'],
            'bio' => $currentUser['Bio'],
            'location' => $currentUser['Location'],
            'website' => $currentUser['Website'],
            'datejoined' => $currentUser['DateJoined']
        ];

        // Lấy danh sách bài viết của người dùng hiện tại
        $tweets = $tweetModel->getTweetsByUserId($_SESSION['user_id']);

        // Thêm danh sách bài viết vào dữ liệu
        $data['tweets'] = $tweets;

        // Load view và truyền dữ liệu vào đó
        require_once '../app/views/profile/index.php';
    }


    public function edit()
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        $userModel = new User();
        $currentUser = $userModel->getUserById($_SESSION['user_id']);
        $data = [
            'username' => $currentUser['Username'],
            'email' => $currentUser['Email'],
            'avatar' => $currentUser['Avatar'],
            'bio' => $currentUser['Bio'],
            'location' => $currentUser['Location'],
            'website' => $currentUser['Website'],
            'datejoined' => $currentUser['DateJoined']
        ];

        require_once '../app/views/profile/edit.php';
    }

    public function update()
    {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = new User();

            $userData = [
                'user_id' => $_SESSION['user_id'],
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'bio' => trim($_POST['bio']),
                'location' => trim($_POST['location']),
                'website' => trim($_POST['website']),
            ];

            // Xử lý upload hình ảnh mới
            if ($_FILES['avatar']['name']) {
                $avatarName = $_FILES['avatar']['name'];
                $avatarTmpName = $_FILES['avatar']['tmp_name'];
                $avatarSize = $_FILES['avatar']['size'];
                $avatarError = $_FILES['avatar']['error'];

                if ($avatarError === 0) {
                    $avatarDestination = '../app/assets/images/' . $avatarName;
                    move_uploaded_file($avatarTmpName, $avatarDestination);
                    $userData['avatar'] = $avatarName; // Thêm dòng này để gán tên file vào userData
                } else {
                    echo "Upload hình ảnh thất bại.";
                    exit;
                }
            }

            if ($userModel->updateInfo($userData)) {
                header('Location: index.php?controller=ProfileController&action=show');
                exit;
            } else {
                echo "Cập nhật thông tin thất bại.";
            }
        }
    }

    public function showByUsername($username)
    {
        $userModel = new User();
        $user = $userModel->getUserByUsername($username);

        if ($user) {
            // Kiểm tra nếu người dùng đang truy cập trang profile của chính họ
            $isCurrentUser = isset($_SESSION['username']) && $user['Username'] === $_SESSION['username'];

            // Lấy danh sách bài viết của người dùng
            $tweetModel = new Tweet();
            $tweets = $tweetModel->getTweetsByUserId($user['UserID']);

            // Kiểm tra xem người dùng hiện tại đã follow người dùng được truy cập hay không
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $isFollowing = $user_id ? $userModel->isFollowing($user_id, $user['UserID']) : false;

            // Lấy số lượng người đang theo dõi và đã theo dõi
            $followersCount = $userModel->countFollowers($user['UserID']);
            $followingCount = $userModel->countFollowing($user['UserID']);

            $data = [
                'username' => $user['Username'],
                'email' => $user['Email'],
                'avatar' => $user['Avatar'],
                'bio' => $user['Bio'],
                'location' => $user['Location'],
                'website' => $user['Website'],
                'datejoined' => $user['DateJoined'],
                'is_current_user' => $isCurrentUser,
                'tweets' => $tweets,
                'is_following' => $isFollowing,
                'followers_count' => $followersCount,
                'following_count' => $followingCount
            ];

            // Load view and pass data to it
            require_once '../app/views/profile/index.php';
        } else {
            // Xử lý trường hợp không tìm thấy người dùng
            echo "User not found";
        }
    }

    public function follow($userId)
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if user is not logged in
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Assuming you have a method in your User model to add a follow relationship
        $userModel = new User();
        $result = $userModel->followUser($_SESSION['user_id'], $userId);

        // Check if follow operation was successful
        if ($result) {
            // Redirect back to the user profile page or wherever appropriate
            header("Location: index.php?controller=ProfileController&action=showByUsername&username={$_SESSION['username']}");
            exit;
        } else {
            // Handle error if follow operation failed
            echo "Failed to follow user.";
        }
    }

    public function unfollow($userId)
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if user is not logged in
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Assuming you have a method in your User model to remove a follow relationship
        $userModel = new User();
        $result = $userModel->unfollowUser($_SESSION['user_id'], $userId);

        // Check if unfollow operation was successful
        if ($result) {
            // Redirect back to the user profile page or wherever appropriate
            header("Location: index.php?controller=ProfileController&action=showByUsername&username={$_SESSION['username']}");
            exit;
        } else {
            // Handle error if unfollow operation failed
            echo "Failed to unfollow user.";
        }
    }





}
?>