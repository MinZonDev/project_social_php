<?php
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
                'verification_code' => md5(uniqid(rand(), true))
            ];

            if ($this->userModel->register($data)) {
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
                // Login successful
                // Redirect user to dashboard
                echo "Login successful. Redirecting to dashboard...";
            } else {
                // Login failed
                echo "Invalid email or password.";
            }
        } else {
            // Display login form
            require_once '../app/views/auth/login.php';
        }
    }
}
?>
