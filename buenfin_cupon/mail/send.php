<?php
/**
* Envia Email via SMTP
*/
function send($address){
	//error_reporting(E_STRICT); //Debug
	date_default_timezone_set('America/Mexico_City');

	require_once('class/class.phpmailer.php');

	$mail = new PHPMailer;

	$mail->isSMTP();
	/* Gmail */
	/*
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->Username = 'send@clicker360.com';        
	$mail->Password = 'pruebas360';
	*/ 

	/* SMTP */
	$mail->SMTPAuth = true;
	$mail->Host = 'mail.interlingua.com.mx';
	$mail->Port = 587;
	$mail->Username = 'contacto@interlingua.com.mx';        
	$mail->Password = '1nt3rl1ngu4';                            

	$mail->SetFrom('contacto@interlingua.com.mx', 'INTERLINGUA');

	$mail->addAddress($address);

	$mail->WordWrap = 50;

	$mail->isHTML(true);

	$body = file_get_contents('templates/plantilla.html');

	$mail->Subject = 'Imprime tu cupón y obtén un mes gratis';
	$mail->Body = $body;

	if ($mail->send()) {
	    header("Location: gracias.php");
	} else {
	    //header("Location: index.php?error=true&ErrorInf=" . $mail->ErrorInf);
	    //echo "Mailer Error: " . $mail->ErrorInfo;
	    header("Location: index.php");
	}
}