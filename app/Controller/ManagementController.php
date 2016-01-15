<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ManagementController extends AppController {
 public $uses=array('Role','User','School');
public function index(){
	
	$this->layout='home';
	$authdata=$this->Session->read('Auth.User.User.id');
  $parentData=$this->User->findById($authdata); 
  $this->set('parentData',$parentData); 
}
}
?>