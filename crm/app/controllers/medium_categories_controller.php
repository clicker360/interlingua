<?php

class MediumCategoriesController extends AppController{

    var $uses = array('MediumCategory', 'Medium');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'MediumCategory.id' => 'asc'
        )
    );

    public function index(){
        $title_for_layout  = 'Listar Categorias de Medios';
        $medium_categories = $this->paginate('MediumCategory');
        $this->set( compact('title_for_layout', 'medium_categories') );
    }
    public function add(){
        $title_for_layout = 'Agregar Categoria de Medio';
        $this->set(compact('title_for_layout'));
    }

    public function store_medium_category(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->MediumCategory->save($this->data) ){ // Was MediumCategory successfully saved?
            $this->Session->setFlash('Categoria de Medio agregada con éxito');
            $this->redirect(array('controller'=>'medium_categories', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó la Categoria de Medios');
            $this->redirect(array('controller'=>'medium_categories','action'=>'add'));
        }
    }

    public function delete( $id=null){

        $category = $this->MediumCategory->findById( $id );

        if( $id == null || ! $category ){ $this->redirectToReferer(); }

        $message = ( $this->MediumCategory->delete( $id ) )? 'Categoria de Medios eliminada con éxito':'No se ha podido eliminar la Categoria de Medios';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'medium_categories', 'action' => 'index'));
    }

    public function edit( $id=null ){
        $title_for_layout  = 'Editar Categoria de Medios';
        $category = $this->MediumCategory->findById( $id );

        if( $id == null || ! $category ){ $this->redirectToReferer(); }

        $this->data = $category;
        $this->set(compact('title_for_layout'));
    }

    /* AJAX */
    public function obtainMediaByCategory(){

        if( !isset( $this->params['form']['id'] )){
            exit();
        }

        $category_id = $this->params['form']['id'];
        $media       = $this->Medium->find('all', array( 'conditions' => array('Medium.medium_category_id' =>  $category_id)));
        $result      = array();

        foreach( $media as $medium ){

            array_push( $result , array(
                'id'    => $medium['Medium']['id'],
                'name'  => $medium['Medium']['name']
            ));
        }

        Configure::write('debug', 0);
        $this->autoRender = false;
        echo json_encode($result);
        exit( );
    }
}

?>
