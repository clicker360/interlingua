<?php
class GendersSchema extends CakeSchema {

	var $name = 'Genders';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $genders = array(
            'id'                 => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'gender'             => array('type' => 'varchar', 'null' => false, 'length' => 11),
        );

}

?>
