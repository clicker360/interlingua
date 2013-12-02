<?php

class City extends AppModel{

    var $name       = 'City';
    var $belongsTo  = array('State');
    var $hasMany    = array('Prospect');
    var $actsAs = array('Containable');
}

?>
