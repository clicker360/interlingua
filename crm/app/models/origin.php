<?php

class Origin extends AppModel{

    var $name    = 'Origin';
    var $hasMany = array('Prospect');
    var $actsAs = array('Containable');
}

?>
