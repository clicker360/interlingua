<?php

class EventsSchema extends CakeSchema {

	var $name = 'Events';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $events = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'user_id'            => array('type' => 'integer', 'null' => false, 'length' => 11),
            'status_id'          => array('type' => 'integer', 'null' => false, 'length' => 11),
            'prospect_id'        => array('type' => 'integer', 'null' => false, 'length' => 11),
            'subject'            => array('type'=>'text', 'null' => true, 'default' => NULL),
            'comments'           => array('type'=>'text', 'null' => true, 'default' => NULL),
            'date'               => array('type' => 'datetime', 'default' => null),
            'created'            => array('type' => 'datetime', 'default' => null),
            'updated'            => array('type' => 'datetime', 'default' => null),
            'tableParameters'    => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>