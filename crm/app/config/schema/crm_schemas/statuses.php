<?php

class StatusesSchema extends CakeSchema {

	var $name = 'Statuses';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $statuses = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'status_category_id' => array('type' => 'integer', 'null' => false, 'length' => 11),
            'name'               => array('type'=>'text', 'null' => true, 'default' => NULL),
            'priority'           => array('type' => 'integer', 'null' => false, 'length' => 11),
            'slack_days'         => array('type' => 'integer', 'null' => false, 'length' => 11),
            'created'            => array('type' => 'datetime', 'default' => null),
            'updated'            => array('type' => 'datetime', 'default' => null),
            'tableParameters'    => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>
