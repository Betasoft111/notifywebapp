<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Orderforms Controller
 *
 * @property Orderform $Orderform
 * @property PaginatorComponent $Paginator
 */
class ApisController extends AppController {
    public $components = array('Paginator', 'Session','Auth','Gcm');
    
     public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('add_eventhost');
}
public function add_eventhost(){
    
configure::write('debug',2);
$this->layout="ajax";	
$this->loadModel('Users');	
if ($this->request->is('post')) {
    $this->request->data['Eventhost']['status']='0';
    $this->Eventhost->create();		
if ($this->Eventhost->save($this->request->data)) {	
    $response['msg']="Success";		
    $response['error']="0";		
    } else {	
        $response['msg']="Failed";	
        $response['error']="1";	
        }
  }	
  $this->set('response',$response);
  $this->render("ajax");
}
}
?>