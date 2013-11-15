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
		if(trim($return_value)!="" && $password==trim($return_value)){
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
	$matricula = $_POST['matricula'];
	$alumno = array();
  
	try{
		$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");

		$sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('OT17688',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $db->prepare($sql);  
		$stmt->bindParam(1, $paterno, PDO::PARAM_STR, 100);
		$stmt->bindParam(2, $materno, PDO::PARAM_STR, 20);
		$stmt->bindParam(3, $nombre, PDO::PARAM_STR, 100);
		$stmt->bindParam(4, $sexo, PDO::PARAM_STR, 1);
		$stmt->bindParam(5, $edad, PDO::PARAM_INT, 2);
		$stmt->bindParam(6, $fechanacimiento, PDO::PARAM_INT, 8);
		$stmt->bindParam(7, $telefono1, PDO::PARAM_STR, 15);
		$stmt->bindParam(8, $telefono2, PDO::PARAM_STR, 15);
		$stmt->bindParam(9, $calle, PDO::PARAM_STR, 40);
		$stmt->bindParam(10, $colonia, PDO::PARAM_STR, 30);
		$stmt->bindParam(11, $poblacion, PDO::PARAM_STR, 30);
		$stmt->bindParam(12, $cp, PDO::PARAM_INT, 5);
		$stmt->bindParam(13, $ultimoplantel, PDO::PARAM_STR, 2);
		$stmt->bindParam(14, $ultimocurso, PDO::PARAM_STR, 20);
		$stmt->bindParam(15, $ultimoHorario, PDO::PARAM_STR, 7);
		$stmt->bindParam(16, $ultimoNivel, PDO::PARAM_STR, 5);
		$stmt->bindParam(17, $email, PDO::PARAM_STR, 100);
		$stmt->bindParam(18, $nombrePlantel, PDO::PARAM_STR, 150);
		$stmt->bindParam(19, $nombreCurso, PDO::PARAM_STR, 100);
		$stmt->bindParam(20, $horario, PDO::PARAM_STR, 7);

		$stmt->execute();
		
		/*print "Paterno : $paterno <br>";
		print "Materno : $materno <br>";
		print "Nombre : $nombre <br>";
		print "Sexo : $sexo <br>";
		print "Edad : $edad <br>";
		print "Fecha Nacimiento : $fechanacimiento <br>";
		print "Telefono 1 : $telefono1 <br>";
		print "Telefono 2 : $telefono2 <br>";
		print "Calle : $calle <br>";
		print "Colonia : $colonia <br>";
		print "Poblacion : $poblacion <br>";
		print "CP : $cp <br>";
		print "Ultimo Plantel : $ultimoplantel <br>";
		print "Ultimo Curso : $ultimocurso <br>";
		print "Ultimo Horario : $ultimoHorario <br>";
		print "Ultimo Nivel : $ultimoNivel <br>";
		print "Email : $email <br>";
		print "Nombre Plantel : $nombrePlantel <br>";
		print "Nombre Curso : $nombreCurso <br>";
		print "Horario : $horario <br>";*/

		$alumno['nombre'] = trim($nombre)." ".trim($paterno)." ".trim($materno);
		$alumno['matricula'] = trim($matricula);
		$alumno['plantel'] = trim($nombrePlantel);
		$alumno['curso'] = trim($nombreCurso);
		$alumno['horario'] = trim($horario);
		$alumno['nivel'] = trim($ultimoNivel);
		$alumno['email'] = trim($email);
		$alumno['sexo'] = trim($sexo);
		$alumno['edad'] = trim($edad);
		$alumno['fecha_nacimiento'] = trim($fechanacimiento);
		$alumno['telefono_1'] = trim($telefono_1);
		$alumno['telefono_2'] = trim($telefono_2);
		$alumno['calle_num'] = trim($calle);
		$alumno['colonia'] = trim($colonia);
		$alumno['poblacion'] = trim($poblacion);
		$alumno['cp'] = trim($cp);
		$alumno['error'] = FALSE;

		$bdh = null;

	} catch (PDOException $e){
		$alumno['error'] = "Failed: ".$e->getMessage();
	}

	echo json_encode($alumno);
}
?>