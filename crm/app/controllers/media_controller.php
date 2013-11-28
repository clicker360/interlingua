<?php

class MediaController extends AppController{

    var $uses = array('MediumCategory', 'Medium');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Medium.id' => 'asc'
        )
    );

    public function index(){
        $title_for_layout = 'Listar Medios';
        $media            = $this->paginate('Medium');

        $this->set( compact('title_for_layout', 'media') );
    }


    public function add(){
        $title_for_layout  = 'Agregar Medio';
        $medium_categories = $this->MediumCategory->find('list');

        $this->set(compact('title_for_layout', 'medium_categories'));
    }

    public function store_medium(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->Medium->save($this->data) ){ // Was Medium successfully saved?
            $this->Session->setFlash('Medio agregado con éxito');
            $this->redirect(array('controller'=>'media', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó el medio');
            $this->redirect(array('controller'=>'media','action'=>'add'));
        }
    }

    public function delete( $id=null){

        $medium = $this->Medium->findById( $id );

        if( $id == null || ! $medium ){ $this->redirectToReferer(); }

        $message = ( $this->Medium->delete( $id ) )? 'Medio eliminado con éxito':'No se ha podido eliminar el medio';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'media', 'action' => 'index'));
    }

    public function edit( $id=null ){
        $title_for_layout = 'Editar Medio';
        $medium = $this->Medium->findById( $id );

        if( $id == null || ! $medium ){ $this->redirectToReferer(); }

        $medium_categories = $this->MediumCategory->find('list');
        $this->data = $medium;
        $this->set(compact('title_for_layout','medium_categories'));
    }
}
?>
