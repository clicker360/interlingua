<?php

class PlacesController extends AppController{

    var $uses = array('Place', 'User');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Place.id' => 'asc'
        )
    );

    public function index(){

        $title_for_layout = 'Listado de Lugares';
        $places           = $this->paginate('Place');

        $this->set(compact('title_for_layout', 'places'));
    }

    public function add(){
        $title_for_layout = 'Agregar Lugar';
        $this->set(compact('title_for_layout'));
    }

    public function store_place(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->Place->save($this->data) ){ // Was Place successfully saved?
            $this->Session->setFlash('Lugar agregado con éxito');
            $this->redirect(array('controller'=>'places', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó el lugar');
            $this->redirect(array('controller'=>'places','action'=>'add'));
        }
    }

    public function delete( $id=null ){

        $place = $this->Place->findById( $id );

        if( $id == null || ! $place ){ $this->redirectToReferer(); }

        $message = ( $this->Place->delete( $id ) )?  'Lugar eliminado con éxito' : 'No se ha podido eliminar el lugar';
        $this->Session->setFlash( $message );

        $this->redirect(array('controller'=>'places', 'action' => 'index'));
    }

    public function edit( $id=null ){

        $place = $this->Place->findById( $id );

        if( $id == null || ! $place ){ $this->redirectToReferer(); }

        $title_for_layout = 'Editar Lugar';
        $this->data       = $place;
        $this->set(compact('title_for_layout'));
    }

    /* AJAX */
    public function obtainUsersByPlace(){

        if( !isset( $this->params['form']['id'] )){
            exit();
        }

        $place_id   = $this->params['form']['id'];
        $users      = $this->User->find('all', array( 'conditions' => array('User.place_id' =>  $place_id)));
        $result     = array();

        foreach( $users as $user ){

            array_push( $result , array(
                'id'    => $user['User']['id'],
                'name'  => $user['User']['name']
            ));
        }

        Configure::write('debug', 0);
        $this->autoRender = false;
        echo json_encode($result);
        exit( );
    }
}

?>
