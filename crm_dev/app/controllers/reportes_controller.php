<?php

class ReportesController extends AppController {

    var $name = 'Reportes';
    var $uses = array('Prospect', 'User', 'Statuses', 'StatusCategories', 'Places', 'Origins','Event','StatusCategories');
    var $pageTitle = 'Reportes';
    var $components = array('Email');

    var $titulo = "1";
    var $cdt;

    function index() {
        $name = $this->reporteEficiencias(0);
        $this->reporteDDUA(0);
        $this->reporteEPS(0);

        if($name != ''){
           $this->set('name',$name);
        } else {
            $this->set('name','Todos los planteles');
        }
        if($this->Session->read('Auth.User.level')>2){
            $this->set('places',$this->Places->find('list'));
        }

        $places = $this->Places->find('all',array('order'=>array('Places.name')));
        $this->set('places',$places);
    }

    public function beforeFilter() {
        ini_set('memory_limit', '2048M');
        set_time_limit(5000);
    }

    function reporteDDUA($usuarioID) {
        //Intervalos de la gráfica.
        $ual = array(-1, 7, 15, 30);
        $uah = array(8, 16, 31);

        //Se generan las condiciones de la búsqueda.
        $qrConditions;
        $qrOptions;
        if($this->Session->read('Auth.User.level')==2){
            $qrOptions['Prospect.place_id'] = $this->Session->read('Auth.User.place_id');
        }
        else if($this->Session->read('Auth.User.level')==1){
            $qrOptions['Prospect.place_id'] = $this->Session->read('Auth.User.place_id');
            $qrOptions['Prospect.user_id'] = $this->Session->read('Auth.User.user_id');
        } else {
            $qrOptions['1'] = '1';
        }
        if (!empty($this->data['User']['id'])) {
            $qrOptions['Prospect.user_id'] = $this->data['User']['id'];
        }
        if (!empty($this->data['User']['place_id'])) {
            $qrOptions['Prospect.place_id'] = $this->data['User']['place_id'];
        }
        for ($k = 0; $k < 4; $k++) {
            $qrConditions[$k]['(DATEDIFF(CURDATE(),Prospect.last_contact_date)) >'] = $ual[$k];
            if ($k != 3) {
                $qrConditions[$k]['(DATEDIFF(CURDATE(),Prospect.last_contact_date)) <'] = $uah[$k];
            }
        }

        //Se realiza el query
        $totalua = 0;
        for($i = 0; $i < 4; $i++){
            $ultimaat[$i] = $this->Prospect->find('count', array('conditions' => array('AND' => array($qrConditions[$i], array($qrOptions)))));
            $totalua += $ultimaat[$i];
        }

        $this->set('totalua', $totalua);
        $this->set('ultimaat', $ultimaat);

        return true;
    }

    function reporteEPS($usuarioID) {

        $queryCond = '';
        if($this->Session->read('Auth.User.level')==1){
            $queryCond .= ' AND prospects.place_id = "' . $this->Session->read('Auth.User.place_id') . '"';
            $queryCond .= ' AND prospects.user_id = "' . $this->Session->read('Auth.User.id') . '"';
        }else{
            if (!empty($this->data['User']['place_id'])) {
                $queryCond .= ' AND prospects.place_id = "' . $this->data['User']['place_id'] . '"';
            }
            if (!empty($this->data['User']['id'])) {
                $queryCond .= ' AND prospects.user_id = "' . $this->data['User']['id'] . '"';
            }
        }
        // Se busca el número de visitas que tiene cada Prospects y se ordena en base a su Status.
        $dataEPS = $this->Prospect->query('SELECT statuses.id, status_categories.id, status_categories.name, prospects.id, prospects.name, events.id, events.status_id, COUNT( events.id ) AS noVisitas
        FROM prospects
        LEFT JOIN events ON events.prospect_id = prospects.id
        LEFT JOIN statuses ON statuses.id = prospects.status_id
        LEFT JOIN status_categories ON status_categories.id = statuses.status_category_id
        WHERE status_categories.id IN (0, 1, 2, 3 ) ' . $queryCond .
        'AND events.status_id IS NOT NULL'.$this->getPlaceUser().'
        GROUP BY prospects.id');
        // Se agrupan los Status y se calcula el promedio de visitas.
        $i = 0;
        $j = 0;
        $groups = array(
            0=>array(
                'alias'=>'venta',
                'label'=>'Venta',
                'status'=>array('5'),
                'prospects'=>0,
                'events'=>0
            ),
            1=>array(
                'alias'=>'contacto',
                'label'=>'Contacto Establecido',
                'status_categories'=>array('1'),
                'status'=>array('5'),
                'prospects'=>0,
                'events'=>0
            ),
            2=>array(
                'alias'=>'recado',
                'label'=>'Contacto Recado',
                'status_categories'=>array('2'),
                'prospects'=>0,
                'events'=>0
            ),
            3=>array(
                'alias'=>'sin_contacto',
                'label'=>'Sin Contacto Aún',
                'status_categories'=>array('3'),
                'prospects'=>0,
                'events'=>0
            ),
        );
        $nombreStatus = '';
        $tmpTotalEVS = 0;
        foreach($dataEPS as $dato){
            $matched=false;
            for($i=0;$i<count($groups) && !$matched;$i++){
                if((isset($groups[$i]['status_categories']) && in_array($dato['status_categories']['id'],$groups[$i]['status_categories']) && ((!isset($groups[$i]['status'])) || (isset($groups[$i]['status']) && !in_array($dato['statuses']['id'],$groups[$i]['status'])))) || (!isset($groups[$i]['status_categories']) && in_array($dato['statuses']['id'],$groups[$i]['status']) )){
                    $groups[$i]['prospects']+=1;
                    $groups[$i]['events']+=$dato[0]['noVisitas'];
                    $matched=true;
                }
            }
        }
        for($i=0;$i<count($groups);$i++){
            $evnom[$i]  = $groups[$i]['label'];
            $totevp[$i] = $groups[$i]['prospects'];
            $evs[$i]    = $groups[$i]['events'];
        }

        $this->set('totevp', $totevp);
        $this->set('evs', $evs);
        $this->set('evnom', $evnom);

        return true;
    }

    function reporteEficiencias($usuarioID) {

        $this->User->recursive = 0;
        $this->Prospect->recursive = 0;
        $this->Events->recursive = 0;
        $places=$this->Places->find('list');
        $cpre['AND'] = array('Prospect.status_id !=' => '10', array('Prospect.status_id !=' => '11', array('Prospect.status_id !=' => '12')));
        //cin. Variable para "Eficiencia de Cierre" busca por todas los prospectos con Categoría de Status de Venta.
        $cin['Prospect.status_id'] = 5;
        //cef. Variable para "Eficiencia de Contratación" busca todos los prospectos con Categoría de Status de Contacto Establecido.
        $cef = array('OR' => array(array('Prospect.status_id' => '1'), array('Prospect.status_id' => '2'), array('Prospect.status_id' => '3'), array('Prospect.status_id' => '4')));
        //cefe. Variable para "Eficiencia de Contacto Efectivo" busca todos los prospectos con Categoría de Status de Contacto Establecido menos los no interesados.
        $cefe = array('OR' => array(array('Prospect.status_id' => '1'), array('Prospect.status_id' => '3'), array('Prospect.status_id' => '4')));
        $ins=array();
        $efe=array();
        $efee=array();
        $numpr=array();
        $numpre=array();
        $usuariosp=array();
        $usuarios=array();
        /**/
        $sessData = $this->Session->read('Auth');

        if(!empty($this->data))
        {
            
	    if($sessData['User']['level']==1)
            {
                
                    $cpr['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $cpre['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $cev['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $cin['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $cef['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $cefe['Prospect.place_id']=$this->Session->read('Auth.User.place_id');
                    $usuarioss=$this->User->find('all',array('conditions'=>array('User.id' => $this->Session->read('Auth.User.id'),'User.active'=>1,'User.level <='=>3)));		    
                    	$usuarios=$this->User->find('list',array('fields'=>'User.username','conditions'=>array('User.id' => $this->Session->read('Auth.User.id'),'User.active'=>1,'User.level <='=>3)));
                    $this->set('usuarios',$usuarios);
                    for($i=0;$i<4;$i++)
                    {
                            $cuat[$i]['Prospect.place_id']=$this->data['User']['place_id'];
                    }
                    $name=$places[$this->data['User']['place_id']];               
            }
	    else if($sessData['User']['level']==2)
            {
                if(!empty($this->data['User']['place_id']))
                {
                    $cpr['Prospect.place_id']=$this->data['User']['place_id'];
                    $cpre['Prospect.place_id']=$this->data['User']['place_id'];
                    $cev['Prospect.place_id']=$this->data['User']['place_id'];
                    $cin['Prospect.place_id']=$this->data['User']['place_id'];
                    $cef['Prospect.place_id']=$this->data['User']['place_id'];
                    $cefe['Prospect.place_id']=$this->data['User']['place_id'];
                    $usuarioss=$this->User->find('all',array('conditions'=>array('User.place_id' => $this->data['User']['place_id'],'User.active'=>1,'User.level <='=>3)));		    
                    	$usuarios=$this->User->find('list',array('fields'=>'User.username','conditions'=>array('User.place_id' => $this->data['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
                    $this->set('usuarios',$usuarios);
                    for($i=0;$i<4;$i++)
                    {
                            $cuat[$i]['Prospect.place_id']=$this->data['User']['place_id'];
                    }
                    $name=$places[$this->data['User']['place_id']];
                }
                else
                {
                    $name='Todos los '.Inflector::Pluralize($this->place_alias['lowercase']);
                    $totev=0;
                    //Se seleccionan todos los usuarios.
                    $usuarioss=$this->User->find('all',array('conditions'=>array('User.active'=>1,'User.level <='=>3)));
                }
            }
            else
            {
                $cpr['Prospect.place_id']=$sessData['User']['place_id'];
                $cpre['Prospect.place_id']=$sessData['User']['place_id'];
                $cev['Prospect.place_id']=$sessData['User']['place_id'];
                $cin['Prospect.place_id']=$sessData['User']['place_id'];
                $cef['Prospect.place_id']=$sessData['User']['place_id'];
                $cefe['Prospect.place_id']=$sessData['User']['place_id'];
                $usuarioss=$this->User->find('all',array('conditions'=>array('User.place_id' => $this->data['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
                if($sessData['User']['level'] < 2)
                    	$usuarios=$this->User->find('list',array('fields'=>'User.username','conditions'=>array('User.place_id' => $this->data['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
		    else
			$usuarios=$this->User->find('list',array('fields'=>'User.username','conditions'=>array('User.active'=>1,'User.level <='=>3)));
                $this->set('usuarios',$usuarios);
                for($i=0;$i<4;$i++)
                {
                    $cuat[$i]['Prospect.place_id']=$sessData['User']['place_id'];
                }
                $name=$places[$sessData['User']['place_id']];
            }
            if(!empty($this->data['User']['id']))
            {
                $cpr['Prospect.user_id']=$this->data['User']['id'];
                $cpe['Prospect.user_id']=$this->data['User']['id'];
                $cev['Prospect.user_id']=$this->data['User']['id'];
                $cin['Prospect.user_id']=$this->data['User']['id'];
                $cef['Prospect.user_id']=$this->data['User']['id'];
                $cefe['Prospect.user_id']=$this->data['User']['id'];
                $usuarioss=$this->User->find('all',array('conditions'=>array('User.id'=>$this->data['User']['id'],'User.place_id' => $this->data['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
                $usuario=$this->User->find('User.id='.$this->data['User']['id']);
                $name=$usuario['User']['name'];
                $totev=0;
                for($i=0;$i<4;$i++)
                {
                    $cuat[$i]['Prospect.user_id']=$this->data['User']['id'];
                }
            }
        }
        else
        {
            if($sessData['User']['level']==2)
            {
                $cpr['Prospect.place_id']=$sessData['User']['place_id'];
                $cpre['Prospect.place_id']=$sessData['User']['place_id'];
                $cev['Prospect.place_id']=$sessData['User']['place_id'];
                $cin['Prospect.place_id']=$sessData['User']['place_id'];
                $cef['Prospect.place_id']=$sessData['User']['place_id'];
                $cefe['Prospect.place_id']=$sessData['User']['place_id'];
                $usuarioss=$this->User->find('all',array('conditions'=>array('User.place_id' => $sessData['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
                $usuarios=$this->User->find('list',array('fields'=>'User.username','conditions'=>array('User.place_id' => $sessData['User']['place_id'],'User.active'=>1,'User.level <='=>3)));
                $this->set('usuarios',$usuarios);
                for($i=0;$i<4;$i++)
                {
                        $cuat[$i]['Prospect.place_id']=$sessData['User']['place_id'];
                }
                $name=$places[$sessData['User']['place_id']];
            }
            else if($sessData['User']['level']==1)
            {
                $cev['Prospect.user_id']=$sessData['User']['id'];
                for($i=0;$i<4;$i++)
                {
                    $cuat[$i]['Prospect.user_id']=$sessData['User']['id'];
                }
                $usuario=$this->User->find('User.id='.$sessData['User']['id']);
                $usuarioss=$this->User->find('all',array('conditions'=>array('User.id' => $sessData['User']['id'],'User.active'=>1,'User.level <='=>3)));
                $name=$usuario['User']['name'];
            }
            else
            {
                
                $name='Todos los planteles';
                $usuarioss=$this->User->find('all',array('conditions'=>array('User.active'=>1,'User.level <='=>3)));
		$usuarios=$this->User->find('list',array('fields'=>array('User.id','User.name'),'conditions'=>array('User.active'=>1,'User.level <='=>3)));
            }
        }
        /**/
        /*$this->User->recursive = -1;
        foreach($this->User->find('all') as $user){
            $usuarios[$user['User']['id']] = $user['User']['name'];
        }*/
        /**/
        foreach ($usuarioss as $usuario) {
            $cpr['Prospect.user_id'] = $usuario['User']['id'];
            $cpre['Prospect.user_id'] = $usuario['User']['id'];
            $cin['Prospect.user_id'] = $usuario['User']['id'];
            $cef['Prospect.user_id'] = $usuario['User']['id'];
            $cefe['Prospect.user_id'] = $usuario['User']['id'];
            $cinp['Prospect.user_id'] = $usuario['User']['id'];
            $numpr[] = $this->Prospect->find('count', array('conditions' => $cpr));
            $numpre[] = $this->Prospect->find('count', array('conditions' => $cpre));
            $ins[] = $this->Prospect->find('count', array('conditions' => $cin));
            $efe[] = $this->Prospect->find('count', array('conditions' => $cef));
            $efee[] = $this->Prospect->find('count', array('conditions' => $cefe));
            $usuariosp[] = $this->Prospect->find('count', array('conditions' => array('Prospect.user_id=' . $usuario['User']['id'])));
        }
        $this->set('ins', $ins);
        $this->set('efe', $efe);
        $this->set('efee', $efee);
        $this->set('numpr', $numpr);
        $this->set('numpre', $numpre);
        $this->set('usuarios', $usuarios);
        $this->set('usuarioss', $usuarioss);
        $this->set('usuariosp', $usuariosp);

        $this->set('cpr', $cpr);
        $this->set('cpre', $cpre);
        $this->set('cef', $cef);
        $this->set('cefe', $cefe);
        $this->set('level', $sessData['User']['level']);

        return $name;
    }

    function queryConditions(){
        $sessData = $this->Session->read('Auth');

        if (!empty($this->data)) {
            if ($sessData['User']['level'] > 2) {
                if (!empty($sessData['User']['place_id'])) {
                    $cpr['Prospect.place_id'] = $this->data['User']['place_id'];
                    $cpre['Prospect.place_id'] = $this->data['User']['place_id'];
                    $cev['Prospect.place_id'] = $this->data['User']['place_id'];
                    $cin['Prospect.place_id'] = $this->data['User']['place_id'];
                    $cef['Prospect.place_id'] = $this->data['User']['place_id'];
                    $cefe['Prospect.place_id'] = $this->data['User']['place_id'];
                    $usuarioss = $this->User->find('all', array('conditions' => array('User.place_id' => $this->data['User']['place_id'], 'User.active' => 1, 'User.level <=' => 3)));
                    $usuarios = $this->User->find('list', array('fields' => 'User.username', 'conditions' => array('User.place_id' => $this->data['User']['place_id'], 'User.active' => 1, 'User.level <=' => 3)));
                    $this->set('usuarios', $usuarios);
                    for ($i = 0; $i < 4; $i++) {
                        $cuat[$i]['Prospect.place_id'] = $this->data['User']['place_id'];
                    }
                    $name = $placees[$this->data['User']['place_id']];
                    if (empty($this->data['User']['id'])) {
                        for ($y = 0; $y < 4; $y++) {
                            $evcond[$y] = 'Prospect.place_id=' . $this->data['User']['place_id'] . $evcond[$y];
                        }
                    }
                } else {
                    $name = 'Todos los planteles';
                    $totev = 0;
                    $usuarioss = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.level <=' => 3)));
                    for ($y = 0; $y < 4; $y++) {
                        $evcond[$y] = '1=1' . $evcond[$y];
                    }
                }
            } else {
                $cpr['Prospect.place_id'] = $this->Session->read('place');
                $cpre['Prospect.place_id'] = $this->Session->read('place');
                $cev['Prospect.place_id'] = $this->Session->read('place');
                $cin['Prospect.place_id'] = $this->Session->read('place');
                $cef['Prospect.place_id'] = $this->Session->read('place');
                $cefe['Prospect.place_id'] = $this->Session->read('place');
                $usuarioss = $this->User->find('all', array('conditions' => array('User.place_id' => $this->data['User']['place_id'], 'User.active' => 1, 'User.level <=' => 3)));
                $usuarios = $this->User->find('list', array('fields' => 'User.username', 'conditions' => array('User.place_id' => $this->Session->read('place'), 'User.active' => 1, 'User.level <=' => 3)));
                $this->set('usuarios', $usuarios);
                for ($i = 0; $i < 4; $i++) {
                    $cuat[$i]['Prospect.place_id'] = $this->Session->read('place');
                }
                $name = $placees[$this->Session->read('place')];
                if (empty($this->data['User']['id'])) {
                    for ($y = 0; $y < 4; $y++) {
                        $evcond[$y] = 'Prospect.place_id=' . $this->data['User']['place_id'] . $evcond[$y];
                    }
                }
            }
            if (!empty($this->data['User']['id'])) {
                $cpr['Prospect.user_id'] = $this->data['User']['id'];
                $cpe['Prospect.user_id'] = $this->data['User']['id'];
                $cev['Prospect.user_id'] = $this->data['User']['id'];
                $cin['Prospect.user_id'] = $this->data['User']['id'];
                $cef['Prospect.user_id'] = $this->data['User']['id'];
                $cefe['Prospect.user_id'] = $this->data['User']['id'];
                $usuarioss = $this->User->find('all', array('conditions' => array('User.place_id' => $this->data['User']['place_id'], 'User.active' => 1, 'User.level <=' => 3)));
                $usuario = $this->User->find('User.id=' . $this->data['User']['id']);
                $name = $usuario['User']['name'];
                $totev = 0;
                for ($i = 0; $i < 4; $i++) {
                    $cuat[$i]['Prospect.user_id'] = $this->data['User']['id'];
                }
                for ($y = 0; $y < 4; $y++) {
                    $evcond[$y] = 'Prospect.user_id=' . $this->data['User']['id'] . $evcond[$y];
                }
            }
        } else {
            if ($this->Session->read('level') == 2) {
                $cpr['Prospect.place_id'] = $this->Session->read('place');
                $cpre['Prospect.place_id'] = $this->Session->read('place');
                $cev['Prospect.place_id'] = $this->Session->read('place');
                $cin['Prospect.place_id'] = $this->Session->read('place');
                $cef['Prospect.place_id'] = $this->Session->read('place');
                $cefe['Prospect.place_id'] = $this->Session->read('place');
                $usuarioss = $this->User->find('all', array('conditions' => array('User.place_id' => $this->Session->read('place'), 'User.active' => 1, 'User.level <=' => 3)));
                $usuarios = $this->User->find('list', array('fields' => 'User.username', 'conditions' => array('User.place_id' => $this->Session->read('place'), 'User.active' => 1, 'User.level <=' => 3)));
                $this->set('usuarios', $usuarios);
                for ($i = 0; $i < 4; $i++) {
                    $cuat[$i]['Prospect.place_id'] = $this->Session->read('place');
                }
                $name = $placees[$this->Session->read('place')];
                $totev = 0;
                for ($y = 0; $y < 4; $y++) {
                    $evcond[$y] = 'Prospect.place_id=' . $this->Session->read('place') . $evcond[$y];
                }
            } else if ($this->Session->read('level') == 1) {
                $cev['Prospect.user_id'] = $sessData['User']['id'];
                for ($i = 0; $i < 4; $i++) {
                    $cuat[$i]['Prospect.user_id'] = $sessData['User']['id'];
                }
                $usuario = $this->User->find('User.id=' . $sessData['User']['id']);
                $usuarioss = $this->User->find('all', array('conditions' => array('User.place_id' => $this->Session->read('place'), 'User.active' => 1, 'User.level <=' => 3)));
                $name = $usuario['User']['name'];
                for ($y = 0; $y < 4; $y++) {
                    $evcond[$y] = 'Prospect.user_id=' . $sessData['User']['id'] . $evcond[$y];
                }
            } else {
                $name = 'Todos los planteles';
                $usuarioss = $this->User->find('all', array('conditions' => array('User.active' => 1, 'User.level <=' => 3)));
                for ($y = 0; $y < 4; $y++) {
                    $evcond[$y] = '1=1' . $evcond[$y];
                }
            }
        }

        return false;
    }

    function detallesVariables(){
        $tipo_fecha = ($this->data['Reporte']['tipo_fecha']==1)?'created':'last_contact_date';
        switch ($this->data['Reporte']['tipo']) {
            case 1:
                $fecha = date('Y-m-d');
                //$conditions = ' DATE_FORMAT(Prospecto.'.$tipo_fecha.',\'%Y-%m-%d\') = \''.$fecha.'\'';
                $this->titulo = 'Reporte del día.';
                $this->cdt['DATE_FORMAT(Prospect.' . $tipo_fecha . ',\'%Y-%m-%d\')'] = $fecha;
                break;
            case 2:
                $fecha = date('Y-m-d', strtotime('-7 days'));
                //$conditions = ' Prospecto.'.$tipo_fecha.' >= \''.$fecha.'\'';
                $this->titulo = 'Reporte del ' . $fecha . ' hasta el día de hoy.';
                $this->cdt['Prospect.' . $tipo_fecha . ' >='] = $fecha;
                break;
            case 3:
                $fecha = date('Y-m-d', strtotime('-1 month'));
                //$conditions = ' Prospecto.'.$tipo_fecha.' >= \''.$fecha.'\'';
                $this->cdt['Prospect.' . $tipo_fecha . ' >='] = $fecha;
                $this->titulo = 'Reporte del ' . $fecha . ' hasta el día de hoy.';
                break;
            case 4:
                $fecha_inicio = $this->Event->deconstruct('date',$this->data['Reporte']['fecha_inicial']);
                $fecha_final = str_replace('00:00:00', '23:59:59', $this->Event->deconstruct('date',$this->data['Reporte']['fecha_final']));
                $this->data['Reporte']['fecha_inicial'] = $this->Event->deconstruct('date',$this->data['Reporte']['fecha_inicial']);
                $this->data['Reporte']['fecha_final'] = $this->Event->deconstruct('date',$this->data['Reporte']['fecha_final']);
                //$conditions = ' DATE_FORMAT(Prospects.' . $tipo_fecha . ',\'%Y-%m-%d\') between STR_TO_DATE(\'' . $fecha_inicio . '\',\'%Y-%m-%d\') and STR_TO_DATE(\'' . $fecha_final . '\',\'%Y-%m-%d\')';
                $this->cdt['DATE_FORMAT(Prospect.' . $tipo_fecha . ',\'%Y-%m-%d %H:%i:%s\') BETWEEN ? AND ?'] = array($fecha_inicio, $fecha_final);
                $this->titulo = 'Reporte del ' . $fecha_inicio . ' al ' . $fecha_final;

                break;
            case 5:
                $fecha_inicio = $this->Event->deconstruct('date',$this->data['Reporte']['fecha_unica']);
                $fecha_final = str_replace('00:00:00', '23:59:59', $fecha_inicio, $this->Event->deconstruct('date',$this->data['Reporte']['fecha_unica']));                
                $this->data['Reporte']['fecha_unica'] = $this->Event->deconstruct('date',$this->data['Reporte']['fecha_unica']);                
                //$conditions = ' DATE_FORMAT(Prospects.' . $tipo_fecha . ',\'%Y-%m-%d\') between STR_TO_DATE(\'' . $fecha_inicio . '\',\'%Y-%m-%d\') and STR_TO_DATE(\'' . $fecha_final . '\',\'%Y-%m-%d\')';
                $this->cdt['DATE_FORMAT(Prospect.' . $tipo_fecha . ',\'%Y-%m-%d %H:%i:%s\') BETWEEN ? AND ?'] = array($fecha_inicio, $fecha_final);
                $this->titulo = 'Reporte del ' . $fecha_inicio . ' al ' . $fecha_final;

                break;
            default:
                $this->titulo = '';
                return false;
                //debug('NONE');
                break;
        }
        return true;
    }

    function detalle_plantel() {  
        $lugar_id = $this->data['lugar'];
        $lugar_id = explode("|", $lugar_id);

        //print_r($this->data['lugar']);
	    //Configure::write('debug',2);
        if(!$this->detallesVariables()) exit();
        // Se buscan los prospectos y categorías que se utilizarán.
		$status = $this->Statuses->find('all',array('order'=>array('Statuses.status_category_id')));
        $statusCategories = $this->StatusCategories->find('all');
        /**/
        $conditions = '';
        if($this->Session->read('Auth.User.level')==1){
            $conditions['User.id'] = $this->Session->read('Auth.User.id');
        } else if($this->Session->read('Auth.User.level') >= 2){
            if($this->data['Reporte']['user_id']){
                $conditions['User.id'] = $this->data['Reporte']['user_id'];                
            }else{
                if($this->Session->read('Auth.User.level') == 2){
                    $conditions = array(
                        'OR'=>array(
                            array(
                                'User.place_id'=> $this->Session->read('Auth.User.place_id')
                            ),
                            array(
                                'User.user_id'=>$this->Session->read('Auth.User.id')
                            )
                        )
                    );
                }
            }
           
        }
        /**/
	$this->User->unBindModel(array(
		'hasMany' => array(
			'Prospect',
			'Event'		
		)
	));
        $usuarios = $this->User->find('all',array('conditions'=>$conditions));
        //$usuarios = $this->User->find('all');	    

        foreach($statusCategories as $statusCategorie){
            $arrCategories[$statusCategorie['StatusCategories']['id']] = $statusCategorie['StatusCategories']['name'];
        }
        $this->set('arrCategories',$arrCategories);
        $this->set('usuarios',$usuarios);

        $nameCategorie = '';
        $antCat = '';
        $l = 0;

        if($lugar_id[0] == "true"){
            foreach ($usuarios as $usuario) {
                foreach ($status as $s) {
                    if($nameCategorie != $s['Statuses']['status_category_id']){
                        $cntCategories[$antCat] = $l;
                        $nameCategorie = $s['Statuses']['status_category_id'];
                        $antCat = $s['Statuses']['status_category_id'];
                        $l = 1;
                    }else{
                        $l += 1;
                    }
                    for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                        $totalpds[$s['Statuses']['status_category_id']][$k] = 0;
                    }
                    $totalpp[$usuario['User']['id']][$s['Statuses']['id']] = 0;
                    $totalps[$s['Statuses']['id']] = 0;
                }
            }
        }else{
            foreach ($usuarios as $usuario) {
                if ($usuario['User']['place_id']==$lugar_id[0]) {
                    foreach ($status as $s) {
                        if($nameCategorie != $s['Statuses']['status_category_id']){
                            $cntCategories[$antCat] = $l;
                            $nameCategorie = $s['Statuses']['status_category_id'];
                            $antCat = $s['Statuses']['status_category_id'];
                            $l = 1;
                        }else{
                            $l += 1;
                        }
                        for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                            $totalpds[$s['Statuses']['status_category_id']][$k] = 0;
                        }
                        $totalpp[$usuario['User']['id']][$s['Statuses']['id']] = 0;
                        $totalps[$s['Statuses']['id']] = 0;
                    }
                }
            }
        }

        $cntCategories[$nameCategorie] = $l;
        $this->set('cntCategories',$cntCategories);

        $nameCategorie = '';
        $antCat = '';
        $l = 0;

        $totalss = 0;
        $totalsa = 0;
        $totalsat = 0;
        $totalas = 0;	
        if($lugar_id[0] == "true"){

            foreach ($usuarios as $usuario) {
                foreach ($status as $s) {
                    for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
    		    $this->Prospect->unBindModel(array(
    			'belongsTo' => array(
    				'User',
    				'Place',
    				'Origin',
    				'Status',
    				'Medium',
    				'State',
    				'City',
    				'Gender'	
    			)
    		    ));
                        $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.status_id' => $s['Statuses']['id'], 'Prospect.user_id' => $usuario['User']['id']))));
                        if ($s['Statuses']['status_category_id'] != 37) {
                            $totalpp[$usuario['User']['id']][$s['Statuses']['id']]+=$datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                        }
                    }
                    $totalps[$s['Statuses']['id']]+=$totalpp[$usuario['User']['id']][$s['Statuses']['id']];
                }
    $this->Prospect->unBindModel(array(
    			'belongsTo' => array(
    				'User',
    				'Place',
    				'Origin',
    				'Status',
    				'Medium',
    				'State',
    				'City',
    				'Gender'	
    			)
    		    ));
                $sinstatus[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'AND' => array('OR' => array(array('Prospect.status_id' => null), array('Prospect.status_id' => 0)), 'AND' => array('Prospect.user_id' => $usuario['User']['id'], 'Prospect.user_id !=' => null))))));
    $this->Prospect->unBindModel(array(
    			'belongsTo' => array(
    				'User',
    				'Place',
    				'Origin',
    				'Status',
    				'Medium',
    				'State',
    				'City',
    				'Gender'	
    			)
    		    ));            
    	$sinasignar[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                //$totalsata[$i]=$sinstatus[$i]+$sinasignar[$i];
    		$this->Prospect->unBindModel(array(
    			'belongsTo' => array(
    				'User',
    				'Place',
    				'Origin',
    				'Status',
    				'Medium',
    				'State',
    				'City',
    				'Gender'	
    			)
    		    ));
                $totalsata[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => $usuario['User']['id'], 'OR' => array(array('Prospect.status_id' => null), 'Prospect.status_id' => 0)))));
                $totalss+=$sinstatus[$usuario['User']['id']];
                $totalsa+=$sinasignar[$usuario['User']['id']];
                $totalsat+=$totalsata[$usuario['User']['id']];
    		$this->Prospect->unBindModel(array(
    			'belongsTo' => array(
    				'User',
    				'Place',
    				'Origin',
    				'Status',
    				'Medium',
    				'State',
    				'City',
    				'Gender'	
    			)
    		    ));
                $asignados[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id !=' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                $totalas+=$asignados[$usuario['User']['id']];
            }
        }else{
            foreach ($usuarios as $usuario) {
                if ($usuario['User']['place_id']==$lugar_id[0]) {
                    foreach ($status as $s) {
                        for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                    $this->Prospect->unBindModel(array(
                    'belongsTo' => array(
                        'User',
                        'Place',
                        'Origin',
                        'Status',
                        'Medium',
                        'State',
                        'City',
                        'Gender'    
                    )
                    ));
                            $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.status_id' => $s['Statuses']['id'], 'Prospect.user_id' => $usuario['User']['id']))));
                            if ($s['Statuses']['status_category_id'] != 37) {
                                $totalpp[$usuario['User']['id']][$s['Statuses']['id']]+=$datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                            }
                        }
                        $totalps[$s['Statuses']['id']]+=$totalpp[$usuario['User']['id']][$s['Statuses']['id']];
                    }
        $this->Prospect->unBindModel(array(
                    'belongsTo' => array(
                        'User',
                        'Place',
                        'Origin',
                        'Status',
                        'Medium',
                        'State',
                        'City',
                        'Gender'    
                    )
                    ));
                    $sinstatus[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'AND' => array('OR' => array(array('Prospect.status_id' => null), array('Prospect.status_id' => 0)), 'AND' => array('Prospect.user_id' => $usuario['User']['id'], 'Prospect.user_id !=' => null))))));
        $this->Prospect->unBindModel(array(
                    'belongsTo' => array(
                        'User',
                        'Place',
                        'Origin',
                        'Status',
                        'Medium',
                        'State',
                        'City',
                        'Gender'    
                    )
                    ));            
            $sinasignar[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                    //$totalsata[$i]=$sinstatus[$i]+$sinasignar[$i];
                $this->Prospect->unBindModel(array(
                    'belongsTo' => array(
                        'User',
                        'Place',
                        'Origin',
                        'Status',
                        'Medium',
                        'State',
                        'City',
                        'Gender'    
                    )
                    ));
                    $totalsata[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => $usuario['User']['id'], 'OR' => array(array('Prospect.status_id' => null), 'Prospect.status_id' => 0)))));
                    $totalss+=$sinstatus[$usuario['User']['id']];
                    $totalsa+=$sinasignar[$usuario['User']['id']];
                    $totalsat+=$totalsata[$usuario['User']['id']];
                $this->Prospect->unBindModel(array(
                    'belongsTo' => array(
                        'User',
                        'Place',
                        'Origin',
                        'Status',
                        'Medium',
                        'State',
                        'City',
                        'Gender'    
                    )
                    ));
                    $asignados[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id !=' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                    $totalas+=$asignados[$usuario['User']['id']];
                }
            }
        }

        
        $this->set('status', $status);
        $this->set('datos', $datos);
        $this->set('totalps', $totalps);
        $this->set('sinstatus', $sinstatus);
        $this->set('sinasignar', $sinasignar);
        $this->set('totalsata', $totalsata);
        $this->set('totalss', $totalss);
        $this->set('totalsa', $totalsa);
        $this->set('totalsat', $totalsat);
        $this->set('totalas', $totalas);
        $this->set('asignados', $asignados);
        $this->set('data', $this->data);
        $this->set('titulo', $this->titulo);
    }

    function detalleplantelxls() {
        $lugar_id = $this->data['lugar'];
        $lugar_id = explode("|", $lugar_id);

        $this->layout = 'xls';
        if(!$this->detallesVariables()) exit();
        // Se buscan los prospectos y categorías que se utilizarán.
	$status = $this->Statuses->find('all',array('order'=>array('Statuses.status_category_id')));
        $statusCategories = $this->StatusCategories->find('all');
        /**/
        $conditions = '';
        if($this->Session->read('Auth.User.level')==1){
            $conditions['User.id'] = $this->Session->read('Auth.User.id');
        } else if($this->Session->read('Auth.User.level') >= 2){
            if($this->data['Reporte']['user_id']){
                $conditions['User.id'] = $this->data['Reporte']['user_id'];                
            }else{
                if($this->Session->read('Auth.User.level') == 2){
                    $conditions = array(
                        'OR'=>array(
                            array(
                                'User.place_id'=> $this->Session->read('Auth.User.place_id')
                            ),
                            array(
                                'User.user_id'=>$this->Session->read('Auth.User.id')
                            )
                        )
                    );
                }
            }
           
        }
        /**/
        $usuarios = $this->User->find('all',array('conditions'=>$conditions));
        //$usuarios = $this->User->find('all');

        foreach($statusCategories as $statusCategorie){
            $arrCategories[$statusCategorie['StatusCategories']['id']] = $statusCategorie['StatusCategories']['name'];
        }
        $this->set('arrCategories',$arrCategories);
        $this->set('usuarios',$usuarios);

        $nameCategorie = '';
        $antCat = '';
        $l = 0;
        if($lugar_id[0] == "true"){
            foreach ($usuarios as $usuario) {
                foreach ($status as $s) {
                    if($nameCategorie != $s['Statuses']['status_category_id']){
                        $cntCategories[$antCat] = $l;
                        $nameCategorie = $s['Statuses']['status_category_id'];
                        $antCat = $s['Statuses']['status_category_id'];
                        $l = 1;
                    }else{
                        $l += 1;
                    }
                    for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                        $totalpds[$s['Statuses']['status_category_id']][$k] = 0;
                    }
                    $totalpp[$usuario['User']['id']][$s['Statuses']['id']] = 0;
                    $totalps[$s['Statuses']['id']] = 0;
                }
            }
        }else{
            foreach ($usuarios as $usuario) {
                if ($usuario['User']['place_id']==$lugar_id[0]) {
                    foreach ($status as $s) {
                        if($nameCategorie != $s['Statuses']['status_category_id']){
                            $cntCategories[$antCat] = $l;
                            $nameCategorie = $s['Statuses']['status_category_id'];
                            $antCat = $s['Statuses']['status_category_id'];
                            $l = 1;
                        }else{
                            $l += 1;
                        }
                        for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                            $totalpds[$s['Statuses']['status_category_id']][$k] = 0;
                        }
                        $totalpp[$usuario['User']['id']][$s['Statuses']['id']] = 0;
                        $totalps[$s['Statuses']['id']] = 0;
                    }
                }
            }
        }

        $cntCategories[$nameCategorie] = $l;
        $this->set('cntCategories',$cntCategories);

        $nameCategorie = '';
        $antCat = '';
        $l = 0;

        $totalss = 0;
        $totalsa = 0;
        $totalsat = 0;
        $totalas = 0;
        if($lugar_id[0] == "true"){
            foreach ($usuarios as $usuario) {
                foreach ($status as $s) {
                    for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                        $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.status_id' => $s['Statuses']['id'], 'Prospect.user_id' => $usuario['User']['id']))));

                        if ($s['Statuses']['status_category_id'] != 37) {
                            $totalpp[$usuario['User']['id']][$s['Statuses']['id']]+=$datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                        }
                    }
                    $totalps[$s['Statuses']['id']]+=$totalpp[$usuario['User']['id']][$s['Statuses']['id']];
                }
                $sinstatus[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'AND' => array('OR' => array(array('Prospect.status_id' => null), array('Prospect.status_id' => 0)), 'AND' => array('Prospect.user_id' => $usuario['User']['id'], 'Prospect.user_id !=' => null))))));
                $sinasignar[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                //$totalsata[$i]=$sinstatus[$i]+$sinasignar[$i];
                $totalsata[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => $usuario['User']['id'], 'OR' => array(array('Prospect.status_id' => null), 'Prospect.status_id' => 0)))));
                $totalss+=$sinstatus[$usuario['User']['id']];
                $totalsa+=$sinasignar[$usuario['User']['id']];
                $totalsat+=$totalsata[$usuario['User']['id']];
                $asignados[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id !=' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                $totalas+=$asignados[$usuario['User']['id']];
            }
        }else{
            foreach ($usuarios as $usuario) {
                if ($usuario['User']['place_id']==$lugar_id[0]) {
                    foreach ($status as $s) {
                        for ($k = 0; $k < count($s['Statuses']['status_category_id']); $k++) {
                            $datos[$usuario['User']['id']][$s['Statuses']['id']][$k] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.status_id' => $s['Statuses']['id'], 'Prospect.user_id' => $usuario['User']['id']))));

                            if ($s['Statuses']['status_category_id'] != 37) {
                                $totalpp[$usuario['User']['id']][$s['Statuses']['id']]+=$datos[$usuario['User']['id']][$s['Statuses']['id']][$k];
                            }
                        }
                        $totalps[$s['Statuses']['id']]+=$totalpp[$usuario['User']['id']][$s['Statuses']['id']];
                    }
                    $sinstatus[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'AND' => array('OR' => array(array('Prospect.status_id' => null), array('Prospect.status_id' => 0)), 'AND' => array('Prospect.user_id' => $usuario['User']['id'], 'Prospect.user_id !=' => null))))));
                    $sinasignar[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                    //$totalsata[$i]=$sinstatus[$i]+$sinasignar[$i];
                    $totalsata[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id' => $usuario['User']['id'], 'OR' => array(array('Prospect.status_id' => null), 'Prospect.status_id' => 0)))));
                    $totalss+=$sinstatus[$usuario['User']['id']];
                    $totalsa+=$sinasignar[$usuario['User']['id']];
                    $totalsat+=$totalsata[$usuario['User']['id']];
                    $asignados[$usuario['User']['id']] = $this->Prospect->find('count', array('conditions' => array('AND' => array($this->cdt, 'Prospect.user_id !=' => null, 'Prospect.user_id' => $usuario['User']['id']))));
                    $totalas+=$asignados[$usuario['User']['id']];
                }
            }
        }
        
        $this->set('status', $status);
        $this->set('datos', $datos);
        $this->set('totalps', $totalps);
        $this->set('sinstatus', $sinstatus);
        $this->set('sinasignar', $sinasignar);
        $this->set('totalsata', $totalsata);
        $this->set('totalss', $totalss);
        $this->set('totalsa', $totalsa);
        $this->set('totalsat', $totalsat);
        $this->set('totalas', $totalas);
        $this->set('asignados', $asignados);
        $this->set('data', $this->data);
        $this->set('titulo', $this->titulo);
    }

    function createConditionsByLevel($place=null,$user=null){
        $cond = '';
        if($place != null) {
            $cond.=' AND prospects.place_id='.$place;
        }
        if($user != null) {
            $cond.=' AND prospects.user_id='.$user;
        }
        return $cond;
    }
    
    function getPlaceUser(){
        $place=null;
        $user=null;
        if($this->Session->read('Auth.User.level')<3){
            $place=$this->Session->read('Auth.User.place_id');
        }
        if($this->Session->read('Auth.User.level')==1){
            $null=$this->Session->read('Auth.User.user_id');
        }
        return $this->createConditionsByLevel($place,$user);
    }
}

?>
