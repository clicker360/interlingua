<?php

class Event extends AppModel{

    var $name       = 'Event';
    var $hasMany    = array();
    var $belongsTo  = array( 'User', 'Status', 'Prospect');
    var $actsAs     = array('Containable');
    
    public function obtainEventsOfProspect( $prospect_id=null){

        if( $prospect_id == null ){ return null; }
        return $this->find('all', array(
            'conditions' => array(
                'Event.prospect_id' => $prospect_id
            ),
            'order'   => array('Event.created DESC'),
            'contain' => array( 
                'Status' => array('StatusCategory'),
                'User'
            )
        ));
    }
    public function obtainEventsOfUser($user_id=null,$pre_conditions)
    {
        if( $user_id == null ){ return null; }
        
    }
}

?>
