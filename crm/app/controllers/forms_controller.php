<?php

class FormsController extends AppController{

    public $name = 'Forms';
    public $uses = array('Prospect');
	var $components = array('Email');
    
    //private $url_socket = 'http://localhost/adt/crm/prospects/store_prospect/';
    private $url_socket = 'http://www.adtconmigo.mx/crm/prospects/store_prospect';
    
    public function beforeFilter() {
        /* Se permite que se acceda al método sin estar logeado.
         */
        $this->Auth->allow(array('index', 'intro_form', 'cuestionario', 'gracias', 'get_contacts','validar_ajax'));
    }
    
    public function index() {
        $title_for_layout = 'ADT';
        $this->set( compact(
            'title_for_layout'
        ));
    }
    public function validar_ajax(){
        $this->autoRender = false;
        header('Access-Control-Allow-Origin: *');
        $busca = false;        
        if(isset($_POST['email'])){
            $busca = $this->Prospect->find('all',array('conditions'=>array('Prospect.email' => $_POST['email'],'Prospect.'.$_POST['tipo'] => 1)));
        }
        if($busca)
            echo !$busca;
        else
            echo "true";
    }
    public function intro_form() {
        $this->layout = 'ajax';
        $title_for_layout = 'ADT';
        /*debug($this->params['form']);
        exit();*/
        //$origen = false;
        /*if(isset($this->params['form']['origen']) && $this->params['form']['origen']  == 'test'){
            $origen = 'test';
            $this->params['form']['name'] = $this->params['form']['nombre_test'];
            $this->params['form']['email'] = $this->params['form']['email_test'];
            unset($this->params['form']['nombre_test']);
            unset($this->params['form']['email_test']);
            $dataExtend['Test']['total'] = 0;
            foreach($this->params['form'] as $k =>$t){
                if(in_array($k,array('name','email')))
                    $dataExtend['Prospect'][$k] = $t;
                else if($k == 'origen')
                    $dataExtend['Prospect'][$t] = 1;
                else{
                    $dataExtend['Test'][$k] = $t;
                    if($t == 'si')
                        $dataExtend['Test']['total']++;
                }
            }
        }if(isset($this->params['form']['origen']) && $this->params['form']['origen']  == 'infografia'){
            $origen = 'infografia';
            $this->params['form']['name'] = $this->params['form']['nombre_descarga'];
            $this->params['form']['email'] = $this->params['form']['email_descarga'];
            unset($this->params['form']['nombre_descarga']);
            unset($this->params['form']['email_descarga']);
            foreach($this->params['form'] as $k =>$t){
                if(in_array($k,array('name','email')))
                    $dataExtend['Prospect'][$k] = $t;
                else if($k == 'origen')
                    $dataExtend['Prospect'][$t] = 1;
            }
        }else if(isset($this->params['data']['form']['origen']) && $this->params['data']['form']['origen'] == 'formulario'){
            $origen = 'formulario';
            /*
             * Se setean las variables a ocupar en en arreglo que se envia al socket para que no marque error
             * en caso de que no existan por que no hayan sido seleccionadas para el formulario
             * Se utiliza if then else CORTO
             */
       /*     (isset($this->params['data']['form']['name']))             ? $p_name             = $this->params['data']['form']['name']             : $p_name             = "";
            (isset($this->params['data']['form']['email']))            ? $p_email            = $this->params['data']['form']['email']            : $p_email            = "";
            (isset($this->params['data']['form']['area_code']))        ? $p_area_code        = $this->params['data']['form']['area_code']        : $p_area_code        = "";
            (isset($this->params['data']['form']['phone_number']))     ? $p_phone_number     = $this->params['data']['form']['phone_number']     : $p_phone_number     = "";
            (isset($this->params['data']['form']['empresa']))          ? $p_empresa          = $this->params['data']['form']['empresa']          : $p_empresa          = "";
            (isset($this->params['data']['form']['tipo']))             ? $p_tipo             = $this->params['data']['form']['tipo']             : $p_tipo             = "";
            (isset($this->params['data']['form']['tamanio']))          ? $p_tamanio          = $this->params['data']['form']['tamanio']          : $p_tamanio          = "";

            if(isset($this->params['data'])){
                $dataExtend['Prospect'] = array(
                            'name'             => $p_name,
                            'empresa'          => $p_empresa,
                            'area_code'        => $p_area_code,
                            'phone_number'     => $p_phone_number,
                            'email'            => $p_email,
                            'tipo'             => $p_tipo,
                            'tamanio'          => $p_tamanio,
                            'formulario'       => 1
                    );                
            }
        }*/
        $dataExtend['Prospect'] = $this->params['form'];
        $checa_email = $this->Prospect->find('first',array('conditions'=>array('Prospect.email' => $dataExtend['Prospect']['email'])));
        if($dataExtend){
        //Se recibe la información y se guarda.
                $result = '';
                App::import('Core', 'HttpSocket');
                $HttpSocket = new HttpSocket();
                //URL del CRM donde se guardará la info.
                $result = $HttpSocket->post($this->url_socket,$dataExtend);
                /*$_SESSION['id'] = $result;
                //$this->_sendNewUserMail( $dataExtend);
                $_SESSION['gracias'] = $dataExtend['Prospect']['name'];
                $gracias = $dataExtend['Prospect']['name'];
               if($dataExtend['Prospect']['origin_id'] == '2')
                    $action = 'http://www.adtconmigo.mx/gracias.php';
                else if($dataExtend['Prospect']['origin_id'] == '1')
                    $action = 'http://www.adtconmigo.mx/gracias1.php';
                else
                    $action = 'http://www.adtconmigo.mx/gracias1.php';

                $this->set(compact('gracias','action'));*/
                //$this->redirect('http://localhost/adt/graciasNew.php');
                //$this->redirect('http://mscoachin.clicker360dev.com/gracias.php');*/
        }else {
            $this->redirect(array('controller'=>'forms', 'action' => 'index'));
        }

        $this->set( compact(
            'title_for_layout',
            'prospect'
        ));
    }

    function _sendNewUserMail($prospect) {

         require_once "Mail.php";
         $from = "Contacto <contacto@adtconmigo.mx>";
         $to = "<hcardenas@tycoint.com>, <isperez@tycoint.com>, <prosas@tycoint.com>";
         $subject = "Nuevo Registro";
         $body = "Se ha generado un nuevo registro, los datos son los siguientes:\n";
         $body .= "Nombre: ".$prospect['Prospect']['name']."\n";
         $body .= "Correo electrónico: ".$prospect['Prospect']['email']."\n";
         $body .= "Lada: ".$prospect['Prospect']['lada']."\n";
         $body .= "Teléfono: ".$prospect['Prospect']['phone_number']."\n";
         $body .= "Código postal: ".$prospect['Prospect']['area_code']."\n";
         $body .= "Servicio: ".$prospect['Prospect']['servicio']."\n";
         
                   /* <tr><td>Nombre: </td><td>".$prospect['Prospect']['name']."</td></tr>
                    <tr><td>Correo electrónico: </td><td>".$prospect['Prospect']['email']."</td></tr>
                    <tr><td>Lada: </td><td>".$prospect['Prospect']['lada']."</td></tr>
                    <tr><td>Telefono: </td><td>".$prospect['Prospect']['phone_number']."</td></tr>
                    <tr><td>Código postal: </td><td>".$prospect['Prospect']['area_code']."</td></tr>
                    <tr><td>Servicio: </td><td>".$prospect['Prospect']['servicio']."</td></tr>
                </table>";*/

         $host = "mail.emailsrvr.com.";
         $username = "contacto@adtconmigo.mx";
         $password = "JconmiRo78";

         $headers = array ('From' => $from,
           'To' => $to,
           'Subject' => $subject);
         $smtp = Mail::factory('smtp',
           array ('host' => $host,
             'auth' => true,
             'username' => $username,
             'password' => $password));

         $mail = $smtp->send($to, $headers, $body);

         /*if (PEAR::isError($mail)) {
           echo("<p>" . $mail->getMessage() . "</p>");
          } else {
           echo("<p>Message successfully sent!</p>");
          }*/
/*
        $correos = array('iram@clicker360.com','iramgutzglez@gmail.com');
        foreach($correos as $c){
            $this->Email->reset();
            $this->Email->smtpOptions = array(
			'port'=>'25', //25, 587
			'timeout'=>'30',
			'host'=>'mail.emailsrvr.com', // ssl://smtp.gmail.com
			'username'=>'contacto@adtcomigo.mx', //mekate123@gmail.com
			'password'=>'JconmiRo78' //I38E2r0R
		);

		$this->Email->delivery = 'smtp';
            //hay que poner los correos entre < > por que si no manda un error 501
            $this->Email->to = '<'.$c.'>';
            $this->Email->subject = 'Nuevo Registro';
            $this->Email->replyTo = '<contacto@adtcomigo.mx>';
            $this->Email->from = '<contacto@adtcomigo.mx>';
            $this->Email->sendAs = 'html';
            $this->Email->template = 'nuevo_registro';
            $this->set(compact('prospect'));
            /*EN ESTA LINEA DE MANERA DINAMICA SE PEGA EL CONTENIDO DEL MAIL*/
           /* $contenido = "gracias-registro";

            if($contenido != "/**AGRADECIMIENTO**//*"){
                    if ( $this->Email->send() ) {
                           
                            //$this->Session->setFlash('Correo enviado');
                    }
                    else {
                        debug($this->Email->smtpError);
                            //$this->Session->setFlash('Error al enviar el correo');
                            $this->set('smtp-errors', $this->Email->smtpError);
                    }
            }
        }*/
    }
	
    public function get_contacts() {		
        if(isset($this->params['data']['form'])){

            App::import('Vendor', 'Openinviter', array('file' => 'openinviter'.DS.'openinviter.php'));
            App::import('Core', 'HttpSocket');

            $ers = array();
            $inviter=new OpenInviter();
            $oi_services=$inviter->getPlugins(true,false);

            if (empty($this->params['data']['form']['email_box'])){
                $ers['email']="Correo incorrecto !";
            }
            if (empty($this->params['data']['form']['password_box'])){
                $ers['password']="Contraseña incorrecta !";
            }
            if (empty($this->params['data']['form']['provider_box'])){
                $ers['provider']="Proveedor incorrecto !";
            }
            if (count($ers)==0){
                $inviter->startPlugin($this->params['data']['form']['provider_box'], true);
                $internal=$inviter->getInternalError();
                if ($internal){
                    $ers['inviter']=$internal;
                }
                elseif (!$inviter->login($this->params['data']['form']['email_box'],$this->params['data']['form']['password_box'])){
                    $internal=$inviter->getInternalError();
                    $ers['login']=($internal?$internal:"Fallo autenticación. Revise que su usuario y contraseña son correctos !");
                }
                elseif (false===$contacts=$inviter->getMyContacts()){
                    $ers['contacts']="No puedo obtener los contactos !";
                }
                else{
                    $import_ok=true;
                    $_POST['oi_session_id']=$inviter->plugin->getSessionID();
                    $_POST['message_box']='';
                }
            }

            if ($inviter->showContacts()){
                if (count($contacts)==0){
                    "No se localizaron contactos";
                }
                else{
                    foreach ($contacts as $email=>$name){

                        (isset($name))  ? $p_name  = $name  : $p_name  = "";
                        (isset($email)) ? $p_email = $email : $p_email = "";

                        $dataExtend = array(
                                        'name'             => $p_name,
                                        'email'            => $p_email,
                                        'referer'          => $this->params['data']['form']['email_box'],
                                        'external_data'    => '1'
                                );
                        //Se recibe la información y se guarda.
                        $result = '';
                        $HttpSocket = new HttpSocket();
                        //URL del CRM donde se guardará la info.
                        $result = $HttpSocket->post($this->url_socket,$dataExtend);
                        $_SESSION['id'] = $result;
                    }
                }
            }

        }
        else {
            $this->redirect(array('controller'=>'forms', 'action' => 'intro_form'));
        }

        $this->Session->setFlash(implode(",", $ers));

        $this->redirect('/forms/gracias/'.count($contacts));
    }
    
    public function cuestionario() {
        $title_for_layout = 'ADT';
        if(!isset($_SESSION['id'])){
            $this->redirect(array('controller'=>'forms', 'action' => 'index'));
        }
        $this->set( compact(
            'title_for_layout'
        ));
    }
    
    public function gracias() {
		
		if(isset($this->params['pass'][0])){
			$cuantos = $this->params['pass'][0];
		}
		else{
			$cuantos = "";
		}
		
        $this->set( compact('cuantos'));
    }
}
?>
