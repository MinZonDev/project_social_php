<?php
require_once '../core/Database.php';

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (Username, Email, Password, verification_code) VALUES (:username, :email, :password, :verification_code)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':verification_code', $data['verification_code']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row['Password'];
            if (password_verify($password, $hashed_password)) {
                // Password is correct
                return true;
            } else {
                // Password is incorrect
                return false;
            }
        } else {
            // User not found
            return false;
        }
    }

    public function usernameExists($username)
    {
        $this->db->query('SELECT * FROM users WHERE Username = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function emailExists($email)
    {
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function verifyUser($verificationCode)
    {
        $this->db->query('UPDATE users SET verification_status = 1 WHERE verification_code = :verification_code');
        $this->db->bind(':verification_code', $verificationCode);
        $this->db->execute();

        return $this->db->rowCount() > 0;
    }

    public function getUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getUserById($userId)
    {
        $this->db->query('SELECT * FROM users WHERE UserID = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    public function getUserByUsername($username)
{
    $this->db->query('SELECT * FROM users WHERE Username = :username');
    $this->db->bind(':username', $username);
    $user = $this->db->single();
    return $user; // Trả về dữ liệu người dùng hoặc null nếu không tìm thấy
}

    public function updateInfo($data)
    {
        $this->db->query('UPDATE users SET  Email = :email, Bio = :bio, Location = :location, Website = :website, Avatar = :avatar WHERE UserID = :user_id');
        
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':avatar', $data['avatar']); // Thêm bind dữ liệu cho cột Avatar
        $this->db->bind(':user_id', $data['user_id']);

        return $this->db->execute();
    }

    public function searchUsers($query)
    {
        $this->db->query('SELECT * FROM users WHERE Username LIKE :query');
        $this->db->bind(':query', "%$query%");
        return $this->db->resultSet();
    }
    public function follow($followerID, $followingID)
    {
        $this->db->query('INSERT INTO followers (FollowerID, FollowingID) VALUES (:followerID, :followingID)');
        $this->db->bind(':followerID', $followerID);
        $this->db->bind(':followingID', $followingID);
        return $this->db->execute();
    }

    public function unfollow($followerID, $followingID)
    {
        $this->db->query('DELETE FROM followers WHERE FollowerID = :followerID AND FollowingID = :followingID');
        $this->db->bind(':followerID', $followerID);
        $this->db->bind(':followingID', $followingID);
        return $this->db->execute();
    }

    public function countFollowers($userID)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM followers WHERE FollowingID = :userID');
        $this->db->bind(':userID', $userID);
        $row = $this->db->single();
        return $row['count'];
    }

    public function countFollowing($userID)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM followers WHERE FollowerID = :userID');
        $this->db->bind(':userID', $userID);
        $row = $this->db->single();
        return $row['count'];
    }

    public function isFollowing($followerID, $followingID)
    {
        $this->db->query('SELECT * FROM followers WHERE FollowerID = :followerID AND FollowingID = :followingID');
        $this->db->bind(':followerID', $followerID);
        $this->db->bind(':followingID', $followingID);
        $this->db->execute();

        return $this->db->rowCount() > 0;
    }

    public function followUser($followerId, $followingId)
    {
        try {
            // Check if the follow relationship already exists
            $this->db->query('SELECT * FROM followers WHERE FollowerID = :follower_id AND FollowingID = :following_id');
            $this->db->bind(':follower_id', $followerId);
            $this->db->bind(':following_id', $followingId);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                // Follow relationship already exists, return false
                return false;
            }

            // If the follow relationship does not exist, insert it into the database
            $this->db->query('INSERT INTO followers (FollowerID, FollowingID) VALUES (:follower_id, :following_id)');
            $this->db->bind(':follower_id', $followerId);
            $this->db->bind(':following_id', $followingId);
            $this->db->execute();

            return true; // Follow operation successful
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Follow operation failed: " . $e->getMessage();
            return false;
        }
    }

    public function unfollowUser($followerId, $followingId)
    {
        try {
            // Delete the follow relationship from the database
            $this->db->query('DELETE FROM followers WHERE FollowerID = :follower_id AND FollowingID = :following_id');
            $this->db->bind(':follower_id', $followerId);
            $this->db->bind(':following_id', $followingId);
            $this->db->execute();

            return true; // Unfollow operation successful
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Unfollow operation failed: " . $e->getMessage();
            return false;
        }
    }


}
?>