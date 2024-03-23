<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require  dirname(__DIR__) . '/vendor/phpmailer/src/PHPMailer.php';
require  dirname(__DIR__) . '/vendor/phpmailer/src/Exception.php';
require  dirname(__DIR__) . '/vendor/phpmailer/src/SMTP.php';
class Mail
{

    public static function sendMail($sender, $receiver, $subject,$body)
    {
        // Tạo một đối tượng PHPMailer
        $mail = new PHPMailer;

        try {
            // Cấu hình thông tin mail server
            $mail->isSMTP();
            $mail->SMTPAutoTLS = false; //Thêm dòng này
            $mail->SMTPSecure = false; //Thêm dòng này
            $mail->SMTPSecure = ''; //Thêm dòng này
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Thêm dòng này
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'andinhtran123@gmail.com';
            $mail->Password = 'wcny yego yggk fwvy';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Thiết lập thông tin người gửi và người nhận
            $mail->setFrom($sender, 'japan temp');
            $mail->addAddress($receiver);

            // Thiết lập nội dung email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Gửi email
            $mail->send();
            Dialog::show("Gửi email thành công");
        } catch (Exception $e) {
            echo 'Gửi email thất bại: ', $mail->ErrorInfo;
        }
    }
}
