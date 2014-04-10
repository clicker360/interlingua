<?php

function not_empty($elem) {
    if($elem==0) return true;
    return!empty($elem) && $elem != null;
}

class Prospect extends AppModel {

    var $name = 'Prospect';
    var $belongsTo = array(
        'User',
        'Place',
        'Origin',
        'Status',
        'Medium',
        'State',
        'City',
        'Gender'
    );
    var $hasMany = array('Event');
    //var $hasOne = array('Test');
    var $actsAs = array('Containable');
    var $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Por favor ingresa tu nombre.',
                'last' => true,
             )
        ),
        'email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Por favor ingresa tu correo electrónico.',
                'last' => true
             ),
            'email' => array(
                'rule' => array('email', true),
                'message' => 'Por favor ingresa un correo electrónico valido.',
                'last' => true
             ),
            /*'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'El correo electrónico ingresado ya esta en uso.',
                'last' => true
             )*/
        ),
        'lada' => array(            
            //'notEmpty' => array(
                //'rule' => 'notEmpty',
              //  'message' => 'Por favor ingresa la clave lada.',
               // 'last' => true
             //),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Por favor ingresa únicamente números para la clave lada.',
                'last' => true
             ),
            'between' => array(
                'rule' => array('between', 2, 3),
                'message' => 'La clave lada debe contener entre 2 y 3 digitos.',
                'last' => true
             ),
        ),
        'phone_number' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Por favor ingresa el telefono local.',
                'last' => true
             ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Por favor ingresa únicamente números para el telefono local.',
                'last' => true
             ),
            'between' => array(
                'rule' => array('between', 7, 8),
                'message' => 'El número local debe contener entre 7 y 8 digitos.',
                'last' => true
             ),
        ),
        'estado' => array(
           // 'notEmpty' => array(
             //   'rule' => 'notEmpty',
               // 'message' => 'Por favor ingresa tu estado.',
                //'last' => true,
             //)
        ),
        'termino' => array(
           //'notEmpty' => array(
             //   'rule' => 'notEmpty',
               // 'message' => 'Debes aceptar las políticas de privacidad.',
                //'last' => true,
                //'required' => true
             //)
        ),
    );    
    

    public function beforeSave() {

        $prospect = (isset($this->data['Prospect']['id'])) ? $this->findById($this->data['Prospect']['id']) : null;
        $user = (isset($this->data['Prospect']['user_id'])) ? $this->User->findById($this->data['Prospect']['user_id']) : null;

        if ($user) {  // does user exist?
            if (!$prospect) { // does prospect already exist?
                $this->assignUser($prospect['Prospect']['id'], $user['User']['id']);
            } else {
                $this->data['Prospect']['assignation_date'] = date('Y-m-d H:i:s');
            }
        }
        return true;
    }

    public function assignUser($prospect_id=null, $user_id=null) {

        $prospect = $this->findById($prospect_id);

        if ($prospect && empty($prospect['Prospect']['assignation_date'])) { // Does prospect exist already and he/she doesn't have an assignation date ?
            $this->set(array(
                'id' => $prospect_id,
                'user_id' => $user_id,
                'assignation_date' => date('Y-m-d H:i:s')
            ));
            $this->save();
        }
    }

    public function getUnassignedProspects($place=null) {
        $conditions = array('OR'=>array(array('Prospect.user_id'=>null),array('Prospect.user_id' => '0')));
        if ($place != null && $place != 0) {
            $conditions['Prospect.place_id'] = $place;
        }
        return $this->find('all', array('conditions' => $conditions,'order'=>'Prospect.created DESC'));
    }

    /**************************************************************************
     * getAssignedProspects: Realiza la búsqueda de prospectos ya asignados.
     *
     * @param  place: Lugar de origen del prospecto
     *         user: Usuario al cual fue asignado el prospecto.
     *         filtro: Nombre del campo a filtrar.
     *         orden: Tipo de orden para filtrar (DESC o ASC).
     * @throws Null
     * @return Listado de prospectos asignados para los filtros dados.
     */
    public function getAssignedProspects($place=null,$user=null,$filtro=null,$orden=null,$limit=null) {
        $conditions = $this->getAssignedProspectsConditions($place,$user);
        if ($filtro != '' && $orden != '') {
            $order = '' . $filtro . ' ' . $orden . '';
        } else {
            $order = 'Prospect.assignation_date DESC';
        }
        //$this->recursive = -1;
         $this->unbindModel(
                array('hasMany' => array('Event'))
            );
        return $this->find('all', array('fields'=>array('User.*,Prospect.*,Place.*,Status.*,StatusCategory.*','Origin.*'),'conditions' => $conditions,'joins'=>array(
    array('table' => 'status_categories',
        'alias' => 'StatusCategory',
        'type' => 'LEFT',
        'conditions' => array(
            'StatusCategory.id = (SELECT status_category_id FROM statuses as Status WHERE Status.id = Prospect.status_id)',
        )
    )
),/* 'contain' => array('User', 'Place', 'Origin', 'Status'=>array('StatusCategory')),*/'order'=>$order,'limit'=>$limit));
    }
    public function getAssignedProspectsCount($place=null,$user=null,$filtro=null,$orden=null,$limit=null) {
        $conditions = $this->getAssignedProspectsConditions($place,$user);
        if ($filtro != '' && $orden != '') {
            $order = '' . $filtro . ' ' . $orden . '';
        } else {
            $order = 'Prospect.assignation_date DESC';
        }
        //$this->recursive = -1;
         $this->unbindModel(
                array('hasMany' => array('Event'))
            );
        return $this->find('count', array(/*'fields'=>array('User.*,Prospect.*,Status.*','Origin.*'),*/'conditions' => $conditions,/* 'contain' => array('User', 'Place', 'Origin', 'Status'=>array('StatusCategory')),*/'order'=>$order,'limit'=>$limit));
    }
    /**************************************************************************
     * getAssignedProspectsConditions: Regresa las condiciones de búsqueda 
     *                                 para un prospecto.
     *
     * @param  place: Lugar de origen del prospecto
     *         user: Usuario al cual fue asignado el prospecto.
     *         filtro: Nombre del campo a filtrar.
     *         orden: Tipo de orden para filtrar (DESC o ASC).
     * @throws Null
     * @return Listado de condiciones
     */
    public function getAssignedProspectsConditions($place=null,$user=null) {
        $conditions = array('Prospect.user_id >' => 0);
        if ($user != null) {
            if ($place != null ) {
                $conditions = array('OR'=>array(array('Prospect.place_id'=>$place),array('Prospect.user_id'=>$user)));
            } else {
                $conditions['Prospect.user_id'] = $user;
            }
        } else {
            if ($place != null ) {
                $conditions['Prospect.place_id'] = $place;
            }
        }
        
        return $conditions;
    }

    /**************************************************************************
     * searchAssignedProspects: Realiza la búsqueda de prospectos ya asignados.
     *
     * @param  conditions: Condiciones de búsqueda.
     *         filtro: Campo a ordenar.
     *         orden: Tipo de orden para filtrar (DESC o ASC).
     *         limit: límite de registros que regresará la búsqueda.
     * @throws Null
     * @return Listado de prospectos asignados para los filtros dados.
     */
    public function searchAssignedProspects($conditions=null, $filtro=null, $orden=null, $limit=null) {
        if ($filtro != '' && $orden != '') {
            $order = '' . $filtro . ' ' . $orden . '';
        } else {
            $order = 'Prospect.assignation_date DESC';
        }
        $conditions = $this->searchAssignedProspectsConditions($conditions, $filtro);
        //$this->recursive = -1;
         $this->unbindModel(
                array('hasMany' => array('Event'))
            );
        $search_result = $this->find('all', array(
                                        'fields'=>array(
                                            'User.*,Prospect.*,Status.*,StatusCategory.*'
                                         ),'conditions' => $conditions,'joins'=>array(
                                            array(
                                                'table' => 'status_categories',
                                                'alias' => 'StatusCategory',
                                                'type' => 'LEFT',
                                                'conditions' => array(
                                                    'StatusCategory.id = (SELECT status_category_id FROM statuses as Status WHERE Status.id = Prospect.status_id)',
                                                )
                                            )
                                         ),
                                         /* 'contain' => array('User', 'Place', 'Origin', 'Status'=>array('StatusCategory'))*/
                                         'order'=>$order,
                                         'limit'=>$limit
                                                )
                                    );

        return $search_result;
    }
    public function searchAssignedProspectsCount($conditions=null, $filtro=null, $orden=null, $limit=null) {
        if ($filtro != '' && $orden != '') {
            $order = '' . $filtro . ' ' . $orden . '';
        } else {
            $order = 'Prospect.assignation_date DESC';
        }
        $conditions = $this->searchAssignedProspectsConditions($conditions, $filtro);
        //$this->recursive = -1;
         $this->unbindModel(
                array('hasMany' => array('Event'))
            );
        $search_result = $this->find('count', array(
                                        'conditions' => $conditions,
                                         /* 'contain' => array('User', 'Place', 'Origin', 'Status'=>array('StatusCategory'))*/
                                         'order'=>$order,
                                         'limit'=>$limit
                                                )
                                    );

        return $search_result;
    }
    
    /**************************************************************************
     * searchAssignedProspectsConditions: Genera las condiciones de búsqueda  
     *                                    para prospectos asignados
     *
     * @param  conditions: Condiciones de búsqueda.
     *         filtro: Campo a ordenar.
     *         orden: Tipo de orden para filtrar (DESC o ASC).
     *         limit: límite de registros que regresará la búsqueda.
     * @throws Null
     * @return Cadena con las condiciones de búsqueda.
     */
    public function searchAssignedProspectsConditions($conditions = null, $filtro=null) {
        if ($conditions == null) {
            return null;
        }
        $filters = $this->buildSearchFilters($conditions);
        $conditions = $this->buildSearchConditions($filters);

        return $conditions;
    }
    
    public function prospectHasOpenEvent($prospect_id=null) {
        $count = $this->Event->find('count', array(
                    'conditions' => array(
                        'Event.prospect_id' => $prospect_id,
                        'Event.status_id' => 0
                    )
                ));

        return $count > 0;
    }

    public function prospectLastEvent($prospect_id=null) {
        $lstEvent = $this->Event->find('first', array(
                    'conditions' => array(
                        'Event.prospect_id' => $prospect_id
                    ),
                    'order' => array('Event.date DESC')
                ));
        return $lstEvent['Event']['id'];
    }

    private function buildSearchConditions($filters) {
        if (empty($filters)) {
            return array('Prospect.user_id >' => 0);
        }

        $conditions = array();
        $conditions['AND']['Prospect.user_id !='] = 0;

        //Se revisa si existe el parámetro de tipo de fecha y se asigna al campo correspondiente
        if(key_exists('tipo_fecha', $filters )) {
            switch($filters['tipo_fecha']) {
                case "0":
                    //Fecha de Registro.
                    if (key_exists('from_date', $filters)) {
                        $conditions['AND']['Prospect.created >='] = $filters['from_date'];
                    }
                    if (key_exists('to_date', $filters)) {
                        $conditions['AND']['Prospect.created <='] = $filters['to_date'];
                    }
                    break;
                case "1":
                    //Fecha de Asignación.
                    if (key_exists('from_date', $filters)) {
                        $conditions['AND']['Prospect.assignation_date >='] = $filters['from_date'];
                    }
                    if (key_exists('to_date', $filters)) {
                        $conditions['AND']['Prospect.assignation_date <='] = $filters['to_date'];
                    }
                    break;
                case "2":
                    //Fecha de Última Atención.
                    if (key_exists('from_date', $filters)) {
                        $conditions['AND']['Prospect.last_contact_date >='] = $filters['from_date'];
                    }
                    if (key_exists('to_date', $filters)) {
                        $conditions['AND']['Prospect.last_contact_date <='] = $filters['to_date'];
                    }
                    if(!key_exists('to_date', $filters) && !key_exists('from_date', $filters)) {
                        $conditions['AND']['Prospect.last_contact_date'] = NULL;
                    }
                    break;
                default:
                    if (key_exists('from_date', $filters)) {
                        $conditions['AND']['Prospect.created >='] = $filters['from_date'];
                    }
                    if (key_exists('to_date', $filters)) {
                        $conditions['AND']['Prospect.created <='] = $filters['to_date'];
                    }
                    break;
            }
            unset($filters['from_date']);
            unset($filters['to_date']);
            unset($filters['tipo_fecha']);
        } else {
            if (key_exists('from_date', $filters)) {
                $conditions['AND']['Prospect.created >='] = $filters['from_date'];
                unset($filters['from_date']);
            }
            if (key_exists('to_date', $filters)) {
                $conditions['AND']['Prospect.created <='] = $filters['to_date'];
                unset($filters['to_date']);
            }
        }

        if (key_exists('name', $filters)) {
            $conditions['AND']['Prospect.name LIKE'] = '%' . $filters['name'] . '%';
            unset($filters['name']);
        }
        
        if (key_exists('empresa', $filters)) {
            $conditions['AND']['Prospect.empresa LIKE'] = '%' . $filters['empresa'] . '%';
            unset($filters['empresa']);
        }

        if (key_exists('email', $filters)) {
            $conditions['AND']['Prospect.email LIKE'] = '%' . $filters['email'] . '%';
            unset($filters['email']);
        }
        if (key_exists('asesor', $filters)) {
            $conditions['AND']['Prospect.asesor LIKE'] = '%' . $filters['asesor'] . '%';
            unset($filters['asesor']);
        }

        if (key_exists('ORCondition', $filters)) {
            $conditions['OR'] = $filters['ORCondition'];
            unset($filters['ORCondition']);
        }
        
        foreach ($filters as $field => $filter) {
            $conditions['AND']['Prospect.' . $field] = $filter;
        }
        return $conditions;
    }

    private function buildSearchFilters($conditions) {
        $filters = array();
        $fields = array(
            'id',
            'name',
            'empresa',
            'email',
            'lada',
            'phone_number',
            'mobile_number',
            'plantel',
            'estado',
            'servicio',
            'asesor',
            'state_id',
            'city_id',
            'medium_category_id',
            'medium_id',
            'status_category_id',
            'status_id',
            'place_id',
            'user_id',
            'tipo_fecha',
            'to_date',
            'from_date',
            'origin_id'
            );

        /*
         * Este ciclo se encarga de recorrer los campos para descartar campos vacios y arreglos que no tengan valores nulos.
         */
        foreach ($fields as $field) {
            if (isset($conditions['Prospect'][$field]) && !empty($conditions['Prospect'][$field])) { // el campo existe y no está vacio?
                if (is_array($conditions['Prospect'][$field])) {
                    $conditions['Prospect'][$field] = array_filter($conditions['Prospect'][$field], 'not_empty');
                    if (!empty($conditions['Prospect'][$field]) &&
                            !in_array('null', $conditions['Prospect'][$field])) { // el arreglo no está vacio y sus valores son diferentes de nulos
                        $filters[$field] = $conditions['Prospect'][$field];
                    }
                } else {
                    $filters[$field] = $conditions['Prospect'][$field];
                }
            }
        }

        /*
         * Si en la búsqueda se especificó el campo "medium_category_id", hay que sacar todos los medios que pertenecen a esa categoría.
         * Esto es para facilitar la consulta.
         */
        if (key_exists('medium_category_id', $filters) ) {

            $mediums_id = $this->Medium->find('list', array(
                        'conditions' => array('Medium.medium_category_id' => $filters['medium_category_id'])
                    ));
            if (!empty($mediums_id)) {
                $filters['medium_id'] = array_keys($mediums_id);
            }
            unset($filters['medium_category_id']);
        }

        /*
         * Si en la búsqueda se especificó el campo "status_category_id", hay que sacar todos los status que pertenecen a esa categoría.
         * Esto es para facilitar la consulta.
         */
        if (key_exists('status_category_id', $filters)) {
            if(!key_exists('status_id',$filters)){
                $status_id = $this->Status->find('list', array(
                            'conditions' => array('Status.status_category_id' => $filters['status_category_id'])
                        ));
                if (!empty($status_id)) {
                    $filters['status_id'] = array_keys($status_id);
                }
            }
            unset($filters['status_category_id']);
        }

        /*
         * Si se definió una fecha origen en la búsqueda, darle formato para ser fecha compatible
         * con MySQL
         */
        if (key_exists('from_date', $filters)) {
            list( $day, $month, $year ) = split('[/.-]', $filters['from_date']);
            $filters['from_date'] = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
        }

        /*
         * Si se definió una fecha límite en la búsqueda, darle formato para ser fecha compatible
         * con MySQL
         */
        if (key_exists('to_date', $filters)) {
            list( $day, $month, $year ) = split('[/.-]', $filters['to_date']);
            $filters['to_date'] = date('Y-m-d H:i:s', mktime(0, 0, 0, $month, $day, $year));
        }
        
        /*
         * Si se definió un arreglo con los usuarios y lugares se verifica y se da formato
         */
        if(key_exists('ORCondition',$conditions)){
            $filters['ORCondition'] = $conditions['ORCondition'];
        }
        return $filters;
    }

}

?>
