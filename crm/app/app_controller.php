<?php

class AppController extends Controller{

    public $components = array('Auth', 'Session');
    public $helpers = array('Crm','Session','Html','Form');
    var $levels=array(1=>"Usuario",2=>"Administrador",3=>"Master",4=>"Clicker");
    var $place_alias=array('alias'=>'distribuidor','label'=>'Distribuidor','lowercase'=>'distribuidor');
    var $uses = array('Place');
    public function beforeFilter() {
        $this->Auth->loginRedirect = array('controller' => 'prospects', 'action' => 'index');
        $this->set('place_alias',$this->place_alias);
    }

    protected function redirectToReferer(){
        $this->redirect( $this->referer() );
        exit();
    }
    protected function get_allowed_places(){
        $places=array();
        if($this->Session->read('Auth.User.level')>2){
            $places=$this->Place->find('list');
        }
        else{
            $places=$this->Place->find('list',array('conditions'=>array('Place.id'=>$this->Session->read('Auth.User.place_id'))));
        }
        return $places;
    }
}
?>