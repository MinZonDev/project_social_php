<?php
require_once '../app/models/User.php';

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
        $data = [
            'username' => $currentUser['Username'],
            'email' => $currentUser['Email'],
            'avatar' => $currentUser['Avatar'],
            'bio' => $currentUser['Bio'],
            'location' => $currentUser['Location'],
            'website' => $currentUser['Website'],
            'datejoined' => $currentUser['DateJoined']
        ];

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

}
?>