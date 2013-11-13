<?php

class UsersSchema extends CakeSchema {

	var $name = 'Users';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $users = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'place_id'           => array('type' => 'integer', 'null' => false, 'length' => 11),
            'name'               => array('type'=>'text', 'null' => true, 'default' => NULL),
            'username'           => array('type'=>'text', 'null' => true, 'default' => NULL),
            'password'           => array('type'=>'text', 'null' => true, 'default' => NULL),
            'email'              => array('type'=>'text', 'null' => true, 'default' => NULL),
            'area_code'          => array('type'=>'text', 'null' => true, 'default' => NULL),
            'phone_number'       => array('type'=>'text', 'null' => true, 'default' => NULL),
            'active'             => array('type' => 'integer', 'null' => false, 'length' => 11),
            'created'            => array('type' => 'datetime', 'default' => null),
            'updated'            => array('type' => 'datetime', 'default' => null),
            'tableParameters'    => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>