<?php  
$action = $_POST['action'];

switch ($action) {
	case 'login':
		login();
		break;
	case 'logout':
		logout();
		break;
	case 'getAlumno':
		getAlumno();
		break;
}


function login(){		
	session_start();
	session_regenerate_id();
	$respuesta = array();


	if ( isset($_SESSION["id_alumno"]) ){
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id();
	}
	
	//datos recuperados
	$usuario = trim($_POST['usuario']);
	$password = trim($_POST['pass']);	

	//Verifica Login AS-400
	try{
		$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");

		$sql = "CALL SCAPAL.TALUM_PASSWORD('".$usuario."', ?)";
		$stmt = $db->prepare($sql);    
		$stmt->bindParam(1, $return_value, PDO::PARAM_STR, 10);
		$stmt->execute();

		//verifica datos
		//if($usuario == $usuario_valid && $password == $password_valid){
		if($return_value != "" && $password == $return_value){
			$_SESSION['id_alumno'] = md5($usuario);
			$_SESSION['alumno'] = $usuario;
			$respuesta["url"] = "http://interlingua.com.mx/acceso-a-alumnos/";
			$respuesta["error"] = False;
		}else{
			$respuesta["error"] = True;
			$respuesta["mensaje"] = "El usuario o contraseña son incorrectos";
		}

		$bdh = null;

	} catch (PDOException $e){
		$respuesta["error"] = True;
		$respuesta["mensaje"] = "Failed: ".$e->getMessage();
	}
	
	echo json_encode($respuesta);
}

function logout(){		
	session_start();
	session_destroy();
	echo "http://interlingua.com.mx/";
}

function getAlumno(){
	$alumno = array();
	$alumno['nombre'] = "Hugo Espinosa";
	$alumno['matricula'] = "206321896";
	$alumno['plantel'] = "Polanco, DF.";
	$alumno['curso'] = "Semi-Intensivo";
	$alumno['horario'] = "08:00 - 10:00 am";
	$alumno['nivel'] = "10";
	$alumno['email'] = "vaporic@gmail.com";
	$alumno['sexo'] = "Masculino";
	$alumno['edad'] = "31 años";
	$alumno['fecha_nacimiento'] = "28/06/1988";
	$alumno['telefono_1'] = "(55)55555555";
	$alumno['telefono_2'] = "(55)55555555";
	$alumno['calle_num'] = "Platon 148";
	$alumno['colonia'] = "Polanco";
	$alumno['poblacion'] = "Ciudad De México. DF";
	$alumno['cp'] = "011500";
	echo json_encode($alumno);
}
?>