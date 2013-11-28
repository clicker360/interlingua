<?php

class MediumCategory extends AppModel{

    var $name    = 'MediumCategory';
    var $hasMany = array('Medium');
    var $actsAs = array('Containable');
}

?>
