<html>
<?php
error_reporting(E_ALL);

require("class/class.phpmailer.php");

$mail = new PHPMailer();
$mail->Host = "email.interlingua.com.mx";
$mail->Port = 465;
$mail->SetFrom("root@interlingua.com.mx", "Interlingua");
//$mail->AddAddress("mmartino.soft@gmail.com", "Maria");
$mail->AddAddress("hramirez@interlingua.com.mx");
$mail->Subject = "Esta es una prueba";
$mail->Body = "Hola. Esto es una prueba desde php 189.212.132.171";

if (!$mail->Send()) {
   echo "Mail error:" . $mail->ErrorInfo;
} else {
   echo "Enviado!";
}

?>
</html>
