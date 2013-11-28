<?php

class ProspectsSchema extends CakeSchema {

	var $name = 'Prospects';

	function before($event = array()) { return true; }
	function after($event = array()) {}

        var $prospects = array(
            'id'                => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
            'user_id'           => array('type' => 'integer', 'null' => true, 'length' => 11),
            'place_id'          => array('type' => 'integer', 'null' => true, 'length' => 11),
            'origin_id'         => array('type' => 'integer', 'null' => true, 'length' => 11),
            'status_id'         => array('type' => 'integer', 'null' => true, 'length' => 11),
            'medium_id'         => array('type' => 'integer', 'null' => true, 'length' => 11),
            'state_id'          => array('type' => 'integer', 'null' => true, 'length' => 11),
            'city_id'           => array('type' => 'integer', 'null' => true, 'length' => 11),
            'gender_id'         => array('type' => 'integer', 'null' => true, 'length' => 11),

            //evangelizadores.nombre = crm.name
            'name'              => array('type'=>'text', 'null' => true, 'default' => NULL),
            //Apellidos.
            'apellido_paterno'  => array('type'=>'text', 'null' => true, 'default' => NULL),
            'apellido_materno'  => array('type'=>'text', 'null' => true, 'default' => NULL),
            //evangelizadores.email = crm.email
            'email'             => array('type'=>'text', 'null' => true, 'default' => NULL),
            //evangelizadores.lada = crm.area_code
            'area_code'         => array('type'=>'text', 'null' => true, 'default' => NULL),
            //evangelizadores.telefono = crm.phone_number
            'phone_number'      => array('type'=>'text', 'null' => true, 'default' => NULL),
            'mobile_number'     => array('type'=>'text', 'null' => true, 'default' => NULL),
            'ip'                => array('type'=>'text', 'null' => true, 'default' => NULL),
            'referer'           => array('type'=>'text', 'null' => true, 'default' => NULL),
            'comments'          => array('type'=>'text', 'null' => true, 'default' => NULL),
            'assignation_date'  => array('type' => 'datetime', 'default' => null),
            'first_contact_date'=> array('type' => 'datetime', 'default' => null),
            'last_contact_date' => array('type' => 'datetime', 'default' => null),
            //Evangelizadores
            'fecha_nacimiento'  => array('type'=>'date', 'null' => true, 'default' => NULL),
            'estado_civil'      => array('type'=>'integer', 'null' => true, 'default' => NULL),
            'fecha_aniversario' => array('type'=>'date', 'null' => true, 'default' => NULL),
            'calle'             => array('type'=>'text', 'null' => true, 'default' => NULL),
            'numero'            => array('type'=>'text', 'null' => true, 'default' => NULL),
            'cp'                => array('type'=>'text', 'null' => true, 'default' => NULL),
            'colonia'           => array('type'=>'text', 'null' => true, 'default' => NULL),
            'ciudad'            => array('type'=>'text', 'null' => true, 'default' => NULL),
            'estado'            => array('type'=>'text', 'null' => true, 'default' => NULL),
            'pais'              => array('type'=>'text', 'null' => true, 'default' => NULL),
            'tipo_apoyo'        => array('type'=>'text', 'null' => true, 'default' => NULL),

            
            'created'           => array('type' => 'datetime', 'default' => null),
            'updated'           => array('type' => 'datetime', 'default' => null),
            'tableParameters'   => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
        );

}

?>