<?php

class State extends AppModel{

    var $name = 'State';
    var $hasMany = array('City');
    var $actsAs = array('Containable');
}

?>
