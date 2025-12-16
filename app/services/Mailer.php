<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once ROOT_PATH . 'app/libs/PHPMailer/Exception.php';
require_once ROOT_PATH . 'app/libs/PHPMailer/PHPMailer.php';
require_once ROOT_PATH . 'app/libs/PHPMailer/SMTP.php';

class Mailer
{
    public static function sendOtp(string $toEmail, string $otp): bool
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP config (Gmail)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nikhilrathod5242@gmail.com';  
            $mail->Password   = 'drdejywvxdhxvzsv';        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Email
            $mail->setFrom('nikhilrathod5242@gmail.com', 'Xstream Play');
            $mail->addAddress($toEmail);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for Xstream Play';
            $mail->Body    = "
                <h2>Your OTP</h2>
                <p><strong>$otp</strong></p>
                <p>This OTP is valid for 5 minutes.</p>
            ";

            return $mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}
