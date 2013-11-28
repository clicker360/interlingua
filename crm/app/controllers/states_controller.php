<?php

class StatesController extends AppController{
    var $scaffold;
    var $uses = array( 'States', 'City');


    public function obtainCitiesByState( ){

        if( !isset( $this->params['form']['id'] )){
            exit();
        }

        $state_id = $this->params['form']['id'];
        $cities   = $this->City->find('all', array( 'conditions' => array('City.state_id' =>  $state_id)));
        $result   = array();

        foreach( $cities as $city ){

            array_push( $result , array(
                'id'    => $city['City']['id'],
                'name'  => $city['City']['name']
            ));
        }

        Configure::write('debug', 0);
        $this->autoRender = false;
        echo json_encode($result);
        exit( );
    }
}

?>
