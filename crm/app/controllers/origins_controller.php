<?php

class OriginsController extends AppController{
    
    var $uses = array('Origin');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Origin.id' => 'asc'
        )
    );
    
    public function index(){
        $title_for_layout = 'Listar Origenes';
        $origins          = $this->paginate('Origin');
        
        $this->set( compact('title_for_layout', 'origins') );        
    }
    
    public function add(){
        $title_for_layout = 'Agregar Origin';
        $this->set( compact('title_for_layout') );
    }
    
    public function store_origin(){
        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->Origin->save($this->data) ){ // Was Origin successfully saved?
            $this->Session->setFlash('Origin agregado con éxito');
            $this->redirect(array('controller'=>'origins', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó el Origin');
            $this->redirect(array('controller'=>'origins','action'=>'add'));
        }
    }
    
    public function edit( $id=null){

        $origin = $this->Origin->findById( $id );

        if( $id == null || ! $origin ){ $this->redirectToReferer(); }

        $places = $this->Origin->find('list');
        $this->data = $origin;
        $this->set(compact('origin'));
    }

    public function delete( $id=null){

        $origin = $this->Origin->findById( $id );

        if( $id == null || ! $origin ){ $this->redirectToReferer(); }

        $message = ( $this->Origin->delete( $id ) )? 'Origin eliminado con éxito':'No se ha podido eliminar el origin';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'origins', 'action' => 'index'));
    }
}

?>
