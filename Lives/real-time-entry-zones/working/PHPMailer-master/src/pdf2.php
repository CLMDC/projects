<?php
//require_once('../PHPMailer/class.phpmailer.php');
require_once('PHPMailer/src/PHPMailer.php');
$mail = new PHPMailer();
$mail->From      = '';
$mail->FromName  = '';
$mail->Subject   = '';
$MESSAGE_BODY = "Name: ".$name." "."\r\n";
$MESSAGE_BODY .= "Email: ".$email." "."\r\n";
$MESSAGE_BODY .= "Contact No.: ".$cno." "."\r\n";
$MESSAGE_BODY .= "Message: ".$message." "."\r\n";
$mail->Body      = $MESSAGE_BODY;
$mail->AddAddress( '' );

$mail->AddAttachment($_FILES['file']['tmp_name'],
                 $_FILES['file']['name']);

if ($mail->Send())
{   
    echo "Mail Sent";
}
else
{
    echo "Could not send mail";
}
?>