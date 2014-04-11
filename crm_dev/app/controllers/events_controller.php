<?php

class EventsController extends AppController{

    public $name = 'Events';
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
        'Event',
        'Status'
    );
    public $helpers=array('Calendar');
     public function beforeFilter() {
        if($this->Session->check('Auth.User')){
            $openEvents = $this->User->userHasOpenEvent($this->Session->read('Auth.User.id'));
            $this->set(compact('openEvents'));
        }
    }
    public function schedule_event(){
        

        if( !isset($this->params['id']) ){ // is id param defined?
            $this->redirect($this->referer());
            exit();
        }

        $prospect = $this->Prospect->findById( $this->params['id'] );

        if( !$prospect ){ // id doesn't correspond to any prospect?
            $this->redirect($this->referer());
            exit();
        }

        if( $this->Prospect->prospectHasOpenEvent( $prospect['Prospect']['id'] )){ // This prospect have open events?
            $this->Session->setFlash('Este prospecto tiene un evento abierto. No puede agendar un evento nuevo hasta que cierre el actual.');
            $this->redirect($this->referer());
            exit();
        }
        $events     = $this->Event->obtainEventsOfProspect( $prospect['Prospect']['id'] );
        $this->set( compact('events'));

        $title_for_layout     = 'Agendar Evento';
        $this->set( compact( 'title_for_layout', 'prospect' ) );
    }

    public function store_event() {

        if (!isset($this->data)) {
            $this->redirect($this->referer());
            exit();
        }

        // Date format adaptation
        list( $day, $month, $year ) = split('[/.-]', $this->data['Event']['date']);

        if ('pm' == $this->data['Event']['meridian'] && $this->data['Event']['hours'] != 12) { // 12 hour-based time specified as p.m.?
            $this->data['Event']['hours'] += 12;
        }

        $this->data['Event']['date'] = date('Y-m-d H:i:s', mktime($this->data['Event']['hours'], $this->data['Event']['minutes'], 0, $month, $day, $year));
        //Se cambia el identificador del evento del usuario por el que está en sesión.
        $this->data['Event']['user_id'] = $this->Session->read('Auth.User.id');
        
        if ($this->Event->save($this->data)) { // Was Event sucessfully saved?
            if ($this->data['Event']['now']) { // attend now?
                $this->redirect('/atender-evento/' . $this->Event->id);
            } else {
                $this->Session->setFlash('Evento agendado con éxito');
                $this->redirect('/');
            }
        } else {
            $this->Session->setFlash('Hubo un error, por favor intentar de nuevo.');
            $this->redirect('/agregar-evento/' . $this->data['Prospect']['id']);
        }
    }

    public function view(){ 

        if( !isset($this->params['id']) ){ // is id param defined?
            $this->redirect($this->referer());
            exit();
        }

        $event = $this->Event->find( 'first',array('conditions'=>array('Event.id'=>$this->params['id'] )));
        
        if( !$event ){ // id doesn't correspond to any event?
            $this->redirect($this->referer());
            exit();
        }

        $prospects = $this->Prospect->findById($event['Prospect']['id']);

        $title_for_layout   = 'Atender Evento';
        $events_history     = $this->Event->obtainEventsOfProspect( $event['Prospect']['id'] );
        $current_cities     = $this->City->find('list', array( 'conditions' => array( 'City.state_id' => $event['Prospect']['state_id'])));
        $states             = $this->State->find('list');
        $medium_categories  = $this->MediumCategory->find('list');
        $current_medium_cat = $this->Medium->field('medium_category_id', array('id' => $event['Prospect']['medium_id'] ));
        $current_media      = $this->Medium->find('list', array( 'conditions' => array( 'Medium.medium_category_id' => $current_medium_cat )));
        $genders            = $this->Gender->find('list',array('fields'=>'Gender.gender'));
        $origins            = $this->Origin->find('list');
        $status_categories  = $this->StatusCategory->find('list');

        $this->set( compact(
                'title_for_layout',
                'event',
                'events_history',
                'current_cities',
                'states',
                'medium_categories',
                'current_media',
                'genders',
                'origins',
                'current_medium_cat',
                'status_categories',
                'prospects'
        ));
    }

    /* AJAX */
    function store_event_ajax() {
        if (!isset($this->params['data']['Event'])) {
            $this->redirect($this->referer());
            exit();
        }

        $this->layout = 'ajax';
        $evento_futuro = 1;
        if (isset($this->data['Event']['id'])) { // This prospect have open events?
            //Se filtra el resultado por estatus finales. Y se valida que si no es final tenga un evento a futuro.
            //if(in_array($this->data['Event']['status_id'], array(2,5,10,11,12,15,26,20,25,24,27,28))){
            if(in_array($this->data['Event']['status_id'], array(2,27,32,34,43,35,11,12,15,41,42,43,44,28,46))){
            //if($this->data['Event']['status_id'] == 2 OR $this->data['Event']['status_id'] == 5 OR $this->data['Event']['status_id'] == 10 OR $this->data['Event']['status_id'] == 11 OR $this->data['Event']['status_id'] == 12  OR $this->data['Event']['status_id'] == 15 OR $this->data['Event']['status_id'] == 19) {
                $prospect_id = '';
                $evento_futuro = 0;
            } else {
                if($this->data['EventF']['event'] != '' AND $this->data['EventF']['date'] != '') {
                    $evento_futuro = 1;
                } else {
                    $evento_futuro = 2;
                }
                $prospect_id = $this->data['Event']['prospect_id'];
            }
            if($evento_futuro != 2) {
                $success = $this->Event->save($this->data) && !empty( $this->data['Event']['status_id']);
                if( $success ){
                    $date = new Datetime("now",new DateTimeZone('America/Mexico_City'));
                    $this->Prospect->validate = array();
                    $this->Prospect->read(null, $this->data['Event']['prospect_id']);
                    $this->Prospect->set('status_id',$this->data['Event']['status_id']);
                    $this->Prospect->set('last_contact_date', $date->format('Y-m-d H:i:s'));
                    $this->Prospect->save();
                    if($evento_futuro == 1) {
                        $this->Event->set('id',null);
                        //El evento se guardará con el usuario que está en sesión.
                        $this->Event->set('user_id', $this->Session->read('Auth.User.id'));
                        $this->Event->set('prospect_id', $this->data['Event']['prospect_id']);
                        $this->Event->set('subject', $this->data['EventF']['event']);
                        $this->Event->set('comments', $this->data['EventF']['comments']);

                        if( $this->data['EventF']['meridian'] == 'pm' && $this->data['EventF']['hour'] != '12') $this->data['EventF']['hour'] = $this->data['EventF']['hour'] + 12;
                        //$date_future = date_create_from_format('d-m-Y H:i', $this->data['EventF']['date'] . ' ' . $this->data['EventF']['hour'] . ':' . $this->data['EventF']['minute']);
                        $date_future = new DateTime($this->data['EventF']['date'] . ' ' . $this->data['EventF']['hour'] . ':' . $this->data['EventF']['minute']);
                        $date_future = date_format($date_future,'Y-m-d H:i');

                        $this->Event->set('date', $date_future);
                        $this->Event->save();
                    }
                }
                $this->set(compact('success','prospect_id'));
            } else {
                $store_future_event_message = true;
                $this->set(compact('store_future_event_message','prospect_id'));
            }
        } else {
            $store_event_message = true;
            $this->set(compact('store_event_message','prospect_id'));
        }
        //Evento a futuro.
    }

    function index($month=0,$year=0){
        $this->set(compact(array('month','year')));
        $this->set('users_place',$this->User->find('list',array('conditions'=>array('User.place_id'=>$this->Session->read('Auth.User.place_id')))));
        if($this->Session->read('Auth.User.level')>2 && $this->place_alias!=''){
          $this->set('places',$this->Place->find('list'));
        }
    }
    
    function get_events($month = -1, $year = -1, $place_id=-1, $user_id=-1){  
        $this->layout='ajax';
        if( $month == -1 ){
            $month      = ( isset($this->data['Event']['month']))       ? $this->data['Event']['month']      :0;
            $year       = ( isset($this->data['event']['year']))        ? $this->data['Event']['year']       :0;
        }

        if( $place_id == -1 ){
            $place_id   = ( isset($this->data['Event']['place_id']))? $this->data['Event']['place_id']:0;
        }
        if( $user_id == -1 ){
            $user_id    = ( isset($this->data['Event']['user_id'])) ? $this->data['Event']['user_id'] :0;
        }


        if($year==0){
            $year = date('Y');
        }
        if($month==0){
            $month = date('m');
        }

        switch($month){
            case 12:
                $pMonth=$month-1;
                $pYear=$year;
                $nMonth=1;
                $nYear=$year+1;
                break;
            case 1:
                $pMonth=12;
                $pYear=$year-1;
                $nMonth=$month+1;
                $nYear=$year;
                break;
            default:
                $pMonth=$month-1;
                $pYear=$year;
                $nMonth=$month+1;
                $nYear=$year;
        }

        $level = $this->Session->read('Auth.User.level');
        //don't show events for prospects that will not be contacted again.
        //$condition = ' AND (Prospect.status_id not in (2,5,10,11,12) OR (Prospect.status_id IS NULL))';
        $condition = '';
        $status=$this->Status->find('list');
        $categories=$this->StatusCategory->find('list');
        if($level <= 2 ){
                $condition .= " and (SELECT place_id from users as User WHERE Event.user_id = User.id) = ".$this->Session->read('Auth.User.place_id');

                if( $user_id != 0 ){
                        $condition .= (" and Event.user_id = ".$user_id);
                }
        }
        else if( $level > 2 ){
            $condition .= "";
            if( $place_id != 0 ){
                    $condition .= " and (SELECT place_id from users as User WHERE Event.user_id = User.id) = $place_id";
            }
            if( $user_id != 0 ){
                    $condition .= " and Event.user_id = $user_id";
            }
        }
        debug($condition);
        $this->Event->unbindModel(
                array(
                    'belongsTo' => array(
                        'Prospect',
                        'User',
                        'Status'
                        )
                    )
                );
        $mesAnterior = $this->Event->find('all',array('fields' => array(
            'Event.*',
            '(SELECT name FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_name',
            '(SELECT status_category_id FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_category_id',
            '(SELECT place_id from users as User WHERE Event.user_id = User.id) as place_id'
        ),'conditions'=>"EXTRACT(YEAR FROM Event.date) = $pYear AND EXTRACT(MONTH FROM Event.date) = $pMonth ".$condition/*,'contain'=>array('User','Prospect')*/));
        if(!empty($mesAnterior)){
            foreach($mesAnterior as $evento){
                $event['start'] = $evento['Event']['date'];
                $event['title'] = $evento['Event']['subject'];
                $event['description'] = $evento['Event']['comments'];
                $event['link'] = '/events/view/'.$evento['Event']['id'];
                $event['color'] = "#666666";
                $pDetail[]=$event;
            }

            $this->set('pDetail',$pDetail);
        }
        $this->Event->unbindModel(
                array(
                    'belongsTo' => array(
                        'Prospect',
                        'User',
                        'Status'
                        )
                    )
                );
        $GLOBALS["foo"] = 'adsf';
        $mesActual = $this->Event->find('all',array('fields' => array(
            'Event.*',
            '(SELECT name FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_name',
            '(SELECT status_category_id FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_category_id',
            '(SELECT place_id from users as User WHERE Event.user_id = User.id) as place_id'
        ),'conditions'=>'EXTRACT(YEAR FROM Event.date) = '.$year.' AND EXTRACT(MONTH FROM Event.date) = '. $month.' '.$condition/*,'contain'=>array('User','Prospect'=>array('Status'))*/,'order'=>'Event.date ASC'));
        if(!empty($mesActual)){
            foreach($mesActual as $evento){
                $event['start'] = $evento['Event']['date'];
                
                if(isset($evento['0']['status_category_id'])){
                    $event['title'] = $evento['Event']['subject'].': '.$categories[$evento['0']['status_category_id']].' - '.$evento['0']['status_name'];
                } else {
                    $event['title'] = 'Sin Status';
                }
                $event['description'] = $evento['Event']['comments'];
                $event['link'] = '/atender-evento/'.$evento['Event']['id'];
                $event['color'] = "#666666";
                if(!empty($evento['Event']['status_id']))
                {
                    $event['background-color']="#acffac";
                }
                else
                {
                    $event['background-color']="#FFFFFF";
                }
                $detail[]=$event;
            }
            $this->set('detail',$detail);
        }
        $this->Event->unbindModel(
                array(
                    'belongsTo' => array(
                        'Prospect',
                        'User',
                        'Status'
                        )
                    )
                );
        $mesSiguiente = $this->Event->find('all',array('fields' => array(
            'Event.*',
            '(SELECT name FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_name',
            '(SELECT status_category_id FROM statuses as Status WHERE Status.id = (SELECT status_id FROM prospects as Prospect WHERE Prospect.id = Event.prospect_id)) as status_category_id',
            '(SELECT place_id from users as User WHERE Event.user_id = User.id) as place_id'
        ),'conditions'=>"EXTRACT(YEAR FROM Event.date) = $nYear AND EXTRACT(MONTH FROM Event.date) = $nMonth ".$condition/*,'contain'=>array('User','Prospect')*/));
        if(!empty($mesSiguiente)){
            foreach($mesSiguiente as $evento){
                $event['start'] = $evento['Event']['date'];
                $event['title'] = $evento['Event']['subject'];
                $event['description'] = $evento['Event']['comments'];
                $event['link'] = '/agendas/view/'.$evento['Event']['id'];
                $event['color'] = "#666666";
                $nDetail[]=$event;
            }

            $this->set('nDetail',$nDetail);
        }

        //Previous Month
        $this->set('pYear',$pYear);
        $this->set('pMonth',$pMonth);
        //Actual Month
        $this->set('year',$year);
        $this->set('month',$month);
        //Next Month
        $this->set('nYear',$nYear);
        $this->set('nMonth',$nMonth);
    }

}
?>
