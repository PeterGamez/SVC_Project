<?php

namespace App\Class;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    public static function sendMail(string $email, string $subject, string $body): bool
    {
        require_once './vendor/phpmailer/phpmailer/src/PHPMailer.php';
        // require_once './vendor/phpmailer/phpmailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            /* Server settings */
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = config('mail.host');
            $mail->SMTPAuth = true;
            $mail->Username = config('mail.username');
            $mail->Password = config('mail.password');
            $mail->SMTPAutoTLS = config('mail.tls');
            $mail->SMTPSecure = config('mail.secure');
            $mail->Port = config('mail.port');

            /* Recipients */
            $mail->setFrom(config('mail.username'), config('site.name'));
            $mail->addAddress($email);

            /* Content */
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (\Exception $e) {
            // echo $e;
            return false;
        }
    }

    public static function verifypage($link)
    {
        return '<html><head><style>td{padding-top:10px}</style></head><body><table cellspacing="0" cellpadding="0" style="width:100%"><tr><td>To verify your email, please click on the link below.</td></tr><tr><td><a href="' . $link . '" target="_blank">Verify your email</a></td></tr><tr><td>This link will expire in 1 hours.</td></tr></table></body></html>';
    }
}
