<?php
require_once '../core/Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
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

    public function login($email, $password) {
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

    public function usernameExists($username) {
        $this->db->query('SELECT * FROM users WHERE Username = :username');
        $this->db->bind(':username', $username);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
    
    public function emailExists($email) {
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    public function verifyUser($verificationCode) {
        $this->db->query('UPDATE users SET verification_status = 1 WHERE verification_code = :verification_code');
        $this->db->bind(':verification_code', $verificationCode);
        $this->db->execute();
        
        return $this->db->rowCount() > 0;
    }

    public function getUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE Email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getUserById($userId) {
        $this->db->query('SELECT * FROM users WHERE UserID = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }
    public function updateInfo($data) {
        $this->db->query('UPDATE users SET Username = :username, Email = :email, Bio = :bio, Location = :location, Website = :website WHERE UserID = :user_id');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':location', $data['location']);
        $this->db->bind(':website', $data['website']);
        $this->db->bind(':user_id', $data['user_id']);
    
        return $this->db->execute();
    }
    
}
?>
