<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class HomeController extends AppController
 {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Auth','Gcm');
      
  public function beforeFilter() {
    parent::beforeFilter();

    // Allow users to register and logout.
    $this->Auth->allow();
}

public function login() {
    
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Session->setFlash(__('Invalid username or password, try again'));
    }
}
public function logout() {
    return $this->redirect($this->Auth->logout());
}
	public function index() {
    
        $this->layout = 'home';
		
	}



}