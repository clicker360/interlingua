<?php
class ProspectsController extends AppController{

    public $name = 'Prospects';
    public $uses = array(
        'Prospect',
        'Medium',
        'MediumCategory',
        'StatusCategory',
        'State',
        'Gender',
        'Place',
        'Origin',
        'User',
        'City',
        'Plantel',
        'Event',
        'Pregunta'
    );
    //Número de prospectos asignados por página.
    private $limit = 30;
    public $components = array('Email');
    public function beforeFilter() {
        if($this->Session->check('Auth.User')){
            $openEvents = $this->User->userHasOpenEvent($this->Session->read('Auth.User.id'));
            $this->set(compact('openEvents'));
        }
        //Se permite que se acceda al método sin estar logeado.
        $this->Auth->allow(array('store_prospect','kpi','envio_email','graciasProspect','checkUnique','getPlanteles','getEstados','sendMailContact','getRutaPlantel','randomQuestion','validaTest'));
    }

    /**************************************************************************
     * index: Invoca la información que se genera para la vista del index.
     *
     * @param  Null
     * @throws Null
     * @return Null
     */
    public function index(){
        $title_for_layout     = 'Prospectos';
        //Límite de registros para la paginación.
        if(isset($this->params['named']['page'])){
            $limit_filter = ($this->params['named']['page']-1)*$this->limit . ', ' . $this->limit;
        } else {
            $limit_filter = '0 , ' . $this->limit;
        }
        if($this->Session->read('Auth.User.level')<3){
            $unassigned_prospects = $this->Prospect->getUnassignedProspects($this->Session->read('Auth.User.place_id'));
        } else {
            $unassigned_prospects = $this->Prospect->getUnassignedProspects();
        }
        if($this->Session->read('Auth.User.level')==1){
            $total_assigned_prospects = $this->Prospect->getAssignedProspectsCount(null,$this->Session->read('Auth.User.id'),null,null,null);
            $assigned_prospects   = $this->Prospect->getAssignedProspects(null,$this->Session->read('Auth.User.id'),null,null,$limit_filter);
        } else if($this->Session->read('Auth.User.level')==2){
            $total_assigned_prospects   = $this->Prospect->getAssignedProspectsCount($this->Session->read('Auth.User.place_id'),$this->Session->read('Auth.User.id'),null,null,null);
            $assigned_prospects   = $this->Prospect->getAssignedProspects($this->Session->read('Auth.User.place_id'),$this->Session->read('Auth.User.id'),null,null,$limit_filter);
        } else{
            $total_assigned_prospects   = $this->Prospect->getAssignedProspectsCount(null,null,null,null,null);
            $assigned_prospects   = $this->Prospect->getAssignedProspects(null,null,null,null,$limit_filter);
        }
        //$total_assigned_prospects = count($total_assigned_prospects);
        //Información para botones de la paginación.
        $this->paginate = array(
            'conditions' => $this->Prospect->getAssignedProspectsConditions(),
            'limit' => $this->limit,
        );
        $data = $this->paginate('Prospect');
        
        $genders              = $this->Gender->find('list',array('fields'=>'Gender.gender'));
        $states               = $this->State->find('list');
        $status_categories    = $this->StatusCategory->find('list');
        $medium_categories    = $this->MediumCategory->find('list');
        $places               = $this->get_allowed_places();
        $origins              = $this->Origin->find('list');
        $users = array();
        if($this->Session->read('Auth.User.level')>2)
            $users              = $this->User->find('list');


        $this->set( compact(
            'title_for_layout',
            'unassigned_prospects',
            'assigned_prospects',
            'genders',
            'states',
            'medium_categories',
            'status_categories',
            'places',
            'origins',
            'data',
            'users',
            'total_assigned_prospects'
        ));
    }
    public function checkUnique(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        Configure::write('debug',0);
        $email = $_GET['email'];
        $this->autoRender = false;
        //$prospect = $this->Prospect->find('count',array('conditions'=>array('Prospect.email'=>$email,'DATE_SUB(Prospect.created, INTERVAL -30 SECOND) > NOW()')));
        $prospect = $this->Prospect->find('count',array('conditions'=>array('Prospect.email'=>$email)));        
        //if(!$prospect) echo 'true';
	if($prospect == 0){
	  return 'true';
	}else{
	  return 'false';
	}
	  
    }
    public function assigned_prospects_xls_download(){
        if($this->Session->read('Auth.User.level') >= 3){
        $this->layout = 'xls';
        $total_assigned_prospects   = $this->Prospect->getAssignedProspects(null,null,null,null,null);
        $this->set(compact('total_assigned_prospects'));
        }else{
            $this->redirect(array('action'=>'index'));
        }
        
    }
    public function graciasProspect(){
        $this->autoRender = false;
        if($this->Session->check('gracias')){
            echo $this->Session->read('gracias');
            $this->Session->delete('gracias');
        }
    }
    public function getPlanteles($estado = ''){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $planteles = $this->Plantel->find(
                'list',
                array(
                    'conditions' => array(
                        'Plantel.estado' => $estado
                    ),
                    'fields' => array(
                        'Plantel.plantel'
                    )
                )
        );
        echo json_encode($planteles);
    }
    public function getEstados(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $estados = $this->Plantel->find(
                'list',
                array(
                    'group' => array(   
                        'Plantel.estado'
                    ),
                    'fields' => array(
                        'Plantel.estado'
                    )
                )
        );
        echo json_encode($estados);
    }
    public function getPlace($plantel = ''){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $placeMarketing = $this->Place->find(
                'first',
                array(
                    'conditions' => array(
                        'Place.name' => 'Telemarketing'
                    )
                )
        );
        $place = $this->Place->find(
                'first',
                array(
                    'conditions' => array(
                        'Place.name' => $plantel
                    )
                )
        );
        if($place)
            echo $place['Place']['id'];
        else 
            echo $placeMarketing['Place']['id'];
            
       
        //echo json_encode($place);
        //echo $plantel;
    }
    public function kpi(){
	$mes = date('m');
         if(isset($_GET['mes'])){
             if($_GET['mes'])
                 $mes = $_GET['mes'];
         }
         $inicio_mes = date("Y-$mes-01 00:00:00");
         $dias_mes = date("t",  strtotime($inicio_mes));
         $fin_mes = date("Y-$mes-$dias_mes 23:59:59");
         $this->autoRender = false;
         $total = $this->Prospect->find('count',array('conditions'=>array( 'Prospect.created >=' =>$inicio_mes, 'Prospect.created <=' =>$fin_mes)));
         $ultimo = $this->Prospect->find('first',array('order'=>array('Prospect.created'=>'DESC'),'conditions'=>array( 'Prospect.created >=' =>$inicio_mes, 'Prospect.created <=' =>$fin_mes)));
         $kpi['total'] = $total;
         $kpi['ultimo'] = 'No hay publicaciones en este mes';
         if(isset($ultimo['Prospect']['created']))
            $kpi['ultimo'] = $ultimo['Prospect']['created'];
         echo json_encode($kpi);
}
   public function envio_email($template = null, $datos = array()){
       
                $this->autoRender = false;
	if($template && $datos != array()){            
                /*$this->Email->smtpOptions = array(
                'port'=>'465',
                'timeout'=>'30',
                'host'=>'ssl://smtp.gmail.com',
                'username'=>'iramgutzglez@gmail.com',
                'password'=>'pocagente'
                );
                $this->Email->delivery = 'smtp';*/
		$this->set(compact('datos'));
		$this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
                $this->Email->to = $datos['email'];
                $this->Email->subject = 'Gracias';
                $this->Email->sendAs = 'html';
                $this->Email->template =  $template;
                $this->Email->send();
	}
}
    public function add(){
        
        $medium_categories  = $this->MediumCategory->find('list');
        $states             = $this->State->find('list');
        $genders            = $this->Gender->find('list',array('fields'=>'Gender.gender'));
        $places             = $this->Place->find('list');
        $origin             = $this->Origin->findByName('CRM');
        $this->set( compact( 'medium_categories', 'states', 'genders', 'places', 'origin' ) );

    }

    public function store_prospect(){   
	header('Access-Control-Allow-Origin: *');
        $this->autoRender = false;
        if( !isset($this->data) ){
            //Agregamos una validación para saber si viene de otra página
            if(isset($this->params['form'])){
                $this->data = $this->params['form'];
            } else {
                $this->redirect($this->referer());
                exit();
            }
        }
        $prospect = $this->data;
        $datos = (isset($prospect['Prospect']) && is_array($prospect['Prospect'])) ? $prospect['Prospect'] : $prospect;
        $placeMarketing = $this->Place->find(
                    'first',
                    array(
                        'conditions' => array(
                            'Place.name' => 'Telemarketing'
                        )
                    )
                );  
        $placeProspect = $this->Place->find(
                    'first',
                    array(
                        'conditions' => array(
                            'Place.name' => $datos['plantel']
                        )
                    )
                );  
        if($placeProspect)
            $prospect['place_id'] = $placeProspect['Place']['id'];
        else
            $prospect['place_id'] = $placeMarketing['Place']['id'];
        $this->Prospect->set($prospect);         
        $desdeCRM = strpos($_SERVER['HTTP_REFERER'], Router::url('/',true));
        if ($desdeCRM !== false) {            
            $this->Prospect->validate = array();
        }
        if($this->Prospect->validates()){
            if( $this->Prospect->saveAll( $prospect ) ){ // Was Prospect sucessfully saved?
                $datos = (isset($prospect['Prospect']) && is_array($prospect['Prospect'])) ? $prospect['Prospect'] : $prospect;
                $this->Session->setFlash('Prospecto guardado con éxito');
                if($this->Session->check('Auth.User'))
                    $this->redirect(array('controller'=>'prospects', 'action' => 'index'));
                else{
                    if(in_array($prospect['origin_id'],array('2','3'))){
                        $this->envio_email('gracias',$datos);
                        $this->redirect(Configure::read('host').'inscripciones/gracias.html');
                        
                    }else if(in_array($prospect['origin_id'],array('4'))){
                        $this->envio_email('gracias',$datos);
                        /*$this->redirect(Configure::read('host').'inscripciones2/gracias.html');*/
                        echo "<script>parent.window.location='http://www.interlingua.com.mx/inscripciones/gracias.html';</script>";
                        
                    }
                    else if(in_array($prospect['origin_id'],array('5','6'))){
                            $this->envio_email('gracias2',$datos);
                            //if($this->data['origin_id'] == '5')
                                //$this->redirect(Configure::read('host').'cursosdeverano2/gracias.html'); 
                                 $this->redirect(Configure::read('host').'inscripcioneskids/gracias.html');
                            /*else if($this->data['origin_id'] == '6')
                                $this->redirect(Configure::read('host').'cursosdeverano/gracias.html'); */                   
                    }else if($prospect['origin_id'] == '7'){
			//$this->redirect('http://dev.clicker360.com/interlingua/regresoaclases1/gracias.html');
			 $this->envio_email('gracias_joven',$datos);
			 echo "<script>parent.window.location='http://www.interlingua.com.mx/buenfin/gracias.html';</script>";
		    }else if($prospect['origin_id'] == '8'){
			$this->redirect('http://dev.clicker360.com/interlingua/regresoaclases2/gracias.html');
		    }else if($prospect['origin_id'] >= 9 && $prospect['origin_id'] <= 89){
                $this->redirect('http://www.interlingua.com.mx/gracias/');
	        }else if($prospect['origin_id'] == 90){
                $this->redirect('http://www.interlingua.com.mx/gracias-test?niv='.$_POST['niv_test']);
            }
                }
            }else{
                if($this->Session->check('Auth.User')){                
                    $this->Session->setFlash('No se pudo guardar el prospecto');
                    $this->redirect(array('controller'=>'prospects','action'=>'add'));
                }else{
                    $this->redirect($this->referer());
                    /*if($this->data['origin_id'] == '3')
                        $this->redirect(Configure::read('host').'/inscripciones2/');
                    else
                        $this->redirect(Configure::read('host').'/inscripciones/');                    */
                }
            }
        }else{   
            $this->redirect($this->referer().'#error='.json_encode($this->Prospect->invalidFields()));
            //debug($this->Prospect->invalidFields());
        }
    }

    public function list_unassigned_prospects($place = null){
        $this->layout = 'ajax';
	if($this->Session->read('Auth.User.level')<3){
		    $unassigned_prospects = $this->Prospect->getUnassignedProspects($this->Session->read('Auth.User.place_id'));
        } else {
            $unassigned_prospects = $this->Prospect->getUnassignedProspects();
        }
        $this->set( compact( 'unassigned_prospects' ) );
    }

    /**************************************************************************
     * edit: Invoca la información que se genera para la vista de edición.
     *
     * @param  Null
     * @throws Null
     * @return Null
     */
    public function edit(){
        // Se trae la información del usuario
        $sessData = $this->Session->read('Auth');
        // Se valida que traiga información del contacto.
        if( !isset($this->params['id']) ) {
            $this->redirect($this->referer());
            exit();
        }

        $prospect = $this->Prospect->findById( $this->params['id'] );
        // Si el identificador no corresponde a ningún prospecto.
        if( !$prospect ) {
            $this->redirect($this->referer());
            exit();
        }
        // Si el nivel de usuario es nivel 1.
        if($sessData['User']['level'] == 1) {
            // Se comprueba que no esté asignado y de ser así se asigna al usuario logeado.
            if($prospect['Prospect']['user_id'] == null || $prospect['Prospect']['user_id'] == 0) {
                $this->Prospect->validate = array();
                $this->Prospect->read(null,$this->params['id']);
                $this->Prospect->set('user_id',$sessData['User']['id']);
                $this->Prospect->set('place_id',$sessData['User']['place_id']);
                $this->Prospect->save();
            }
            // Se redirecciona a agendar un evento
            $this->redirect('../agendar-evento/' . $this->params['id']);
            exit();
        }

        $this->data        = $prospect;
        $states            = $this->State->find('list');
        $origins           = $this->Origin->find('list');
        $places            = $this->Place->find('list');
        $medium_categories = $this->MediumCategory->find('list');

        $current_users     = $this->User->find('list');
        $current_cities    = $this->City->find('list', array('conditions'=>array('City.state_id'=>$prospect['State']['id'])));
        $current_media     = $this->Medium->find('list', array('conditions'=>array('Medium.medium_category_id'=>$prospect['Medium']['medium_category_id'])));

        $this->set( compact('states','places', 'current_users','medium_categories', 'origins', 'current_cities', 'current_media'));

    }

    public function view(){
        // Se trae la información del usuario
        $sessData = $this->Session->read('Auth');
        // Se valida que traiga información del contacto.
        if( !isset($this->params['id']) ) {
            $this->redirect($this->referer());
            exit();
        }

        $prospect = $this->Prospect->findById( $this->params['id'] );

        if( !$prospect ){ // id doesn't correspond to any prospect?
            $this->redirect($this->referer());
            exit();
        }

         // Si el nivel de usuario es nivel 1.
        if($sessData['User']['level'] == 1) {
            // Validación si hay eventos abiertos.
            if( $this->Prospect->prospectHasOpenEvent( $prospect['Prospect']['id'] )){
                // Se redirecciona a ver eventos
                $this->redirect('../atender-evento/' . $this->Prospect->prospectLastEvent($this->params['id']));
            } else {
                //Se valida si es un estado final.
                $prosp_ref = $this->Prospect->find('all',array('conditions'=>array('Prospect.id'=>$this->params['id'])));
                if($prosp_ref[0]['Prospect']['status_id'] == 2 OR $prosp_ref[0]['Prospect']['status_id'] == 5 OR $prosp_ref[0]['Prospect']['status_id'] == 10 OR $prosp_ref[0]['Prospect']['status_id'] == 11 OR $prosp_ref[0]['Prospect']['status_id'] == 12) {
                    // Se redirecciona a la consulta del prospecto.
                    $this->redirect('../atender-evento/' . $this->Prospect->prospectLastEvent($this->params['id']));
                } else {
                    // Se redirecciona a agendar un evento.
                    $this->redirect('../agendar-evento/' . $this->params['id']);
                }
            }
            exit();
        }
        
        $this->data = $prospect;
        $events     = $this->Event->obtainEventsOfProspect( $prospect['Prospect']['id'] );
        $this->set( compact('events'));
    }

    public function store_prospect_ajax(){

        if( !isset( $this->params['data']['Prospect'] ) ){
            $this->redirect($this->referer());
            exit();
        }

        $this->layout = 'ajax';
        $this->data   = $this->params['data'];

        if(isset($this->data['Prospect']['nombre'])) {
            $this->data['Prospect']['name'] = $this->data['Prospect']['nombre'];
        }
        $datos = (isset($this->data['Prospect']) && is_array($this->data['Prospect'])) ? $this->data['Prospect'] : $this->data;
        $this->Prospect->validate = array();
        $success = $this->Prospect->save( $this->data );

        $this->set( compact('success') );
    }   

    /**************************************************************************
     * search_prospects_ajax: Genera la información para la lista de prospectos
     *                        asignados de forma dinámica.
     * @param  Null
     * @throws Null
     * @return Null
     */
    public function search_prospects_ajax(){
    //Configure::write('debug', 2);
        $this->layout   = 'ajax';
        //Se toma la url para tomar las parámetros que contiene
        $url_parametros = $this->params['pass'];
        /*if( !isset( $this->params['data']['Prospect'] )){
            $this->redirect($this->referer());
            exit();
        }*/
        //Límite de registros para la paginación.
        if(isset($this->params['named']['page'])){
            $limit_filter = ($this->params['named']['page']-1)*$this->limit . ', ' . $this->limit;
        } else {
            $limit_filter = '0, ' . $this->limit;
        }
        
        if($this->Session->read('Auth.User.level')==1){
            $this->params['data']['Prospect']['user_id'] = $this->Session->read('Auth.User.id');
        } else if($this->Session->read('Auth.User.level')==2){            
           $this->params['data']['ORCondition'] = array(array('Prospect.place_id'=>$this->Session->read('Auth.User.place_id')),array('Prospect.user_id'=>$this->Session->read('Auth.User.id')));
        }
        //Información para botones de la paginación.
        if(isset($url_parametros['0']) && $url_parametros['0'] != '' && $url_parametros['0'] != 'null') {
            $total_assigned_prospects = $this->Prospect->searchAssignedProspectsCount( $this->params['data'],$url_parametros['0'],$url_parametros['1'],null);
            $prospects = $this->Prospect->searchAssignedProspects( $this->params['data'],$url_parametros['0'],$url_parametros['1'],$limit_filter);
            $this->paginate = array(
                'conditions' =>  $this->Prospect->searchAssignedProspectsConditions( $this->params['data'],$url_parametros['0'],$url_parametros['1'],$limit_filter),
                'limit' => $this->limit,
            );
        } else {
            $total_assigned_prospects = $this->Prospect->searchAssignedProspectsCount( $this->params['data'], null, null, null);
            $prospects = $this->Prospect->searchAssignedProspects( $this->params['data'], null, null, $limit_filter);
            $this->paginate = array(
                'conditions' =>  $this->Prospect->searchAssignedProspectsConditions( $this->params['data'],null,null,$limit_filter),
                'limit' => $this->limit,
            );
        }
        $data = $this->paginate('Prospect');
        //$total_assigned_prospects = count($total_assigned_prospects);
        //debug($prospects);
        //debug($total_assigned_prospects);
        $this->set(compact('prospects','total_assigned_prospects'));

    }

    /**
    * Envia email de forms de Contacto
    */
    public function sendMailContact(){   
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        //Configure::write('debug',2);
        $this->autoRender = false;
        $tipo = $this->params["url"]["tipo"];
        switch ($tipo) {
            case 'franquicias':
                //$mail = "talmaraz@interlingua.com.mx";
                  $mail = "franquicias@interlingua.com.mx";
                //$mail = "hugo@clicker360.com";
                  $msjMail = "Has recibido un mensaje de ".$tipo.":<br>
                    Nombre: ".$_POST["name"]."<br>
                    Email: ".$_POST["email"]."<br>
                    Lada: ".$_POST["lada"]."<br>
                    Teléfono: ".$_POST["phone_number"]."<br>
                    Celular: ".$_POST["mobile_number"]."<br>
                    Estado: ".$_POST["estado"]."<br>
                    Plantel: ".$_POST["plantel"]."<br>
                    Medio de contacto: ".$_POST["medio_contacto"]."<br>
                    Comentarios: ".$_POST["comments"];
                   
                   //envia email a interlingua
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $mail;
		  $this->Email->subject = 'Contacto';
		  $this->Email->sendAs = 'html';
		  $this->Email->send($msjMail);
		  
		   //envia email de respuesta
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $_POST["email"];
		  $this->Email->subject = 'Gracias';
		  $this->Email->sendAs = 'html';
		  $this->Email->template =  'gracias_franq';
		  $this->Email->send();
		  //debug($this->Email->smtpError);
		  $this->redirect(Configure::read('host').'/gracias');
                break;
            case 'empresas':
                $mail = "informacion@interlingua.com.mx";
                //$mail = "eric@clicker360.com";
                $msjMail = "Has recibido un mensaje de ".$tipo.":<br>
                    Nombre: ".$_POST["name"]."<br>
                    Email: ".$_POST["email"]."<br>
                    Compañia: ".$_POST["empresa"]."<br>
                    Puesto: ".$_POST["puesto"]."<br>
                    Lada: ".$_POST["lada"]."<br>
                    Teléfono: ".$_POST["phone_number"]."<br>
                    Celular: ".$_POST["mobile_number"]."<br>
                    Estado: ".$_POST["estado"]."<br>
                    Plantel: ".$_POST["plantel"]."<br>
                    Comentarios: ".$_POST["comentario"];  
                    
                    //envia email a interlingua
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $mail;
		  $this->Email->subject = 'Contacto';
		  $this->Email->sendAs = 'html';
		  $this->Email->send($msjMail);
		  
		   //envia email de respuesta
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $_POST["email"];
		  $this->Email->subject = 'Gracias';
		  $this->Email->sendAs = 'html';
		  $this->Email->template =  'gracias_emp';
		  $this->Email->send();
		  //debug($this->Email->smtpError);
		  $this->redirect(Configure::read('host').'/gracias');
                break;
            case 'bolsaTrabajo':
                $mail = "acarranza@interlingua.com.mx";
                //$mail = "hugo@clicker360.com,eric@clicker360.com";
                $msjMail = "Has recibido un mensaje de ".$tipo.":<br>
                    Nombre: ".$_POST["name"]."<br>
                    Email: ".$_POST["email"]."<br>
                    Lada: ".$_POST["lada"]."<br>
                    Teléfono: ".$_POST["phone_number"]."<br>
                    Celular: ".$_POST["mobile_number"]."<br>
                    Nacionalidad: ".$_POST["nacionalidad"]."<br>
                    Estado: ".$_POST["estado"]."<br>
                    Plantel: ".$_POST["plantel"]."<br>
                    Puesto deseado: ".$_POST["puestodeseado"]."<br>
                    ¿Como te enteraste de INTERLINGUA?: ".$_POST["medio"]."<br>
                    Comentarios: ".$_POST["comments"];
                    
                    //envia email a interlingua
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $mail;
		  $this->Email->subject = 'Contacto';
		  $this->Email->sendAs = 'html';
		  $this->Email->send($msjMail);
		  
		   //envia email de respuesta
		  $this->Email->from = 'Interlingua <contacto@interlingua.com.mx>';
		  $this->Email->to = $_POST["email"];
		  $this->Email->subject = 'Gracias';
		  $this->Email->sendAs = 'html';
		  $this->Email->template =  'gracias_bt';
		  $this->Email->send();
		  //debug($this->Email->smtpError);
		  $this->redirect(Configure::read('host').'/gracias_teachers');
                break;
            default:
                $mail = "";
                break;
        }
	/*$this->Email->smtpOptions = array(
                'port'=>'25',
                'timeout'=>'30',
                'host'=>'smtp.emailsrvr.com',
                'username'=>'send@ingeniagroup.com.mx',
                'password'=>"qwerty"
                );
	$this->Email->delivery = 'smtp';*/
        

       
    }

    /**
    * Obtiene ruta plantel
    */
    public function getRutaPlantel(){   
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $plnt = $this->params["url"]["plantel"];
        $resultado = array();

        switch ($plnt) {
            case 'Aguascalientes':
                $resultado['rutaPlantel'] = "interlingua-aguascalientes/"; 
                break;
            case 'Tijuana':
                $resultado['rutaPlantel'] = "interlingua-tijuana-b-c/";     
                break;
            case 'Campeche':
                $resultado['rutaPlantel'] = "interlingua-campeche-2/"; 
                break;
            case 'Cd. Del Carmen':
                $resultado['rutaPlantel'] = "interlingua-cd-del-carmen/"; 
                break;
            case 'Cd. Juarez':
                $resultado['rutaPlantel'] = "interlingua-cd-juarez-chih/"; 
                break;
            case 'Rincon La Rosita':
                $resultado['rutaPlantel'] = "interlingua-torreon-rincon-la-rosita/"; 
                break;
            case 'Bosques de las Lomas':
                $resultado['rutaPlantel'] = "interlingua-bosque-de-las-lomas/"; 
                break;
            case 'Dakota 95':
                $resultado['rutaPlantel'] = "interlingua-dakota-95-wtc/"; 
                break;
            case 'El Rosario':
                $resultado['rutaPlantel'] = "interlingua-el-rosario/";     
                break;
            case 'Forum Buenavista':
                $resultado['rutaPlantel'] = "interlingua-forum-buenavista/"; 
                break;
            case 'Gran Sur':
                $resultado['rutaPlantel'] = "interlingua-gran-sur/"; 
                break;
            case 'Jardin Balbuena':
                $resultado['rutaPlantel'] = "interlingua-jardin-balbuena/"; 
                break;
            case 'Lindavista':
                $resultado['rutaPlantel'] = "interlingua-lindavista/"; 
                break;
            case 'Miramontes':
                $resultado['rutaPlantel'] = "interlingua-miramontes/"; 
                break;   
            case 'Parques Polanco':
                $resultado['rutaPlantel'] = "interlingua-parques-polanco/"; 
                break;
            case 'Picacho, Pedregal':
                $resultado['rutaPlantel'] = "interlingua-picacho-pedregal/";     
                break;
            case 'Plaza Oriente':
                $resultado['rutaPlantel'] = "interlingua-plaza-oriente/"; 
                break;
            case 'Plaza Polanco':
                $resultado['rutaPlantel'] = "interlingua-plaza-polanco/"; 
                break;
            case 'Plaza Universidad':
                $resultado['rutaPlantel'] = "interlingua-plaza-universidad/"; 
                break;
            case 'Puerta Alameda':
                $resultado['rutaPlantel'] = "interlingua-puerta-alameda/"; 
                break;
            case 'Zona Rosa':
                $resultado['rutaPlantel'] = "interlingua-zona-rosa-2/"; 
                break;
            case 'Atizapan':
                $resultado['rutaPlantel'] = "interlingua-atizapan/"; 
                break;
            case 'Coacalco':
                $resultado['rutaPlantel'] = "interlingua-coacalco/";     
                break;
            case 'Cuautitlan Izcalli':
                $resultado['rutaPlantel'] = "interlingua-cuautitlan-izcalli/"; 
                break;
            case 'Ecatepec':
                $resultado['rutaPlantel'] = "interlingua-ecatepec/"; 
                break;
            case 'Interlomas':
                $resultado['rutaPlantel'] = "interlingua-interlomas/"; 
                break;
            case 'Ixtapaluca':
                $resultado['rutaPlantel'] = "interlingua-ixtapaluca/"; 
                break;
            case 'Metepec':
                $resultado['rutaPlantel'] = "interlingua-metepec/"; 
                break;  
             case 'Nezahualcoyotl':
                $resultado['rutaPlantel'] = "interlingua-nezahualcoyotl/"; 
                break;
            case 'Nicolas Romero':
                $resultado['rutaPlantel'] = "interlingua-nicolas-romero/";     
                break;
            case 'Patio Ecatepec':
                $resultado['rutaPlantel'] = "interlingua-patio-ecatepec/"; 
                break;
            case 'Satelite':
                $resultado['rutaPlantel'] = "interlingua-satelite-2/"; 
                break;
            case 'Tecamac':
                $resultado['rutaPlantel'] = "interlingua-tecamac/"; 
                break;
            case 'Texcoco':
                $resultado['rutaPlantel'] = "interlingua-texcoco/"; 
                break;
            case 'Tlalnepantla':
                $resultado['rutaPlantel'] = "interlingua-tlanepantla/"; 
                break;
            case 'Toluca':
                $resultado['rutaPlantel'] = "interlingua-toluca/"; 
                break;
            case 'Irapuato':
                $resultado['rutaPlantel'] = "interlingua-irapuato-gto/";     
                break;
            case 'Pachuca':
                $resultado['rutaPlantel'] = "interlingua-pachuca-hgo/"; 
                break;
            case 'Tula':
                $resultado['rutaPlantel'] = "interlingua-tula-hgo/"; 
                break;
            case 'Tulancingo':
                $resultado['rutaPlantel'] = "interlingua-tulancingo-hgo/"; 
                break;
            case 'Av. Mexico':
                $resultado['rutaPlantel'] = "interlingua-guadalajara-av-mexico/"; 
                break;
            case 'Centro Sur':
                $resultado['rutaPlantel'] = "interlingua-guadalajara-centro-sur/"; 
                break;   
            case 'Morelia':
                $resultado['rutaPlantel'] = "interlingua-morelia-michoacan/"; 
                break;
            case 'Cuernavaca':
                $resultado['rutaPlantel'] = "interlingua-cuernavaca-mor/";     
                break;
            case 'Chapultepec':
                $resultado['rutaPlantel'] = "interlingua-monterrey-chapultepec/"; 
                break;
            case 'Monterrey Linda Vista':
                $resultado['rutaPlantel'] = "interlingua-monterrey-linda-vista/"; 
                break;
            case 'Sendero':
                $resultado['rutaPlantel'] = "interlingua-monterrey-sendero/"; 
                break;
            case 'Huexotitla':
                $resultado['rutaPlantel'] = "interlingua-puebla-huexotitla/"; 
                break;
            case 'La Paz':
                $resultado['rutaPlantel'] = "interlingua-puebla-la-paz/"; 
                break;
            case 'Queretaro':
                $resultado['rutaPlantel'] = "interlingua-queretaro/"; 
                break;
            case 'Cancun':
                $resultado['rutaPlantel'] = "interlingua-cancun-qr/";     
                break;
            case 'Rioverde':
                $resultado['rutaPlantel'] = "interlingua-rio-verde-s-l-p/"; 
                break;
            case 'San Luis Potosi':
                $resultado['rutaPlantel'] = "interlingua-san-luis-potosi/"; 
                break;
            case 'Culiacan':
                $resultado['rutaPlantel'] = "interlingua-culiacan-sin/"; 
                break;
            /*case 'Hermosillo':
                $resultado['rutaPlantel'] = "interlingua-hermosillo-satelite/"; 
                break;*/
            case 'Villahermosa':
                $resultado['rutaPlantel'] = "interlingua-villahermosa-tab/";
                break;
            case 'Orizaba':
                $resultado['rutaPlantel'] = "interlingua-orizaba-ver/"; 
                break;
            case 'Poza Rica':
                $resultado['rutaPlantel'] = "interlingua-poza-rica-ver/"; 
                break;
            case 'Veracruz':
                $resultado['rutaPlantel'] = "interlingua-veracruz-ver/"; 
                break;
            case 'Zona Macroplaza':
                $resultado['rutaPlantel'] = "interlingua-merida-zona-macroplaza-yuc/"; 
                break;
            case 'Zona Dorada':
                $resultado['rutaPlantel'] = "interlingua-merica-zona-dorada-yuc/    ";
                break;
            default:
                 $resultado['rutaPlantel'] = "";
                break;
        }

        echo(json_encode($resultado));
    }

    /**
    * Carga formulario de test
    */
    public function randomQuestion(){   
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $resultado = array();
        $nivel = (isset($_POST["nivel"]))?$_POST["nivel"]:-1;
        $flag = (isset($_POST["flag"]))?$_POST["flag"]:0;
        switch ($nivel) {
            case -1:
                $nivelTxt = "Preliminar";
                break;
            case 0:
                $nivelTxt = "Introducci&oacute;n";
                break;
            
            default:
                $nivelTxt = $nivel;
                break;
        }
        //$preguntas = $this->Pregunta->find('all', array(
          //  'conditions' => array('Pregunta.nivel' => -1)
        //));
        // Realiza random de 5 preguntas dependiendo del nivel
        $preguntas = $this->Pregunta->query("SELECT * FROM preguntas WHERE nivel = ".$nivel." ORDER BY RAND() LIMIT 5 ;");
        $html_tx = "<div class='ctn-pre' id='ctn-preg".$nivel."'><h1>Nivel ".$nivelTxt."</h1>";
        foreach ($preguntas as $value) {
            foreach ($value as $key => $val) {
            	if( $val["imagen"] != ""){
            		$imgTest = "<img class='imgItemTest' src='http://www.interlingua.com.mx/wp-content/themes/interlingua/library/images/images_test/".$val["imagen"]."' />";
            	}else{
            		$imgTest = "";
            	}
                 $html_tx .= "<div class='item'>
                 				<div class='preguntasIzq'>
	                                <h3>".$val["pregunta"]."</h3>
	                                <div class='respuestas'>
	                                	<input type='radio' name='resp".$val["id"]."' data-sel='inpt".$nivel."' data-id='".$val["id"]."' value='1' checked> 
	                                	<label for='resp".$val["id"]."'>
	                                		".$val["opcion_1"]."
	                                	</label>
	                                </div>
	                                <div class='respuestas'>
	                                	<input type='radio' name='resp".$val["id"]."' data-sel='inpt".$nivel."' data-id='".$val["id"]."' value='2'>
	                                	<label for='resp".$val["id"]."'>
	                                		".$val["opcion_2"]."
	                                	</label>
	                                </div>
	                                <div class='respuestas'>
	                                	<input type='radio' name='resp".$val["id"]."' data-sel='inpt".$nivel."' data-id='".$val["id"]."' value='3'>
	                                	<label for='resp".$val["id"]."'>
	                                		".$val["opcion_3"]."
	                                	</label>
	                                </div>
	                                <div class='respuestas'>
										<input type='radio' name='resp".$val["id"]."' data-sel='inpt".$nivel."' data-id='".$val["id"]."' value='4'>
										<label for='resp".$val["id"]."'>
	                                		".$val["opcion_4"]."
	                                	</label>
                                	</div>
                                </div>
                                 ".$imgTest."
                            </div>";
            }
        }
        $html_tx .= "<input type='hidden' name='niv' id='niv' value='".$nivel."'>
                  <input type='hidden' name='fla' id='fla' value='".$flag."'><br><br>
                  <input type='button' name='sendValidate' id='sendValidate' value='Siguiente' data-nivel='".$nivel."'>
                </div>";
        $resultado['test'] = $html_tx;
        sleep(1);
        echo(json_encode($resultado));
    }

    /**
    * Valida test
    */
    public function validaTest(){   
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');  
        $this->autoRender = false;
        $resultado = array();
        $test = explode(',', $_POST["items"]);
        $respValid = 0;
        $flag = $_POST["fla"];
        $nivel = (isset($_POST["nivel"]))?$_POST["nivel"]:-1;
        
      	switch ($nivel) {
            case -1:
                $nivelTxt = "Preliminar";
                break;
            case 0:
                $nivelTxt = "Introducci&oacute;n";
                break;
            
            default:
                $nivelTxt = $nivel;
                break;
        }
        
        foreach ($test as $value) {
            $res = explode('_', $value);
            $idPreg = $res[0];
            $resp = $res[1];
            $query = "SELECT COUNT( * ) AS valid FROM preguntas WHERE id =".$idPreg." AND respuesta =".$resp."";
            $valid = $this->Pregunta->query($query);
            foreach ($valid as $value) {
                foreach ($value as $key => $val) {
                    $respValid = $respValid + $val["valid"];
                }
            }
        }
        //echo "Tienes ".$respValid." respuestas correctas";  

        if ($respValid <= 3) { 
            if($flag == 1){
                $resultado['option'] = "recomienda";
                $resultado['nivel'] = ($_POST["niv"] == -1)?-1:$_POST["niv"]-1;
                $resultado['flag'] = 0;
                $resultado['respuesta'] = $respValid;
                $resultado['nivelTxt'] = $nivelTxt;
            }else{
                $resultado['option'] = "random";
                $resultado['nivel'] = $_POST["niv"];
                $resultado['flag'] = $flag+1;
                $resultado['respuesta'] = $respValid;
				$resultado['nivelTxt'] = $nivelTxt;    
            }
        }else{
            if ($_POST["niv"] == 10) {
                $resultado['option'] = "recomienda";
                $resultado['nivel'] = 11;
                $resultado['flag'] = 0;
                $resultado['respuesta'] = $respValid;
				$resultado['nivelTxt'] = $nivelTxt;  
            }else{
                $resultado['option'] = "random";
                $resultado['nivel'] = $_POST["niv"]+1;
                $resultado['flag'] = 0;
                $resultado['respuesta'] = $respValid;
				$resultado['nivelTxt'] = $nivelTxt;
            }          
        }
        sleep(1);
        echo(json_encode($resultado));
    }
}

?>
