<?php

class User extends AppModel{

    var $name       = 'User';
    var $belongsTo  = array('Place');
    var $hasMany    = array('Prospect', 'Event');
    var $actsAs = array('Containable');

    public function userHasOpenEvent($user_id=null) {
        $count = $this->Event->find('all', array(
                    'conditions' => array(
                        'Event.user_id' => $user_id,
                        'Event.status_id' => 0
                    )
                ));

        return $count;
    }

//    var $validate   = array(
//        'username' => array(
//            'rule'      => 'notEmpty',
//            'required'  => true,
//            'message'   => 'Sólo se permiten letras'
//        ),
//        'password' => array(
//            'required' => true
//        ),
//        'name' => array(
//            'rule' => 'notEmpty',
//            'required' => true,
//            'message' => 'Sólo se permiten letras'
//        ),
//        'email' => array(
//            'rule' => 'email',
//            'required' => true,
//            'message' => 'Introducir una dirección de correo válida'
//        ),
//        'area_code' => array(
//            'rule' => 'numeric',
//            'required' => true,
//            'message' => 'Sólo se permiten números'
//        ),
//        'phone_number' => array(
//            'rule' => 'numeric',
//            'required' => true,
//            'message' => 'Sólo se permiten números'
//        ),
//        'place_id' => array(
//            'required' => true
//        ),
//        'active' => array(
//            'required' => true
//        )
//    );
}

?>
