<?php

class StatusesController extends AppController{

    var $name='Statuses';
    var $uses = array('StatusCategory', 'Status');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Status.id' => 'asc'
        )
    );

    public function index(){
        $title_for_layout = 'Listar Status';
        $statuses         = $this->paginate('Status');

        $this->set( compact('title_for_layout', 'statuses') );
    }


    public function add(){
        $title_for_layout  = 'Agregar Status';
        $status_categories = $this->StatusCategory->find('list');

        $this->set(compact('title_for_layout', 'status_categories'));
    }

    public function store_status(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->Status->save($this->data) ){ // Was Status successfully saved?
            $this->Session->setFlash('Status agregado con éxito');
            $this->redirect(array('controller'=>'statuses', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó el status');
            $this->redirect(array('controller'=>'statuses','action'=>'add'));
        }
    }

    public function delete( $id=null){

        $status = $this->Status->findById( $id );

        if( $id == null || ! $status ){ $this->redirectToReferer(); }

        $message = ( $this->Status->delete( $id ) )? 'Status eliminado con éxito':'No se ha podido eliminar el status';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'statuses', 'action' => 'index'));
    }

    public function edit( $id=null ){
        $title_for_layout = 'Editar Status';
        $status = $this->Status->findById( $id );

        if( $id == null || ! $status ){ $this->redirectToReferer(); }

        $status_categories = $this->StatusCategory->find('list');
        $this->data = $status;
        $this->set(compact('title_for_layout','status_categories'));
    }
}

?>
