<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;
$mail->isSMTP();
$mail->Host = 'smtp.qq.com';
$mail->SMTPAuth = true;
$mail->Username = 'smtp-mail.outlook.com';
$mail->Password = 'gjtdsrmm888';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('tacer@outlook.com', 'wuan');
$mail->addAddress('2693192761@qq.com', 'user');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->isHTML(false);


$mail->Subject = 'reset password';
$mail->Body    = '请点击以下连接进行重置密码操作：';
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}