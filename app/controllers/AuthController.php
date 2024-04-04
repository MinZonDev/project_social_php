<?php
session_start();

require_once '../core/Mail.php';
require_once '../app/models/User.php';

class AuthController {
    protected $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'verification_code' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) // Tạo mã xác minh 6 số
            ];
    
            if ($this->userModel->usernameExists($data['username'])) {
                echo "Username already exists.";
            } elseif ($this->userModel->emailExists($data['email'])) {
                echo "Email already exists.";
            } elseif ($this->userModel->register($data)) {
                // Send verification email
                $to = $data['email'];
                $verificationCode = $data['verification_code'];
                $mail = new Mail();
                $result = $mail->sendVerificationEmail($to, $verificationCode);
                if ($result) {
                    // Email sent successfully
                    echo "Verification email sent successfully. Please check your email.";
                } else {
                    echo "Failed to send verification email. Please try again later.";
                }
            } else {
                echo "Failed to register user.";
            }
        } else {
            // Display registration form
            require_once '../app/views/auth/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
    
            if ($this->userModel->login($email, $password)) {
                // Check verification status
                $user = $this->userModel->getUserByEmail($email);
                if ($user['verification_status'] == 1) {
                    // Set session and redirect to index.php
                    $_SESSION['user_id'] = $user['id'];
                    header('Location: index.php?controller=HomeController&action=index');
                    exit;
                } else {
                    // Account not verified, redirect to verify page
                    header('Location: index.php?controller=AuthController&action=verify');
                    exit;
                }
            } else {
                // Login failed
                echo "Invalid email or password.";
            }
        } else {
            // Display login form
            require_once '../app/views/auth/login.php';
        }
    }
    
    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $verificationCode = $_POST['verification_code'];
            
            // Verify the user using verification code
            if ($this->userModel->verifyUser($verificationCode)) {
                // Set verification status and redirect to index.php
                $_SESSION['verification_status'] = 1;
                header('Location: index.php?controller=HomeController&action=index');
                exit;
            } else {
                echo "Verification failed. Invalid verification code.";
            }
        } else {
            // Display the verification form
            require_once '../app/views/auth/verify.php';
        }
    }
    public function logout() {
        // Unset all session variables
        $_SESSION = [];

        // Destroy the session
        session_destroy();

        // Redirect to login page after logout
        header('Location: index.php?controller=AuthController&action=login');
        exit;
    }
}
?>
