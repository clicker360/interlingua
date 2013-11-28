<?php

class PlacesSchema extends CakeSchema {

	var $name = 'Places';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $places = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'name'               => array('type'=>'text', 'null' => true, 'default' => NULL),
            'created'            => array('type' => 'datetime', 'default' => null),
            'updated'            => array('type' => 'datetime', 'default' => null),
            'tableParameters'    => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>