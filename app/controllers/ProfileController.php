<?php
require_once '../app/models/User.php';

class ProfileController
{
    public function show()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Tạo một đối tượng User để truy xuất thông tin của người dùng hiện tại
        $userModel = new User();
        // Trong ProfileController
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

        // Load view cho trang Profile và truyền dữ liệu của người dùng hiện tại vào view
        require_once '../app/views/profile/index.php';
    }

    public function edit()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Tạo một đối tượng User để truy xuất thông tin của người dùng hiện tại
        $userModel = new User();
        $currentUser = $userModel->getUserById($_SESSION['user_id']);

        // Truyền dữ liệu của người dùng hiện tại vào view
        $data = [
            'username' => $currentUser['Username'],
            'email' => $currentUser['Email'],
            'avatar' => $currentUser['Avatar'],
            'bio' => $currentUser['Bio'],
            'location' => $currentUser['Location'],
            'website' => $currentUser['Website'],
            'datejoined' => $currentUser['DateJoined']
        ];

        // Load view cho trang sửa thông tin người dùng và truyền dữ liệu của người dùng hiện tại vào view
        require_once '../app/views/profile/edit.php';
    }


    public function update()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: index.php?controller=AuthController&action=login');
            exit;
        }

        // Xử lý cập nhật thông tin người dùng sau khi submit form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $userData = [
                'user_id' => $_SESSION['user_id'],
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'bio' => trim($_POST['bio']),
                'location' => trim($_POST['location']),
                'website' => trim($_POST['website'])
            ];

            // Gọi hàm updateInfo trong UserModel để cập nhật thông tin người dùng
            $userModel = new User();
            if ($userModel->updateInfo($userData)) {
                // Nếu cập nhật thành công, chuyển hướng về trang Profile
                header('Location: index.php?controller=ProfileController&action=show');
                exit;
            } else {
                // Nếu cập nhật thất bại, hiển thị thông báo lỗi
                echo "Cập nhật thông tin thất bại.";
            }
        }
    }
}
?>