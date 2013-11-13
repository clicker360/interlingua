<?php
class StatusCategory extends AppModel{

    var $name       = 'StatusCategory';
    var $useTable   = 'status_categories';
    var $hasMany    = array('Status'=>array('foreignKey'=>'status_category_id'));
    var $actsAs     = array('Containable');
}
?>
