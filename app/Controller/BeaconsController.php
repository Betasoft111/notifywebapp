<?php
App::uses('AppController', 'Controller');
/**
 * Managers Controller
 *
 * @property Manager $Manager
 * @property PaginatorComponent $Paginator
 */
class BeaconsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	
	public function addbeacon() 
  {
    $this->layout = 'home';
    
  }
  public function beaconsList() 
  {
    $this->layout = 'home';
    
  }
  public function beaconsInformation() 
  {
    $this->layout = 'home';
    
  }
   public function beaconsUser() 
  {
    $this->layout = 'home';
    
  }
   public function classRoomList() 
  {
    $this->layout = 'home';
    
  }
   public function schoolsListBeacon() 
  {
    $this->layout = 'home';
    
  }
  

}
