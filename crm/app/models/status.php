<?php

class Status extends AppModel{

    var $name       = 'Status';
    var $belongsTo  = array('StatusCategory'=>array('foreignKey'=>'status_category_id'));
    var $hasMany    = array('Prospect', 'Event');
    var $actsAs     = array('Containable');

}

?>
