<?php

class Gender extends AppModel{

    var $name     = 'Gender';
    var $hasMany  = array('Prospect');
    var $actsAs = array('Containable');



    function list_genders(){
        return $this->find('list');
    }
}

?>
