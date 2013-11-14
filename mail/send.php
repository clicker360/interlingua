<?php
error_reporting(E_STRICT);
date_default_timezone_set('America/Mexico_City');

require_once('class/class.phpmailer.php');

$mail = new PHPMailer;
$mail->SMTPDebug = 2;

$mail->isSMTP();
/* Gmail */
/*$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->Username = 'send@clicker360.com';        
$mail->Password = 'pruebas360';*/

$mail->SMTPAuth = true;
$mail->Host = 'smtp.1and1.mx';
$mail->Port = 25;
$mail->Username = 'test@vaporic.net';      
$mail->Password = 'huo0lpaw';

$mail->SetFrom('send@clicker360.com', 'INTERLINGUA');

$mail->addAddress('vaporic@gmail.com');

$mail->WordWrap = 50;

$mail->isHTML(true);

$body = file_get_contents('templates/plantilla.html');

$mail->Subject = 'Correo de prueba';
$mail->Body = $body;

if ($mail->send()) {
    header("Location: gracias.php");
} else {
    //header("Location: index.php?error=true&ErrorInf=" . $mail->ErrorInf);
    echo "Mailer Error: " . $mail->ErrorInfo;
}