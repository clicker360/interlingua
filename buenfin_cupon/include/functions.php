<?php 
/**
 * @author  Hugo Espinosa
 * @version 11/11/2013 
 */
include 'conexion.php';
extract($_REQUEST);

if(isset($action)){
	switch($action)
	{
		case "send_email":
			send_email();
			break;
	}
}

/**
 * @method get_include_contents()
 */
function get_include_contents($filename, $variablesToMakeLocal) {
    extract($variablesToMakeLocal);
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}

/**
 * @method send_email()
 */
function send_email(){
	$conexion=conexion::singleton();
	extract($_REQUEST);
	$response = array();
	$error = FALSE;
	
	// Update User Origin 8
	$fields = array("origin_id", "assignation_date"); 
    $values = array("8",date("Y-m-d H:i:s")); 
    $conexion->update("prospects", $fields, $values, "WHERE id='".$idU."'");

    // Send Mail
	/*date_default_timezone_set('America/Mexico_City');
	require_once('../mail/class/class.phpmailer.php');
	$mail = new PHPMailer;
	$mail->isSMTP();*/

	/* SMTP */
	/* Gmail */
	/*$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->Username = 'send@clicker360.com';        
	$mail->Password = 'pruebas360';*/

	/*$mail->SMTPAuth = true;
	$mail->Host = 'mail.interlingua.com.mx';
	$mail->Port = 587;
	$mail->Username = 'contacto@interlingua.com.mx';        
	$mail->Password = '1nt3rl1ngu4';                      

	$mail->SetFrom('contacto@interlingua.com.mx', 'INTERLINGUA');

	$mail->addAddress($emailU);

	$mail->WordWrap = 50;

	$mail->isHTML(true);

	//$body = file_get_contents('../mail/templates/plantilla.php?name=hugo');
	$data = array('nombre' => $nameU);
	$body = get_include_contents('../mail/templates/plantilla.php', $data);

	$mail->Subject = 'Imprime tu cupon';
	$mail->Body = $body;

	if ($mail->send()) {
	    //header("Location: gracias.php");
	    $error = FALSE;
	} else {
		$error = TRUE;
	    //header("Location: index.php?error=true&ErrorInf=" . $mail->ErrorInf);
	    echo "Mailer Error: " . $mail->ErrorInfo;
	    //header("Location: index.php");
	}*/
	$header  = "From: INTERLINGUA <contacto@interlingua.com.mx> \r\n";
        $header .= "X-Mailer: PHP/".phpversion()." \r\n";
        $header .= "Mime-Version: 1.0 \r\n";
        $header .= "Content-type: text/html\r\n";
	 
	$data = array('nombre' => $nameU);
        $mensaje = get_include_contents('../mail/templates/plantilla.php', $data);

        $para = $emailU;
        $asunto = 'Imprime tu cupón';	

        mail($para, $asunto, utf8_decode($mensaje), $header);

	$response["error"] = $error;
	echo json_encode($response);
}