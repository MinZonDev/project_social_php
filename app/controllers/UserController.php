<?php
require_once '../app/models/User.php';

class UserController
{
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
            $query = $_GET['query'];
            $userModel = new User();
            $users = $userModel->searchUsers($query);

            $data = [
                'users' => $users
            ];

            // Load view and pass data to it
            require_once '../app/views/user/search_results.php';
        } else {
            // Redirect back to search page with error message
            header('Location: index.php?controller=UserController&action=searchPage&error=query');
            exit;
        }
    }

    public function searchPage()
    {
        // Load the search page view
        require_once '../app/views/user/search.php';
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
//fix loi search
}
?>