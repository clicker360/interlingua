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
	
	//Conexión AS-400
	/*$server="Driver={Client Access ODBC Driver (32-bit)};System=xxx.xxx.xxx.xxx;
	Uid=PROCESOS;Pwd=EISL;"; #the name of the iSeries
	$user="user"; #a valid username that will connect to the DB
	$pass="password"; #a password for the username
	
	$conn=odbc_connect($server,$user,$pass); #you may have to remove quotes
	
	#Check Connection
	if ($conn == false) {
		echo "Not able to connect to database...";
	}*/
	
	//datos recuperados
	$usuario = trim($_POST['usuario']);
	$password = trim($_POST['pass']);	
	
	//usuarios simulados
	$id_valid = "100";
	$usuario_valid = "admin";
	$password_valid = "admin";
	
	//verifica datos
	if($usuario == $usuario_valid && $password == $password_valid){
		$_SESSION['id_alumno'] = $id_valid;
		$_SESSION['alumno'] = $usuario_valid;
		$respuesta["url"] = "http://localhost/hugo/interlingua/acceso-a-alumnos/";
		$respuesta["error"] = False;
	}else{
		$respuesta["error"] = True;
		$respuesta["mensaje"] = "El usuario o contraseña son incorrectos";
	}
	echo json_encode($respuesta);
}

function logout(){		
	session_start();
	session_destroy();
	echo "http://localhost/hugo/interlingua";
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