<?php

class Place extends AppModel{

    var $name    = 'Place';
    var $hasMany = array('Prospect', 'User');
    var $actsAs = array('Containable');
}

?>
