<?php
        // Variables de configuración
        $response    = array();
        $error       = false;
        $focus       = array();
        $mensaje     = "";
        $originales  = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $item_force  = array( 'frm_rfcletras',
                              'frm_rfcfecha',
                              'frm_rfchomo',
                              'frm_rfcdig',
                              'frm_nombre',
                              'frm_appat',
                              'frm_apmat',
                              'frm_estado',
                              'frm_localidad',
                              'frm_telefono',
                              'frm_email',
                              'frm_pefil',
                              'frm_asunto',
                              'frm_autoriza',
                              'frm_nacimiento');
        
        // Valida Campos
        foreach ($_POST as $key => $value) {
            if (in_array($key, $item_force)) {
                if (empty($_POST[$key])) {
                    $error   = true;
                    $focus[] = $key;
                    $mensaje = "Los campos marcados son obligatorios";
                }
            }
        }
        # Valida Email
        if (!$error && !filter_var($_POST['frm_email'], FILTER_VALIDATE_EMAIL)) {
            $error   = true;
            $focus[] = "frm_email";
            $mensaje = "La dirección de email es invalida";
        }
        # Valida telefono
        if (!$error) {
            $telefono = trim($_POST["frm_telefono"]);
            $telefono = str_replace("(","",$telefono);
            $telefono = str_replace(")","",$telefono);
            $telefono = str_replace("-","",$telefono);
            $telefono = str_replace(" ","",$telefono);
            $is_phone = true;
            $cadena = "/^[0-9]{7,15}?/";
            if(gettype($telefono)!="integer") settype($telefono,"integer");
            if(!preg_match($cadena,$telefono)) $is_phone = false;

            if(!$is_phone) {
                $error   = true;
                $focus[] = "frm_telefono";
                $mensaje = "El numero de teléfono es incorrecto";
            }
        }
        # Valida Autorización
        if (!$error && $_POST["frm_autoriza"] != "S") {
            $error   = true;
            $focus[] = "frm_autoriza";
            $mensaje = "Es necesario dar autorización";
        }

        if (!$error) {
            //Global Values
            $RFCLETRAS    = strtoupper(trim($_POST["frm_rfcletras"]));
            $RFCFECHA     = trim($_POST["frm_rfcfecha"]);
            $RFCHOMO      = trim($_POST["frm_rfchomo"]);
            $RFCDIGITO    = trim($_POST["frm_rfcdig "]);
            # Nombre
            $NOMBRE       = trim($_POST["frm_nombre"]);
            $NOMBRE       = utf8_decode($NOMBRE);
            $NOMBRE       = strtr($NOMBRE, utf8_decode($originales), $modificadas);
            $NOMBRE       = strtolower($NOMBRE);
            $NOMBRE       = utf8_encode($NOMBRE);
            $NOMBRE       = ucfirst($NOMBRE);
            # Paterno
            $PATERNO      = trim($_POST["frm_appat"]);
            $PATERNO      = utf8_decode($PATERNO);
            $PATERNO      = strtr($PATERNO, utf8_decode($originales), $modificadas);
            $PATERNO      = strtolower($PATERNO);
            $PATERNO      = utf8_encode($PATERNO);
            $PATERNO      = ucfirst($PATERNO);
            # Materno
            $MATERNO      = trim($_POST["frm_apmat"]);
            $MATERNO      = utf8_decode($MATERNO);
            $MATERNO      = strtr($MATERNO, utf8_decode($originales), $modificadas);
            $MATERNO      = strtolower($MATERNO);
            $MATERNO      = utf8_encode($MATERNO);
            $MATERNO      = ucfirst($MATERNO);
            $ESTADO       = trim($_POST["frm_estado"]);
            $LOCALIDAD    = trim($_POST["frm_localidad"]);
            $LADA         = ($_POST["frm_lada"]!="")?trim($_POST["frm_lada"]):""; # No obligatorio
            $TELEFONO     = trim($_POST["frm_telefono"]);
            $EMAIL        = trim($_POST["frm_email"]);
            $GENERO       = ($_POST["frm_genero"]!="")?trim($_POST["frm_genero"]):""; # No obligatorio
            $FAX          = ($_POST["frm_fax"]!="")?trim($_POST["frm_fax"]):""; # No obligatorio
            $PERFIL       = trim($_POST["frm_pefil"]);
            $ASUNTO       = trim($_POST["frm_asunto"]);
            $INTERES      = ($_POST["frm_interes"]!="")?trim($_POST["frm_interes"]):""; # No obligatorio
            $TIEMPO       = ($_POST["frm_tiempo"]!="")?trim($_POST["frm_tiempo"]):""; # No obligatorio
            $CONTACTADO   = ($_POST["frm_contactado"]!="")?trim($_POST["frm_contactado"]):""; # No obligatorio
            $AUTORIZA     = $_POST["frm_autoriza"];
            $COMENTARIOS1 = ""; # No obligatorio
            $COMENTARIOS2 = ""; # No obligatorio
            $COMENTARIOS3 = ""; # No obligatorio
            $COMENTARIOS4 = ""; # No obligatorio
            $COMENTARIOS5 = ""; # No obligatorio
            $NACIMIENTO   = $_POST["frm_nacimiento"];            

            /*echo $RFCLETRAS."<br>";
            echo $RFCFECHA."<br>";
            echo $RFCHOMO."<br>";
            echo $RFCDIGITO."<br>";
            echo $NOMBRE."<br>";
            echo $PATERNO."<br>";
            echo $MATERNO."<br>";
            echo $ESTADO."<br>";
            echo $LOCALIDAD."<br>";
            echo $LADA."<br>";
            echo $TELEFONO."<br>";
            echo $EMAIL."<br>";
            echo $GENERO."<br>";
            echo $FAX."<br>";
            echo $PERFIL."<br>";
            echo $ASUNTO."<br>";
            echo $INTERES."<br>";
            echo $TIEMPO."<br>";
            echo $CONTACTADO."<br>";
            echo $AUTORIZA."<br>";
            echo $NACIMIENTO."<br>";*/

            # Conexion con AS400
            try{
                $db = new PDO("odbc:DRIVER={iSeries Access ODBC Driver};SYSTEM=215.1.1.10;PROTOCOL=TCPIP","CLICKER","CLICKER");
                $sql = "CALL SCAPAL.DA3080PRSP( ?,
                                                ?,           
                                                '".$RFCLETRAS."',
                                                '".$RFCFECHA."',
                                                '".$RFCHOMO."',
                                                '".$RFCDIGITO."',
                                                '".$NOMBRE."',
                                                '".$PATERNO."',
                                                '".$MATERNO."',
                                                '".$ESTADO."',
                                                '".$LOCALIDAD."',
                                                '".$LADA."',
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
                                                '".$NACIMIENTO."')";
                $stmt = $db->prepare($sql);  
                $stmt->bindParam(1, $msgError, PDO::PARAM_INT,200);
                $stmt->bindParam(2, $matricula, PDO::PARAM_STR, 200);

                $stmt->execute();

                $error   = false;
                $mensaje = $msgError." -- ".$matricula;
                
                $bdh     = null;

            } catch (PDOException $e) {
                $error   = true;
                $mensaje = "Failed: ".$e->getMessage();
            }
        }

        $response["error"]   = $error;
        $response["focus"]   = $focus;
        $response["mensaje"] = $mensaje;
        echo json_encode($response);
    }
?>
