<?php
class conexion{
	//Servidor BBDD	
	//private $_servidor="buffaloblue.db.9680776.hostedresource.com";
	private $_servidor="localhost";

	//Usuario
	//private $_usuario="buffaloblue";
	private $_usuario="clicker360";

	//Contraseña
	//private $_password="Huo0lpaw#";
	private $_password="jBT3cwg5VJ04vwVm0v5r";
	
	//Nombre de BBDD
	//private $_dataBase="buffaloblue";
	private $_dataBase="crm_interlingua";
	
	//Variable que contranda la conexion
	private $_conexion;
	
	//Se establece la propiedad singleton
	private static $_singleton;
	
	//Se crea el metodo constructor de clase
	private function __construct(){
		//Se intenta conectar con el servidor de BBDD
		$this->_conexion=@mysql_connect($this->_servidor,$this->_usuario,$this->_password) or die(mysql_error());
		//Se intenta seleccionar la BBDD para trabajar
		@mysql_select_db($this->_dataBase,$this->_conexion) or die(mysql_error());
	}
	
	//Se crea el metodo que instancia la clase bajo el patron singleton
	public static function singleton(){
		//Si la propiedad $_singleton se encuentra nula, se instancia la clase
		if(is_null(self::$_singleton)) self::$_singleton = new conexion();
		//Se devuelve el resultado
		return self::$_singleton;
	}
	
	//Se crea el metodo que ejecuta cualquier sentencia sql
	public function execute($sqlQuery){
		//Se crea una expresion regular
		$expresion = "/;$/";
		//Si la sentencia recibida no posee ";" se le agrega al final
		if(!preg_match($expresion,$sqlQuery)) $sqlQuery.=";";
		//Se ejecuta la consulta
		$execute=@mysql_query($sqlQuery,$this->_conexion) or die(mysql_error());
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que devuelve todos los campos de una tabla
	public function getTable($table,$filter=null){
		//Se empieza con la construccion de la sentencia sql
		$myQuery="SELECT * FROM ".$table;
		//Si el usuario a dado algun filtro se le añade
		if(!is_null($filter)) $myQuery.=" ".$filter;
		//Se manda ejecutar la setencia sql
		$execute=$this->execute($myQuery);
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que devuelve varios campos de uno o varios registros
	public function getFields($table,$fields,$filter=null){
		//Se quiebra la variable $fields
		$fields=explode(",",$fields);
		//Se vuelve a formar la variable $fields
		$fields=implode(", ",$fields);
		//Se empieza a formar la setencia sql
		$myQuery="SELECT ".$fields." FROM ".$table;
		//Si el usuario ha mandado algun filtro se le agrega a la setencia
		if(!is_null($filter)) $myQuery.=" ".$filter;
		//Se manda ejecutar la consulta
		$execute=$this->execute($myQuery);
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que inserta nuevos registros en la BBDD
	public function insert($table,$fields,$values){
		//Se verifica si la variable $fields es un array
		
		if(gettype($fields)!="array"){
			//Se quiebra la variable $fields
			$fields=explode(",",$fields);
		}
		//Se verifica si la variables $values es un array
		if(gettype($values)!="array") die("Los valores a ingresar deben ir en una matriz.");
		//Se verifica que conincidan los valores y los campos
		if(count($fields)!=count($values)) die("La cantidad de valores es diferente a la cantidad de campos.");
		
		//Se crea el cliclo que limpira los datos antes de ser ingresados a la BBDD
		foreach($values as $clave=>$valor){
			$values[$clave]=$this->clean_data($valor);
		}
		//Se vuelve a formar la variable $fields
		$fields=implode(", ",$fields);
		//Se vuelve a formar la variable $values
		$values=implode("', '",$values);
		//se formatea a minusculas values
		//$values = mb_convert_case($values, MB_CASE_LOWER, "UTF-8");
		//Se empieza con la construccion de la setencia sql
		$myQuery="INSERT INTO ".$table." (".$fields.") VALUES ('".$values."')";
		//Se manda ejecutar la consulta
		$execute=$this->execute($myQuery);
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que actualiza un registro o registros de una tabla
	public function update($table,$fields,$values,$filter=null){
		//Se verifica si la variable $fields es un array
		if(gettype($fields)!="array"){
			//Se quiebra la variable $fields
			$fields=explode(",",$fields);
		}
		//Se verifica si la variables $values es un array
		if(gettype($values)!="array") die("Los valores a ingresar deben ir en una matriz.");
		//Se verifica si el usuario ha dado algun filtro
		if(is_null($filter)||$filter=="") die("La consulta debe de llevar un filtro.");
		//Se declara la variable que contendra el string formado por los campos y los valores
		$actualizar="";
		//Se crea un ciclo que permitira recorrer los elementos de los dos array formados
		for($i=0;$i<=count($fields)-1;$i++){
			//Se verifica en cual posición se encuentra el ciclo
			if(count($fields)-1==$i){
				//Como el ciclo ya alcanzo la ultima posición se cierra la variable actualizar
				//$actualizar.=$fields[$i]."='".strtolower($values[$i])."'";
				$actualizar.=$fields[$i]."='".$values[$i]."'";
			}
			else{
				//Como el ciclo no ha llegado a la ultima posición se escribe otro actualizar
				//$actualizar.=$fields[$i]."='".strtolower($values[$i])."', ";
				$actualizar.=$fields[$i]."='".$values[$i]."', ";
			}
		}
		//Se empieza con la construccion de la setencia
		$myQuery="UPDATE ".$table." SET ".$actualizar." ".$filter;
		//Se manda ejecutar la consulta
		$execute=$this->execute($myQuery);
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que elimina un registro de una tabla
	public function delete($table,$filter){
		//Se empieza con la construccion de la setencia sql
		$myQuery="DELETE FROM ".$table." ".$filter;
		//Se manda ejecutar la consulta
		$execute=$this->execute($myQuery);
		//Se devuelve el resultado
		return $execute;
	}
	
	//Se crea el metodo que devuelve un codigo
	public function create_code($table,$field,$codeSize){
		//Se declara vacio la variable codigo
		$codigo="";
		//Se declara un array que contendra las letras del abcedario
		$letras=array();
		//Se llena el array recien declarado
		for($i=65;$i<=90;$i++){
			//Se cambia el codigo a ascii al caracter y se agrega al array
			$letras[]=chr($i);
		}
		//Se establece la cantidad de letras en el codigo
		$numeroLetras=$codeSize-2;
		//Se establece la variable controladora del ciclo
		$repeat=true;
		//Se crea un ciclo que permitira crear el codigo
		while($repeat){
			//Se declara la variable que contendra las letras del codigo
			$letrasCodigo="";
			//Se crea un ciclo que permitira seleccionar las letras para el codigo
			for($i=1;$i<=$numeroLetras;$i++){
				$letrasCodigo.=$letras[rand(0,count($letras)-1)];
			}
			//Se escoge el lado en que iran las letras
			$ladoLetras=rand(1,2);
			//Se verifica que lado iran las letras
			if($ladoLetras==1){
				$codigo.=rand(11,99).$letrasCodigo;
			}
			else{
				$codigo.=$letrasCodigo.rand(11,99);
			}
			//Se verifica si el codigo generado es unico
			if($this->counter($table,$field,"WHERE ".$field."='".$codigo."'")==0) $repeat=false;
		}
		//Se devuelve el codigo
		return $codigo;
	}
	
	//Se crea el metodo que cuenta cuantos registros cumplen una condicion
	public function counter($table,$fields,$filter=null){
		//Se verifica si el usuario manda algun filtro
		if(is_null($filter)||$filter==""){
			//Se manda ejecutar la consulta para obtener los datos
			$execute=$this->getFields($table,$fields);
			//Se obtiene el numero de resultados
			$resultados = mysql_num_rows($execute);
		}
		else{
			//Se manda ejecutar la consulta para obtener los datos
			$execute=$this->getFields($table,$fields,$filter);
			//Se obtiene el numero de resultados
			$resultados = mysql_num_rows($execute);
		}
		//Se devuelve el resultado
		return $resultados;
	}
	
	//Se crea le metodo que limpia los datos a ingresar en una BBDD
	public function clean_data($data){
		//Se limpia el datos
		$cleanData=mysql_real_escape_string(addslashes(rawurldecode(trim($data))));
		//Se devuelve el resultado
		return $cleanData;
	}
	
	//Se crea el metodo que evita cualquier ataque de salida
	public function free_output($string){
		//Se limpia de caracteres especiales de html
		$string=htmlentities($string);
		//Se hacen visibles cualquier salto o retorno de carro
		$string=nl2br($string);
		//Se devuelve el resultado
		return $string;
	}
	
	//Se crea le metodo que devuelve un numero formateado
	public function currency($numero,$noDecimales=null){
		//Se verifica si el usuario quiere decimales
		if(!is_null($noDecimales) && $noDecimales == true){
			//Si trae decimales se le quita
			$numero = floor($numero);
			//Se le da forma de moneda al numero sin decimales
			$numero = "$".number_format($numero);
		}else{
			//Se le da forma de moneda al numero con decimales
			$numero = "$".number_format($numero,2);
		}
		//Se devuelve el resultado
		return $numero;
	}
	
	//Se crea el metodo que devuelve una cadena formateada
	/**
	* Modificado por: Héctor <hector.perales@futurite.com>
	* Modificación: Se cambió la función de formato de nombre para mostrar los acentos.(20-JUL-2012)
	* Modificación: Corrección de formato párrafo para mostrar los acentos y caracteres especiales.Formato mayúsculas y minusculas.(04-OCT-2012)
	**/
	public function texto_format($cadena,$tipo=null){
		//Si no tiene contenido $tipo se le asigna valor
		if(is_null($tipo)) $tipo = "capitalizar";
		//Se crea el switch
		switch($tipo){
			case "nombre":
				//$cadena = ucwords(strtolower($cadena));
				$cadena = mb_convert_case($cadena, MB_CASE_TITLE, "UTF-8");
			break;
			
			case "capitalizar":
				$primeraLetra = mb_strtoupper(mb_substr($cadena, 0, 1, "UTF-8"), "UTF-8");
				$cadenaFin = "";
				$cadenaFin = mb_strtolower(mb_substr($cadena, 1, mb_strlen($cadena, "UTF-8"), "UTF-8"), "UTF-8");
				$cadena = $primeraLetra . $cadenaFin;
			break;
			
			case "mayusculas":
				$cadena = mb_convert_case($cadena, MB_CASE_UPPER, "UTF-8");
			break;
			
			case "minusculas":
				$cadena = mb_convert_case($cadena, MB_CASE_LOWER, "UTF-8");
			break;
			
			case "parrafo":
				$cadenaMia = explode(".",$cadena);
				$cadena="";
				foreach($cadenaMia as $clave=>$valor){
					$valor = trim($valor);
					$primeraLetra = mb_strtoupper(mb_substr($valor, 0, 1, "UTF-8"), "UTF-8");
					$cadenaFin = "";
					$cadenaFin = mb_strtolower(mb_substr($valor, 1, mb_strlen($valor, "UTF-8"), "UTF-8"), "UTF-8");
					$cadena.= $primeraLetra.$cadenaFin.". ";
				}
			break;
			
			case "especial":
				$cadena = mb_convert_case($cadena, MB_CASE_TITLE, "UTF-8");
				$cadenaMia = explode(".",$cadena);
				
				if(count($cadenaMia) > 1){
					$cadena="";
				foreach($cadenaMia as $clave=>$valor){
					$valor = trim($valor);
					if($valor != ""){
					$primeraLetra = mb_strtoupper(mb_substr($valor, 0, 1, "UTF-8"), "UTF-8");
					$cadenaFin = "";
					$cadenaFin = mb_substr($valor, 1, mb_strlen($valor, "UTF-8"), "UTF-8");
					$cadena.= $primeraLetra.$cadenaFin.". ";
					}
				}
				}
				else{
					
				}
				
			break;
		
			case "direccion":
				$cadenaMia = $cadena;
				$cadenaMia = preg_match_all('/[0-9]{1,}$/', $cadenaMia, $matches);
				$count = count($matches[0]);
				$cadenaprueba = trim(str_replace(range(0,9),'', $cadena));
				
				for ($i = 0 ; $i < $count ; $i++ ){
					$cadena=$cadenaprueba.' #'.$matches[0][$i];
				}
			break;
			
			default:
				$cadena = $cadena;
			break;
		}
		//Se devuelve la cadena
		return $cadena;
	}
	
	//Se crea el metodo que devuelve el promedio
	public function promedio($valores){
		//Se obtiene el divisor
		$divisor = count($valores);
		//Se establece la variable suma
		$suma = 0;
		//Se crea el ciclo que realizara la suma de los valores
		foreach($valores as $clave=>$valor){
			//Se suman los valores
			$suma = $suma + $valor;
		}
		//Se obtiene el promedio
		$promedio = $suma / $divisor;
		//Se regresa el resultado
		return $promedio;
	}
	
	//Se crea el metodo que devuelve la convercion de f a c
	public function get_cel($temp){
		//Se obtiene la conversion de temperatura
		$temp = ($temp - 32) / 1.8;
		//Se devuelve el resultado
		return round($temp);
	}
	//Se crea el metodo que devuelve la conversión de c a f
	public function get_far($temp){
		//Se obtiene la conversion de temperatura
		$temp = $temp * 1.8 + 32;
		//Se devuelve el resultado
		return round($temp);
	}
	
	//Se crea el metodo que indica si una cadena contiene puras letras
	public function is_alpha($string){
		//Se quiebra la variable $string
		$string=explode(" ",$string);
		//Se crea la variable de control de la funcion
		$is_alpha=true;
		
		//Se crea un ciclo para recorrer el array recien formado
		foreach($string as $clave=>$valor){
			//Si la cadena contiene valor se hace negativa la variable is_alpha
			if(!ctype_alpha($valor)) $is_alpha=false;
		}
		//Se devuelve el resultado
		return $is_alpha;
	}
	
	//Se crea el metodo que indica si una cadena tiene formato de nombre
	public function is_name($string){
		//Se establece la variables de control
		$is_name = true;
		//Se cambia el tamaño de la cadena a minusculas
		$string = strtolower($string);
		//Se establecen los caracteres de cambio
		$patron = array("á","é","í","ó","ú","ñ");
		$cambio = array("a","e","i","o","u","n");
		//Se realiza el cambio de caracteres
		$string = str_replace($patron, $cambio, $string);
		//Se empieza con la válidacion
		if(strlen($string) < 3) $is_name = false;
		if(!$this->is_alpha($string)) $is_name = false;
		//Se devuelve el resultado
		return $is_name;
	}
	
	//Se crea el metodo que indica si una cadena tiene formato de email
	public function is_email($string){
		//Se crea una expresion regular para validar un email
		$expresion="/^[a-z]([\w\.]*)@[a-z]([\w\.]*)\.[a-z]{2,3}$/";
		//Se declara la variable de control de la funcion
		$is_email=true;
		//Si la cadena no tiene formato de email se hace negativa la variable is_email
		if(!preg_match($expresion,$string)) $is_email = false;
		//Se devuelve el resultado
		return $is_email;
	}
	
	//Se crea el metodo que indica si una cadena esta vacia o no
	public function is_empty($string){
		//Se limpian los espacios en blanco de la cadena
		$string=trim($string);
		//Se declara la variable de control
		$is_empty = true;
		//Se verifica si la cadena trae contenido
		if(strlen($string)!=0) $is_empty=false;
		//Se devuelve el contenido de la variable de control
		return $is_empty;
	}
	
	//Se crea el metodo que devuelve si es un telefono
	public function is_phone($telefono){
		//Se le quita los parentesis de la lada
		$telefono = str_replace("(","",$telefono);
		$telefono = str_replace(")","",$telefono);
		//Se le quitan los guiones medios
		$telefono = str_replace("-","",$telefono);
		//Se quitan los espacios en blanco
		$telefono = str_replace(" ","",$telefono);
		//Se crea la variable de control
		$is_phone = true;
		//Se establece la cadena de comparacion
		$cadena = "/^[0-9]{7,15}?/";
		//Se cambia el tipo de dato si corresponde
		if(gettype($telefono)!="integer") settype($telefono,"integer");
		//Se empieza con la validacion del telefono
		if(!preg_match($cadena,$telefono)) $is_phone = false;
		//Se devuelve el resultado
		return $is_phone;
	}
	
	//Se crea el metodo que devuelve si un numero es par
	public function is_even($numero){
		//Se crea la variables de control
		$is_even = true;
		//Se verifica si es par o impar
		if($numero&1) $is_even = false;
		//Se devuelve el resultado
		return $is_even;
	}
	
	//Se crea el metodo que devuelve la ip del usuario
	public function get_ip(){
		//Se declara la variable que contendra la ip
		$ip = 0;
		//Si la variable $_SERVER['HTTP_CLIENT_IP'] tiene algo, se le asiga a $ip
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
		//Se verifica si la variable $_SERVER['HTTP_X_FORWARDED_FOR'] tiene algun valor
		if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//Se abre la matriz de IP's obtenidas de la variable $_SERVER['HTTP_X_FORWARDED_FOR']
			$listaDeIp = explode(", ",$_SERVER['HTTP_X_FORWARDED_FOR']);
			//Si hay algun contenido en $ip se agrega a la matriz
			if($ip){
				array_unshift($listaDeIp, $ip);
				$ip = 0;
			}
			//Se eliminan las ip's privadas y si se encuentra alguna publica se devuelve como resultado
			foreach($listaDeIp as $direccion) if(!eregi("^(192\.168|172\.16|10|224|240|127|0)\.", $direccion)) return $direccion;
		}
		//Si no se encontro nada en $_SERVER['HTTP_X_FORWARDED_FOR'] se obtine mediante $_SERVER['REMOTE_ADDR']
		return $ip ? $ip : $_SERVER['REMOTE_ADDR'];
	}
	
	//Se crea el metodo que devuelve una fecha para formato sql
	public function fecha($fecha=null){
		//Se verifica si la variable $fecha no es null
		if(!is_null($fecha)){
			//Se convierte la fecha en timestamp a fecha normal
			$fecha = date("Y-m-d",$fecha);
		}else{
			$fecha = date("Y-m-d");
		}
		return $fecha;
	}
	
	//Se crea el metodo que devuelve una fecha en formato timestamp
	public function fecha_unix($fecha=null){
		//Si la variable $fecha es null se le asigna valor
		if(is_null($fecha)) $fecha = $this->fecha();
		//Se explota la fecha
		$fecha = explode("-",$fecha);
		//Se obtiene la fecha en formato timestamp
		$tiempo = mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0]);
		//Se devuelve el valor
		return $tiempo;
	}
	
	//Se crea el metodo que devuelve la hora para formato sql
	public function tiempo(){
		return date("H:i:s");
	}
	
	//Se crea la funcion que obtiene la diferencia entre dos dechas
	public function fecha_diff($fecha1,$fecha2,$anios=null,$meses){
		//Se obtiene un array con el dia, mes y año de las 2 fechas
		$fecha1=explode("-",$fecha1);
		$fecha2=explode("-",$fecha2);
		//Se obtiene en formato tiempstamp las dos fechas
		$tiempo1=mktime(0,0,0,$fecha1[1],$fecha1[2],$fecha1[0]);
		$tiempo2=mktime(0,0,0,$fecha2[1],$fecha2[2],$fecha2[0]);
		//Se obtiene la diferencia de las fechas en segundos
		$diferencia=$tiempo1 - $tiempo2;
		//Se obtiene la diferencia en días
		$diferencia_dias=$diferencia / (60*60*24);
		//Se formatea la diferencia entre dias
		$diferencia_dias=abs($diferencia_dias);
		$diferencia_dias=floor($diferencia_dias);
		//Se verifica si el usuario ha pedido la diferencia en años
		if($anios){
			//Se devuelve la diferencia en años
			$diferencia_anios = floor($diferencia_dias / 365);
			return $diferencia_anios;
		}
		else if($meses){
			$diferencia_meses = floor($diferencia_dias / 30);
			return $diferencia_meses; }
		else{
			//Se devuelve la diferencia en días
			return $diferencia_dias;
		}
	}
	
	//Se crea la funcion que devuelve si una persona es mayor de edad
	public function is_old($fecha){
		//Se establece la variable de control
		$is_old = true;
		//Se obtiene la fecha actual
		$fecha_actual = $this->fecha();
		//Se verifica que el año sea mayor a 1910
		$anio = explode("-",$fecha);
		if($anio[0] > 1910){
			//Se obtiene la diferencia en año
			if($this->fecha_diff($fecha_actual,$fecha,true) < 17) $is_old = false;
		}else{
			$is_old = false;
		}
		//Se devuelve el resultado
		return $is_old;
	}
	
	//Método que remueve caracteres inválidos de una cadena
	public function removeBadChars($string){
		$search  = array("|", "=", "#");
		$replace = array(".", ":", ".");
		$cleanString = str_replace($search, $replace, $string);
		return $cleanString;
	}
	
	//Método que valida los caracteres permitidos de una cadena
	function validField($value, $type){
		if($type == "int"){
			$permitidos = "0123456789";
		}
		
		if($type == "alfa"){
			$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		}
		
		if($type == "abc"){
			$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		
		//compruebo que los caracteres sean los permitidos
		for ($i=0; $i<strlen($value); $i++){
			if (strpos($permitidos, substr($value,$i,1))===false){
				return false;
			}
		}
		return true;
	}
	
	//Método que encrita una cadena en base a una palabra secreta
	public function encrypt($string, $key = "Huo0lpaw*") {
		$result = "";
		
		for($i=0; $i<strlen($string); $i++){
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode($result);
	}
	
	//Método que des-encrita una cadena en base a una palabra secreta
	public function decrypt($string, $key = "Huo0lpaw*") {
		$result = "";
		$string = base64_decode($string);
		
		for($i=0; $i<strlen($string); $i++){
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
	
	//Se crea el metodo destructor de la clase
	public function __destruct(){
		//Se cierra la conexion con el servidor de BBDD
		@mysql_close($this->_conexion);
	}
}
//Se instancia la clase
$conexion=conexion::singleton();
?>
