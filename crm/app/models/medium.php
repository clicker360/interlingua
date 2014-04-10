<?php

class Medium extends AppModel{

    var $name       = 'Media';
    var $belongsTo  = array('MediumCategory');
    var $hasMany    = array('Prospect' =>array('foreignKey'=>'medium_id'));
    var $actsAs = array('Containable');
}

?>
