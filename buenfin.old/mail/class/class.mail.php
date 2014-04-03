<?php

/***************************************************************************************
*
* @FileName	class.mail.php
* @Author	Héctor Iván Perales Jasso <hector.perales@futurite.com>
* @CopyRights	Futurite <http://www.futurite.com>
* @DateCreated	Jul 10 2012
*
***************************************************************************************/
	require_once("class.phpmailer.php");


/******************************************************
* class futuriteMail extends PHPMailer
* futuriteMail($mailSubject)
* 	@$mailSubject: Asunto del correo
* 	@$path: Ruta para acceder al logotipo(opcional)
******************************************************/
class futuriteMail extends PHPMailer
{
	function futuriteMail($mailSubject, $path = ""){
		$this->mailSubject = $mailSubject;
		$this->path = $path;
		$this->mailContent = "";
		
		$this->theAttachments = array();
		$this->hasAttachments = false;
		
		$this->hasFileAttachments = false;
	}

	/*
	* Función que genera el encabezado
	*/
	function getHeader(){
		$result  = ('<table style="line-height:100%; border:5px solid #F5F5F5; width:600px; margin-top:0; margin-bottom:0;" cellspacing="0" cellpadding="0">');
		$result .= ('<tr style="height:30px; color:black; background-color:#C4C9D2; font-family:arial; font-size:12pt;">');
		$result .= ('<td>');
		$result .= ('<br/><p align="center" style="line-height:100%;">');
		$result .= ('<strong>:: Diga Comunicación, S.A. de C.V. ::</strong></p>');
		//$result .= ('<div style="background-color: #063186; height:5px;"></div>');
		//$result .= ('<div style="background-color:#FF0000; height:5px;"></div><br/>');
		//$result .= ('<p align="center" style="line-height:100%;"><strong>Asunto: </strong>' . $this->mailSubject);
		//$result .= ('</p>');
		$result .= ('</td>');
		$result .= ('</tr>');
		$result .= ('<tr>');
		$result .= ('<td style="color:#777;font-family:tahoma;font-size:13px; padding:5px">');
		$result .= ('<p style="line-height:100%; margin-top:0; margin-bottom:0;text-align:justify">');
		return $result;
	}

	/*
	* Función que genera el pie de correo
	*/
	function getFooter(){
		$result  = ('</p>');
		$result .= ('</td>');
		$result .= ('</tr>');
		$result .= ('<tr>');
		$result .= ('<td style="border-top:1px solid #DDD">');
		$result .= ('&nbsp;');
		$result .= ('</td>');
		$result .= ('</tr>');
		$result .= ('<tr>');
		$result .= ('<td style="color:#AAA;font-family:tahoma;font-size:9pt;">');
		$result .= ('<p style="text-align: justify;style="line-height:100%;">');
		$result .= ('El contenido de éste mensaje es confidencial y dirigido exclusivamente al destinatario
				del mismo. Por lo tanto no debe ser re-enviado y/o re-transmitido por ningún medio
				sin la autorización del Autor original del mismo. Si usted no es el destinatario,
				no tiene ninguna autorización para usar el mensaje total o parcialmente para
				ningún propósito.
				<br/><br/>');
		$result .= ('</p>');
		$result .= ('</td>');
		$result .= ('</tr>');
		$result .= ('</table>');
		
		return $result;
	}

	/*
	* Función que recibe el nombre y correo del destinatario
	*/
	function setReceiver($receiverName, $receiverEmail){
		$this->receiverName = $receiverName;
		$this->receiverEmail = $receiverEmail;
	}
	
	function setReceiverArray($receiversArray){
		/*Debe recibir los correos en una matriz cumpliendo este formato:
			$matriz[N][nombre]
			$matriz[N][correo]
		*/
		$this->receiversArray = $receiversArray;
	}
	
	function setReceiverCCArray($receiversCCArray){
		/*Debe recibir los correos en una matriz cumpliendo este formato:
			$matriz[N][nombre]
			$matriz[N][correo]
		*/
		$this->receiversCCArray = $receiversCCArray;
	}
	
	function setReceiverBCCArray($receiversBCCArray){
		/*Debe recibir los correos en una matriz cumpliendo este formato:
			$matriz[N][nombre]
			$matriz[N][correo]
		*/
		$this->receiversBCCArray = $receiversBCCArray;
	}

	/*
	* Función que recibe el cuerpo del mensaje
	*/
	function processContent($body = ""){
		$this->mailContent = $body;
	}

	/*
	* Función que recibe un archivo adjunto
	*/
	function inserFiletAttachment($path, $fileName){
		$this->hasFileAttachments = true;
		$this->theFileAttachments[$fileName] = $path;
	}

	/*
	* Función que envía el mensaje
	*/
	function sendMail(){
		//$mailDomain = breakText($this->receiverEmail, 1, "@");
	//	$mailDomain = explode("@", $this->receiverEmail);

	//	if($mailDomain[1] != "futurite.com"){
	//		$this->receiverEmail = "hector.perales@metodika.mx";
	//	}
		$mail = new PHPMailer();
		//$mail->SetLanguage("en", "includes/toolsPHP/phpmailer/language/");
		$mail->CharSet = "utf-8";
		$mail->From = $this->getMainMailInfo('senderEmail');
		$mail->FromName = $this->getMainMailInfo('senderName');
		$mail->Host = $this->getMainMailInfo('host');
		$mail->isSendMail();//<== Necesario para que funcione en 1and1
		//$mail->SMTPDebug = true;
	//	$mail->SMTPSecure = "ssl";
		$mail->SMTPAuth = $this->getMainMailInfo('SMTPAuth');
		$mail->Username = $this->getMainMailInfo('user');
		$mail->Password = $this->getMainMailInfo('password');
		$mail->Mailer = "smtp";
		
		$mail->Port = $this->getMainMailInfo('port');
		$mail->IsHTML(true);
		$mail->Subject = $this->mailSubject;
		$mail->Body = $this->getHeader() . $this->mailContent . $this->getFooter();
		
		if(isset($this->receiversArray) && is_array($this->receiversArray) && count($this->receiversArray) > 0){
			foreach($this->receiversArray as $posDestinatario => $rowDestinatario){
				if($rowDestinatario['correo'] != ""){
					$mail->AddAddress($rowDestinatario['correo'], $rowDestinatario['nombre']);
				}
			}
		}
		//else{
		//	$mail->AddAddress($this->receiverEmail, $this->receiverName);
		//}
		
		//Se agregan los destinarios con copia
		if(isset($this->receiversCCArray) && is_array($this->receiversCCArray) && count($this->receiversCCArray) > 0){
			foreach($this->receiversCCArray as $posDestinatario => $rowDestinatario){
				if($rowDestinatario['correo'] != ""){
					$mail->AddCC($rowDestinatario['correo'], $rowDestinatario['nombre']);
				}
			}
		}
		
		//Se agregan los destinatarios con copia oculta
		if(isset($this->receiversBCCArray) && is_array($this->receiversBCCArray) && count($this->receiversBCCArray) > 0){
			foreach($this->receiversBCCArray as $posDestinatario => $rowDestinatario){
				if($rowDestinatario['correo'] != ""){
					$mail->AddBCC($rowDestinatario['correo'], $rowDestinatario['nombre']);
				}
			}
		}
		$mail->AddBCC("ivantech.net@gmail.com","ivantech.net@gmail.com");
		//$mail->AddBCC("hector.gomez@metodika.mx","hector.gomez@metodika.mx");
		$mail->AddEmbeddedImage($this->path . "img/ppt/logo-diga.png", "logo", "firmaCorreos.jpg");
		
		if($this->hasFileAttachments){
			foreach($this->theFileAttachments as $fileName => $path){
				$mail->AddAttachment($path, $fileName, 'base64');
			}
		}
		
		if(!$mail->Send()){
			//return $this->receiverName . "( " . $this->receiverEmail . " ) " . $mail->ErrorInfo;
			return $mail->ErrorInfo;
		}
		else{
			$mail->ClearAddresses();
			$mail->ClearAttachments();
			return "success";
		}
	}

/*
* Función para la configuración del servidor SMTP
*/
	function getMainMailInfo($data = ""){
		/* //Datos gmail
		if(!defined("_HOST"))
			define("_HOST"		,"smtp.gmail.com");
		if(!defined("_PORT"))
			define("_PORT"		,"465");
		if(!defined("_USER"))
			define("_USER"		,"testing.futurite@gmail.com");
		if(!defined("_PASS"))
			define("_PASS"		,"delunoalsiete");
		*/
		//Datos 1and1.com
		if(!defined("_HOST"))
			define("_HOST"		,"smtp.1and1.com");
		if(!defined("_PORT"))
			define("_PORT"		,25);
		if(!defined("_USER"))
			define("_USER"		,"hector.perales@futurite.com");
		if(!defined("_PASS"))
			define("_PASS"		,"1234567");
		
		if(!defined("_SMTPAUTH")){
			define("_SMTPAUTH"	,true);
		}
		
		if(!defined("_SENDERNAME")){
			define("_SENDERNAME"	,"Diga Comunicación SA de CV");
		}
		
		if(!defined("_SENDERMAIL")){
			define("_SENDERMAIL"	,"info@digacomunicacion.com");
		}
		$_mailConfig['host']		= _HOST;
		$_mailConfig['port']		= _PORT;
		$_mailConfig['SMTPAuth']	= _SMTPAUTH;
		$_mailConfig['user']		= _USER;
		$_mailConfig['password']	= _PASS;
		$_mailConfig['senderName']	= _SENDERNAME;
		$_mailConfig['senderEmail']	= _SENDERMAIL;
		
		if(isset($_mailConfig[$data])){
			
			if(mb_detect_encoding($_mailConfig[$data], 'UTF-8, ISO-8859-1', true) != "UTF-8"){
				return utf8_encode($_mailConfig[$data]);
			}
			else{
				return $_mailConfig[$data];
			}
		}
		else{
			return "";
		}
	}
}