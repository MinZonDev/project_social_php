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
}
?>