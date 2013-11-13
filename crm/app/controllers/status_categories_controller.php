<?php

class StatusCategoriesController extends AppController{

    var $uses = array('StatusCategory', 'Status');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'StatusCategory.id' => 'asc'
        )
    );

    public function index(){
        $title_for_layout  = 'Listar Categorias de Status';
        $status_categories = $this->paginate('StatusCategory');
        $this->set( compact('title_for_layout', 'status_categories') );
    }
    public function add(){
        $title_for_layout = 'Agregar Categoria de Status';
        $this->set(compact('title_for_layout'));
    }

    public function store_status_category(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->StatusCategory->save($this->data) ){ // Was StatusCategory successfully saved?
            $this->Session->setFlash('Categoria de Status agregada con éxito');
            $this->redirect(array('controller'=>'status_categories', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó la Categoria de Status');
            $this->redirect(array('controller'=>'status_categories','action'=>'add'));
        }
    }

    public function delete( $id=null){

        $category = $this->StatusCategory->findById( $id );

        if( $id == null || ! $category ){ $this->redirectToReferer(); }

        $message = ( $this->StatusCategory->delete( $id ) )? 'Categoria de status eliminada con éxito':'No se ha podido eliminar la Categoria de status';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'status_categories', 'action' => 'index'));
    }

    public function edit( $id=null ){
        $title_for_layout  = 'Editar Categoria de status';
        $category = $this->StatusCategory->findById( $id );

        if( $id == null || ! $category ){ $this->redirectToReferer(); }

        $this->data = $category;
        $this->set(compact('title_for_layout'));
    }

    /* AJAX */
    public function obtainStatusByCategory(){

        if( !isset( $this->params['form']['id'] )){
            exit();
        }

        $category_id = $this->params['form']['id'];
        $statuses    = $this->Status->find('all', array( 'conditions' => array('Status.status_category_id' =>  $category_id)));
        $result      = array();

        foreach( $statuses as $status ){

            array_push( $result , array(
                'id'    => $status['Status']['id'],
                'name'  => $status['Status']['name']
            ));
        }

        Configure::write('debug', 0);
        $this->autoRender = false;
        echo json_encode($result);
        exit( );
    }
}

?>
