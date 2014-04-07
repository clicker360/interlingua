<?php

class UsersController extends AppController{

    var $uses = array('User', 'Place');
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'User.id' => 'asc'
        )
    );

    public function login(){

//        debug( $this->Auth->hashPasswords( array(
//         'User'   => array(
//             'username' => 'israel',
//             'password' => 'israel'
//         )
//        )));
//        exit();

        if( $this->Session->check('Auth.User') ){
            $this->redirect(array('controller' => 'prospects', 'action' => 'index'));
        }
    }
    public function beforeFilter() {
        ini_set('memory_limit', '-1');
    }
    public function logout(){
        $this->redirect( $this->Auth->logout() );
    }

    public function index(){
        $title_for_layout = 'Listar Usuarios';
        $users            = $this->paginate('User');

        $this->set( compact('title_for_layout', 'users') );
    }


    public function add(){
        $title_for_layout = 'Agregar Usuario';
        $places           = $this->get_allowed_places();
        $levels=$this->get_levels();
        $this->set(compact('title_for_layout', 'places','levels'));
    }

    public function store_user(){

        if( empty($this->data) ){
            $this->redirectToReferer();
        }

        if( $this->User->save($this->data) ){ // Was User successfully saved?
            $this->Session->setFlash('Usuario agregado con éxito');
            $this->redirect(array('controller'=>'users', 'action' => 'index'));

        }else{
            $this->Session->setFlash('No se agregó el Usuario');
            $this->redirect(array('controller'=>'users','action'=>'add'));
        }
    }

    public function delete( $id=null){

        $user = $this->User->findById( $id );

        if( $id == null || ! $user ){ $this->redirectToReferer(); }

        $message = ( $this->User->delete( $id ) )? 'Usuario eliminado con éxito':'No se ha podido eliminar al usuario';
        $this->Session->setFlash($message);

        $this->redirect(array('controller'=>'users', 'action' => 'index'));
    }

    public function edit( $id=null ){

        $user = $this->User->findById( $id );
        $levels=$this->get_levels();
        if( $id == null || ! $user ){ $this->redirectToReferer(); }

        $places = $this->get_allowed_places();
        $this->data = $user;
        $this->set(compact('user', 'places','levels'));
    }
    protected function get_levels(){
        $levels=array();
        for($i=1;$i<=$this->Session->read('Auth.User.level');$i++)
        {
            $levels[$i]=$this->levels[$i];
        }
        return $levels;
    }
}

?>
