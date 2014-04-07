<?php

class CitiesSchema extends CakeSchema {

	var $name = 'Cities';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $cities = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'state_id'           => array('type' => 'integer', 'null' => false, 'length' => 11),
            'name'               => array('type'=>'text', 'null' => true, 'default' => NULL),
            'created'            => array('type' => 'datetime', 'default' => null),
            'updated'            => array('type' => 'datetime', 'default' => null),
            'tableParameters'    => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>
