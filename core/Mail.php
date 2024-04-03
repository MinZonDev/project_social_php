<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Mail {
    protected $host;
    protected $username;
    protected $password;
    protected $port;
    protected $encryption;
    protected $fromEmail;
    protected $fromName;

    public function __construct() {
        $config = require_once '../config/mail.php';
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->port = $config['port'];
        $this->encryption = $config['encryption'];
        $this->fromEmail = $config['from_email'];
        $this->fromName = $config['from_name'];
    }

    public function sendVerificationEmail($to, $verificationCode) {
        $transport = (new Swift_SmtpTransport($this->host, $this->port, $this->encryption))
            ->setUsername($this->username)
            ->setPassword($this->password);
        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message('Email Verification'))
            ->setFrom([$this->fromEmail => $this->fromName])
            ->setTo([$to])
            ->setBody('Your verification code is: ' . $verificationCode, 'text/html');
        $result = $mailer->send($message);
        return $result;
    }
}
?>
