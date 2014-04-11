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
    case 'getPass':
        getPass();
        break;
}

function saveMagazine() {
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

    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");
        $sql = "CALL SCAPAL.TIMAG_ALTA( '" . $matricula . "',
										'" . $paterno . "',
										'" . $materno . "',
										'" . $name . "',
										'" . $tipoTelefono . "',
										'" . $telefono . "',
										'" . $email . "',
										'" . $codigo . "',
										'" . $password . "',
										'" . $compania . "',
										'" . $tipo . "',
										'" . $estatus . "',
										'" . $registrado . "',
										?,
										?)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $magazineId, PDO::PARAM_INT, 200);
        $stmt->bindParam(2, $msgError, PDO::PARAM_STR, 200);

        $stmt->execute();

        if ($magazineId == 0) {
            $response["error"] = true;
            if ($msgError == null) {
                $response["mensaje"] = "La matricula es incorrecta";
            } else {
                $response["mensaje"] = $msgError;
            }
        } else {
            $header = "From: INTERLINGUA <contacto@interlingua.com.mx> \r\n";
            $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";
            $header .= "Content-type: text/html\r\n";

            $mensaje = '
				Se ha registrado un nuevo usuario en Interlingua Magazine <br>
				Matrucula: ' . $matricula . '<br>
				Apellido Paterno: ' . $paterno . '<br>
				Apellido Materno: ' . $materno . '<br>
				Nombre: ' . $name . '<br>
				Tipo de teléfono: ' . $tipoTelefono . '<br>
				Teléfono: ' . $telefono . '<br>
				Email: ' . $email . '<br>
				Codigo: ' . $codigo . '
			';

            $para = "hugo@clicker360.com,hrubio@interlingua.com.mx";
            $asunto = 'Nuevo Registro Interlingua Magazine';

            mail($para, $asunto, utf8_decode($mensaje), $header);

            $response["error"] = false;
            $response["mensaje"] = "El alumno fue registrado con éxito";
        }

        $bdh = null;
    } catch (PDOException $e) {
        $response["error"] = true;
        $response["mensaje"] = "Failed: " . $e->getMessage();
    }

    echo json_encode($response);
}

function login() {
    session_start();
    session_regenerate_id();
    $respuesta = array();


    if (isset($_SESSION["id_alumno"])) {
        session_unset();
        session_destroy();
        session_start();
        session_regenerate_id();
    }

    //datos recuperados
    $usuario = strtoupper(trim($_POST['usuario']));
    $password = strtoupper(trim($_POST['pass']));

    //Verifica Login AS-400
    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");

        $sql = "CALL SCAPAL.TALUM_PASSWORD('" . $usuario . "','" . $password . "', ?)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $return_value, PDO::PARAM_STR, 200);
        $stmt->execute();

        //verifica datos
        //if (trim($return_value) != "" && $password == trim($return_value)) {
        if (trim($return_value) == "S") {
            $_SESSION['id_alumno'] = md5($usuario);
            $_SESSION['alumno'] = $usuario;            
            $respuesta["url"] = "http://www.interlingua.com.mx/acceso-a-alumnos/";
            $respuesta["error"] = False;
        } else {
            $respuesta["error"] = True;
            $respuesta["mensaje"] = "El usuario o contraseña son incorrectos";
        }

        $bdh = null;
    } catch (PDOException $e) {
        $respuesta["error"] = True;
        $respuesta["mensaje"] = "Failed: " . $e->getMessage();
    }

    //Asigna nombre y matricula en sesión
    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");

        $sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('" . $usuario . "',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $paterno, PDO::PARAM_STR, 200);
        $stmt->bindParam(2, $materno, PDO::PARAM_STR, 200);
        $stmt->bindParam(3, $nombre, PDO::PARAM_STR, 200);
        $stmt->bindParam(4, $sexo, PDO::PARAM_STR, 200);
        $stmt->bindParam(5, $edad, PDO::PARAM_INT, 200);
        $stmt->bindParam(6, $fechanacimiento, PDO::PARAM_INT, 200);
        $stmt->bindParam(7, $telefono1, PDO::PARAM_STR, 200);
        $stmt->bindParam(8, $telefono2, PDO::PARAM_STR, 200);
        $stmt->bindParam(9, $calle, PDO::PARAM_STR, 200);
        $stmt->bindParam(10, $colonia, PDO::PARAM_STR, 200);
        $stmt->bindParam(11, $poblacion, PDO::PARAM_STR, 200);
        $stmt->bindParam(12, $cp, PDO::PARAM_INT, 200);
        $stmt->bindParam(13, $ultimoplantel, PDO::PARAM_STR, 200);
        $stmt->bindParam(14, $ultimocurso, PDO::PARAM_STR, 200);
        $stmt->bindParam(15, $ultimoHorario, PDO::PARAM_STR, 200);
        $stmt->bindParam(16, $ultimoNivel, PDO::PARAM_STR, 200);
        $stmt->bindParam(17, $email, PDO::PARAM_STR, 200);
        $stmt->bindParam(18, $nombrePlantel, PDO::PARAM_STR, 200);
        $stmt->bindParam(19, $nombreCurso, PDO::PARAM_STR, 200);
        $stmt->bindParam(20, $horario, PDO::PARAM_STR, 200);
        $stmt->bindParam(21, $registrado, PDO::PARAM_STR, 200);

        $stmt->execute();

        $_SESSION['nombre'] = utf8_encode(trim($nombre) . " " . trim($paterno));
        $_SESSION['nombre_completo'] = utf8_encode(trim($nombre) . " " . trim($paterno). " " .trim($materno));

        $bdh = null;
    } catch (PDOException $e) {
        $respuesta["error"] = True;
        $respuesta["mensaje"] = "Failed: " . $e->getMessage();
    }


    echo json_encode($respuesta);
}

function logout() {
    session_start();
    session_destroy();
    echo "http://www.interlingua.com.mx/";
}

function getAlumno() {
    $matricula = $_POST['matricula'];
    $alumno = array();

    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");

        $sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('" . $matricula . "',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $paterno, PDO::PARAM_STR, 200);
        $stmt->bindParam(2, $materno, PDO::PARAM_STR, 200);
        $stmt->bindParam(3, $nombre, PDO::PARAM_STR, 200);
        $stmt->bindParam(4, $sexo, PDO::PARAM_STR, 200);
        $stmt->bindParam(5, $edad, PDO::PARAM_INT, 200);
        $stmt->bindParam(6, $fechanacimiento, PDO::PARAM_INT, 200);
        $stmt->bindParam(7, $telefono1, PDO::PARAM_STR, 200);
        $stmt->bindParam(8, $telefono2, PDO::PARAM_STR, 200);
        $stmt->bindParam(9, $calle, PDO::PARAM_STR, 200);
        $stmt->bindParam(10, $colonia, PDO::PARAM_STR, 200);
        $stmt->bindParam(11, $poblacion, PDO::PARAM_STR, 200);
        $stmt->bindParam(12, $cp, PDO::PARAM_INT, 200);
        $stmt->bindParam(13, $ultimoplantel, PDO::PARAM_STR, 200);
        $stmt->bindParam(14, $ultimocurso, PDO::PARAM_STR, 200);
        $stmt->bindParam(15, $ultimoHorario, PDO::PARAM_STR, 200);
        $stmt->bindParam(16, $ultimoNivel, PDO::PARAM_STR, 200);
        $stmt->bindParam(17, $email, PDO::PARAM_STR, 200);
        $stmt->bindParam(18, $nombrePlantel, PDO::PARAM_STR, 200);
        $stmt->bindParam(19, $nombreCurso, PDO::PARAM_STR, 200);
        $stmt->bindParam(20, $horario, PDO::PARAM_STR, 200);
        $stmt->bindParam(21, $registrado, PDO::PARAM_STR, 200);

        $stmt->execute();        
        if(trim($registrado) == 'Magazine'){
	  //echo $nombre;            	    
            $alumno['nombre'] = $paterno;
            $alumno['matricula'] = trim($matricula);
            $alumno['nombrePlantel'] = trim($nombrePlantel);
            $alumno['plantel'] = trim($registrado);                        
            $alumno['email'] = trim($email);                       
            $alumno['telefono_1'] = trim($telefono1);            
            $alumno['error'] = FALSE;
        }else{
            $alumno['nombre'] = trim($nombre) . " " . trim($paterno) . " " . trim($materno);
            $alumno['matricula'] = trim($matricula);
            $alumno['nombrePlantel'] = trim($nombrePlantel);
            $alumno['plantel'] = trim($registrado);
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
        }                

        $bdh = null;
    } catch (PDOException $e) {
        $alumno['error'] = "Failed: " . $e->getMessage();
    }

    echo json_encode($alumno);
}

function getKardex() {
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
    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");

        $sql = "CALL SCAPAL.TALUM_KARDEX('" . $matricula . "')";
        $stmt = $db->query($sql);
        do {
            $rows = $stmt->fetchAll(PDO::FETCH_NUM);
            if ($rows) {
                foreach ($rows as $value) {
                    $htmlTable .= "<tr>";
                    foreach ($value as $val) {
                        $htmlTable .= "<td>" . $val . "</td>";
                    }
                    $htmlTable .= "</tr>";
                }
            }
        } while ($stmt->nextRowset());

        $htmlTable .= "</table>";

        $bdh = null;
        $kardex['table'] = $htmlTable;
        $kardex['error'] = FALSE;
    } catch (PDOException $e) {
        $kardex['error'] = "Failed: " . $e->getMessage();
    }
    echo json_encode($kardex);
}

function stripAccents($cadena) {
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function getPass() {
    $respuesta = array();


    try {
        $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP", "CLICKER", "CLICKER");


        $sql = "CALL SCAPAL.TALUM_GETPASSWORD('" . strtoupper(trim($_POST["matinpt"])) . "',?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(1, $paterno, PDO::PARAM_STR, 200);
        $stmt->bindParam(2, $materno, PDO::PARAM_STR, 200);
        $stmt->bindParam(3, $nombre, PDO::PARAM_STR, 200);
        $stmt->bindParam(4, $password, PDO::PARAM_STR, 200);
        $stmt->bindParam(5, $email, PDO::PARAM_STR, 200);

        $stmt->execute();


        if (trim($password) == "") {
            $respuesta["error"] = True;
            $respuesta["mensaje"] = "La matricula no existe";
        } else {
            /* echo $paterno."<br>";
              echo $materno."<br>";
              echo $nombre."<br>";
              echo $password."<br>";
              echo $email; */

            $header = "Reply-To: INTERLINGUA <contacto@interlingua.com.mx> \r\n";
            $header .= "Return-Path: INTERLINGUA <contacto@interlingua.com.mx> \r\n";
            $header .= "From: INTERLINGUA <contacto@interlingua.com.mx> \r\n";
            $header .= "Organization: INTERLINGUA \r\n";
            $header .= "Content-type: text/html\r\n";
            $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
            $header .= "Mime-Version: 1.0 \r\n";            

            $mensaje = '
				<table width="650" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; padding:0; margin:0 auto;">
				<tr>
				<th scope="col"><img src="http://www.interlingua.com.mx/img_mail/password_01.jpg"></th>
				</tr>

				<tr>
				<th scope="col">
				<table width="650" border="0" cellspacing="0" cellpadding="0" style=" background-color:#0099a9; border-collapse:collapse; padding:0; color:#FFF; text-align:left; font-family:Tahoma, Geneva, sans-serif; font-size:20px;">

				<tr>
				<th scope="col" width="50"><img src="http://www.interlingua.com.mx/img_mail/password_02.jpg"></th>

				<th scope="col" width="550" valign="top" style="padding:10px 0 20px 30px;">
				<p style="font-weight:normal;">
				Estimado <em><strong>' . $nombre . ' ' . $paterno . ' ' . $materno . ',</strong></em><strong></strong><br /><br />

				&iexcl;Gracias por contactar el servicio de Acceso<br />
				a Alumnos de Interlingua&#33;<br /><br />

				Tu contrase&ntilde;a para tener este acceso<br />
				es la siguiente: <em><strong>' . $password . '</strong></em><br /><br />


				Recibe un cordial saludo y estamos para atenderte.
				</p>
				</th>

				<th scope="col" width="50"><img src="http://www.interlingua.com.mx/img_mail/password_05.jpg"></th>
				</tr>

				</table>
				</th>
				</tr>

				<th scope="col"><img src="http://www.interlingua.com.mx/img_mail/password_06.jpg"></th>
				</tr>

				<tr>
				<th scope="col"><img src="http://www.interlingua.com.mx/img_mail/password_07.jpg" usemap="#Map" border="0"></th>
				</tr>
				</table>


				<map name="Map" id="Map">
				<area shape="circle" coords="216,59,13" href="https://twitter.com/Interlinguamx" target="_blank" alt="Twitter" />
				<area shape="circle" coords="181,60,13" href="https://www.facebook.com/interlingua.mx" target="_blank" alt="Facebook" />
				<area shape="rect" coords="46,18,225,40" href="http://www.interlingua.com.mx/" target="_blank" alt="Interlingua" />
				</map>';

            //$para = $email;
            $para = "vaporic@gmail.com";
            $asunto = 'INTERLINGUA Recuperar Contraseña';

            @mail($para, $asunto, utf8_decode($mensaje), $header);

            $respuesta["error"] = False;
            $respuesta["mensaje"] = "La contraseña fue enviada al correo que registraste";
        }

        $bdh = null;
    } catch (PDOException $e) {
        $respuesta["error"] = True;
        $respuesta["mensaje"] = "Failed: " . $e->getMessage();
    }

    echo json_encode($respuesta);
}

?>