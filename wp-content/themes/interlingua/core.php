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
	case 'getKardex':
		getKardex();
		break;
	case 'saveMagazine':
		saveMagazine();
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

	//Asigna nombre y matricula en sesión
	try{
		$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");

		$sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('".$usuario."',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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

		$_SESSION['nombre'] = trim($nombre)." ".trim($paterno);

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

		$sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('".$matricula."',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
		$alumno['telefono_1'] = trim($telefono1);
		$alumno['telefono_2'] = trim($telefono2);
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


function getKardex(){
	$matricula = $_POST['matricula'];
	$kardex = array();
	$htmlTable = '<table width="100%" class="tabla-calif">
                    <tr class="top-labels">
                      <td colspan="7">Cursos</td>
                      <td colspan="3">Calificaciones</td>
                    </tr>
                    <tr class="bg-labels">
                        <td>Plantel</td>
                        <td>Horario</td>
                        <td>Curso</td>
                        <td>Nivel</td>
                        <td>Aula</td>
                        <td>Faltas</td>
                        <td>Periodo</td>
                        <td>Escrita</td>
                        <td>Oral</td>
                        <td>Mak-Up</td>
                    </tr>';
	try{
		$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");

		$sql = "CALL SCAPAL.TALUM_KARDEX('".$matricula."')";
		$stmt = $db->query($sql);
		do {
			$rows = $stmt->fetchAll(PDO::FETCH_NUM);
			if($rows){
				foreach($rows as $value){
					$htmlTable .= "<tr>";
					foreach($value as $val){
						$htmlTable .= "<td>".$val."</td>";
					}
					$htmlTable .= "</tr>";
				}
			}
		}while($stmt->nextRowset());

		$htmlTable .= "</table>";

		$bdh = null;
		$kardex['table'] = $htmlTable;
		$kardex['error'] = FALSE;

	} catch (PDOException $e){
		$kardex['error'] = "Failed: ".$e->getMessage();
	}
	echo json_encode($kardex);
}

function stripAccents($cadena){
	$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function saveMagazine(){	
	echo "string";
	$response = array();
	//error_reporting(E_ERROR);
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);	
	
	//Global Values
	$matricula = strtoupper($_POST["matricula"]);
	$paterno = ucfirst(stripAccents($_POST["paterno"]));
	$materno = ucfirst(stripAccents($_POST["materno"]));
	$name = ucfirst(stripAccents($_POST["name"]));
	$tipoTelefono = $_POST["tipotel"];
	$telefono = $_POST["phone_number"];
	$email = $_POST["email"];
	$codigo = strtoupper($_POST["matricula"]);
	$password = "";
	$compania = "";
	$tipo = "A";
	$estatus = "A";
	$registrado = "N";

	try{
		$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");
		$sql = "CALL SCAPAL.TIMAG_ALTA( '".$matricula."',
										'".$paterno."',
										'".$materno."',
										'".$name."',
										'".$tipoTelefono."',
										'".$telefono."',
										'".$email."',
										'".$codigo."',
										'".$password."',
										'".$compania."',
										'".$tipo."',
										'".$estatus."',
										'".$registrado."',
										?,
										?)";
		$stmt = $db->prepare($sql);  
		$stmt->bindParam(1, $magazineId, PDO::PARAM_INT,2);
		$stmt->bindParam(2, $msgError, PDO::PARAM_STR, 100);

		$stmt->execute();

		if ($magazineId == 0) {
			$response["error"] = true;
			$response["mensaje"] = $msgError;	
		}

		$bdh = null;

	} catch (PDOException $e){
		$response["error"] = true;
		$response["mensaje"] = "Failed: ".$e->getMessage();
	}

	echo json_encode($response);
}