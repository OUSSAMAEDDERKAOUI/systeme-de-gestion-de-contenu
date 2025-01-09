<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../vendor/autoload.php';

if (!class_exists('Mailing')) {
    class Mailing
    {
        private string $username;
        private string $usermail;
        private string $subject;
        private string $body;

        public function __construct(string $username, string $usermail, string $subject, string $body)
        {
            $this->username = $username;
            $this->usermail = $usermail;
            $this->subject = $subject;
            $this->body = $body;
        }

        public function sendMail(): bool
        {
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "edderkaouioussama@gmail.com";
                $mail->Password ="npuq amnf vqll haxt";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->SMTPDebug = 0; 

                // Recipients
                $mail->setFrom($mail->Username, 'CultureConnect');
                $mail->addAddress($this->usermail, $this->username);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $this->subject;
                $mail->Body = $this->body;

                $mail->send();
                return true;
            } catch (Exception $e) {
                error_log("Error sending email: " . $e->getMessage());
                return false;
            }
        }
    }
}