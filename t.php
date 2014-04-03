<?php
  error_reporting(E_ERROR);
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  
  try{
$db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");

    /* Login */
    /*$sql = "CALL SCAPAL.TALUM_PASSWORD('OT17688', ?)";
    $stmt = $db->prepare($sql);    
    $stmt->bindParam(1, $return_value, PDO::PARAM_STR, 10);
    $stmt->execute();
    print $return_value;
    $bdh = null;*/
    
    /*$sql = "CALL SCAPAL.TMEDI_LISTA()";
    $stmt = $db->query($sql);
    do {
      $rows = $stmt->fetchAll(PDO::FETCH_NUM);
      if($rows){
	foreach($rows as $value){
	   echo $value[0]."-".$value[1];
	  echo "<br>";
	  foreach($value as $val){
	    echo $val."|";
	  }
	}
      }
    }while($stmt->nextRowset());
    
    $bdh = null;*/
    
    /*$sql = "CALL SCAPAL.TALUM_GETPASSWORD('OT17688',?,?,?,?,?)";
    $stmt = $db->prepare($sql); 
    $stmt->bindParam(1, $paterno, PDO::PARAM_STR, 100);
    $stmt->bindParam(2, $materno, PDO::PARAM_STR, 20);
    $stmt->bindParam(3, $nombre, PDO::PARAM_STR, 100);
    $stmt->bindParam(4, $password, PDO::PARAM_STR, 10);
    $stmt->bindParam(5, $email, PDO::PARAM_STR, 100);
    
    $stmt->execute();
    
    echo $paterno."<br>";
    echo $materno."<br>";
    echo $nombre."<br>";
    echo $password."<br>";
    echo $email;
    $bdh = null;*/
    
    /*$sql = "CALL SCAPAL.TALUM_ACCESOALUMNOS('OT17688',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
    print "Paterno : $paterno <br>";
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
    print "Horario : $horario <br>";

    
    $bdh = null;

            $sql = "CALL SCAPAL.DA3080PRCL(?,?,'".$RFCLETRAS."',
                                            ".$RFCFECHA.",
                                            '".$RFCHOMO."',
                                            ".$RFCDIGITO.",
                                            '".$NOMBRE."',
                                            '".$PATERNO."',
                                            '".$MATERNO."',
                                            '".$ESTADO."',
                                            '".$LOCALIDAD."',
                                            '".$LADA."',
					    '".$TELEFONO."',
                                            '".$EMAIL."',
                                            '".$GENERO."',
                                            '".$FAX."',
                                            '".$PERFIL."',
                                            '".$ASUNTO."',
                                            '".$INTERES."',
                                            '".$TIEMPO."',
                                            '".$CONTACTADO."',
                                            '".$AUTORIZA."',
                                            '".$COMENTARIOS1."',
                                            '".$COMENTARIOS2."',
                                            '".$COMENTARIOS3."',
                                            '".$COMENTARIOS4."',
                                            '".$COMENTARIOS5."',
                                            ".$NACIMIENTO.",
					    '".$LIB."')";
*/

        // Variables de configuración
    /*    $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $response    = array();
        
        //Global Values
        $RFCLETRAS    = strtoupper("eich");
        $RFCFECHA     = 880628;
        $RFCHOMO      = "9B";
        $RFCDIGITO    = 8;
        # Nombre
        $NOMBRE       = "Hugo";
        $NOMBRE       = utf8_decode($NOMBRE);
        $NOMBRE       = strtr($NOMBRE, utf8_decode($originales), $modificadas);
        $NOMBRE       = strtolower($NOMBRE);
        $NOMBRE       = utf8_encode($NOMBRE);
        $NOMBRE       = ucfirst($NOMBRE);
        # Paterno
        $PATERNO      = "Espinosa";
        $PATERNO      = utf8_decode($PATERNO);
        $PATERNO      = strtr($PATERNO, utf8_decode($originales), $modificadas);
        $PATERNO      = strtolower($PATERNO);
        $PATERNO      = utf8_encode($PATERNO);
        $PATERNO      = ucfirst($PATERNO);
        # Materno
        $MATERNO      = "Callejas";
        $MATERNO      = utf8_decode($MATERNO);
        $MATERNO      = strtr($MATERNO, utf8_decode($originales), $modificadas);
        $MATERNO      = strtolower($MATERNO);
        $MATERNO      = utf8_encode($MATERNO);
        $MATERNO      = ucfirst($MATERNO);
        $ESTADO       = "monterrey";
        $LOCALIDAD    = "sendero";
        $LADA         = "55"; # No obligatorio
        $TELEFONO     = "55555555";
        $EMAIL        = "vaporic@gmail.com";
        $GENERO       = "M"; # No obligatorio
        $FAX          = "55555555"; # No obligatorio
        $PERFIL       = "test";
        $ASUNTO       = "test";
        $INTERES      = "test"; # No obligatorio
        $TIEMPO       = "test"; # No obligatorio
        $CONTACTADO   = "test"; # No obligatorio
        $AUTORIZA     = "Si";
        $COMENTARIOS1 = "test"; # No obligatorio
        $COMENTARIOS2 = "test"; # No obligatorio
        $COMENTARIOS3 = "test"; # No obligatorio
        $COMENTARIOS4 = "test"; # No obligatorio
        $COMENTARIOS5 = "test"; # No obligatorio
        $NACIMIENTO   = 19880628;*/

	   /* $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");*/
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CALL SCAPAL.TPRSP_ALTATELEMARKETING('VXCV',131231,
                                            'cx',
                                            '5',
                                            'Clicker',
                                            'Test',
                                            'Test',                                            
                                            '55',
                                            '55555555',
                                            '55',
                                            '55555555',
                                            '55',
                                            '55555555',
                                            'test@clicker360.com',
                                            'CHAT',
                                            'ACT',
                                            '555',
                                            ?,
                                            ?)";
	    echo($sql);echo"<br><br><br>";
            $stmt = $db->prepare($sql); 

	    //var_dump($db);echo"<br>"
	    //var_dump($stmt); 

            $stmt->bindParam(1, $matricula, PDO::PARAM_STR,200);
            $stmt->bindParam(2, $msgError, PDO::PARAM_STR,200);
      

            $stmt->execute();

	    echo $msgError;
	    echo $matricula;

            $db = null;

	   
    
  } catch (PDOException $e){
    echo "Failed: ".$e->getMessage();
  }
