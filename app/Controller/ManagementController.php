<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class ManagementController extends AppController {
	public $components = array('Paginator', 'Session', 'Auth', 'Gcm');
	public $helpers = array('Form', 'Html', 'Js', 'Time');
	public $uses = array('Employee', 'EmployeeSchedule', 'User', 'Location');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'home';
		$authdata = $this->Session->read('Auth.User.User.id');
		$parentData = $this->User->findById($authdata);
		$this->set('parentData', $parentData);
		$this->Auth->allow();
	}
	public function index() {

		$this->layout = 'home';
		$authdata = $this->Session->read('Auth.User.User.id');
		$parentData = $this->User->findById($authdata);
		$this->set('parentData', $parentData);

		$this->paginate = array(
			'conditions' => array('Location.user_id' => $authdata),
			'limit' => 10,
			'order' => array('id' => 'desc'),
		);

		$locations = $this->paginate('Location');
		$this->set('locations', $locations);
	}
	public function employlist($distid = NULL) {
		$this->layout = 'home';
		$authdata = $this->Session->read('Auth.User.User.id');
		$this->paginate = array(
			'conditions' => array('Employee.user_id' => $authdata),
			'limit' => 10,
			'order' => array('id' => 'desc'),
		);
		// $allDate = $this->Employee->find('all',array('conditions'=>array('Employee.user_id'=>$authdata)));
		$result = $this->paginate('Employee');
		$this->set('employees', $result);
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('Invalid employee'));
		}
		$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
		$this->set('employee', $this->Employee->find('first', $options));
	}
/**
 * add method
 *
 * @return void
 *return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Employee->create();
			$this->request->data['Employee']['user_id'] = $this->Session->read('Auth.User.User.id');

			if ($this->data['Employee']['image']['name']) {
				$file_name = $this->data['Employee']['image']['name'];
				$file_size = $this->data['Employee']['image']['size'];
				$file_tmp = $this->data['Employee']['image']['tmp_name'];
				$file_type = $this->data['Employee']['image']['type'];
				if ($file_size > 2097152) {
					$this->Session->setFlash(__('File size must be less than 2 MB'));
				} else {
					$namechange = time() . $file_name;
					$data = WWW_ROOT . 'bss_files/' . $namechange;
					$url = "http://abdevs.com/attendance/bss_files/" . $namechange;
					if (move_uploaded_file($file_tmp, $data)) {
						$this->request->data['Employee']['image'] = $namechange;
						$this->request->data['Employee']['employee_email'] = $this->request->data['Employee']['email'];
						if ($this->Employee->save($this->request->data)) {
							$this->Session->setFlash(__('The employee has been saved.'));
							return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
						} else {
							$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
						}
					}
				}

			} else {
				$this->request->data['Employee']['image'] = '';
				if ($this->Employee->save($this->request->data)) {
					$this->Session->setFlash(__('The employee has been saved.'));
					return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
				} else {
					$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
				}
			}
		}
	}
/*
Delete Employee
 *****/
	public function delete($id = NULL) {
		if (!empty($id)) {
			$this->layout = '';
			$this->autoRender = false;
			$idde = explode(',', $id);
			$y = 0;
			if ($this->Employee->deleteAll(array('Employee.id' => $idde))) {
				$y++;
			}
			if ($y > 0) {

				$this->Session->setFlash(__('Successfully deleted school'));
				$this->redirect(array('controller' => 'management', 'action' => 'employlist'));
			}
		} else {
			$this->Session->setFlash(__('Please select any one first'));
			$this->redirect(array('controller' => 'management', 'action' => 'employlist'));
		}
	}
/*
Edit module
 */
	public function edit($id = NULL) {
		$this->layout = 'home';
		if (!empty($id) && empty($this->request->data)) {
			// echo 'hii'; die;
			$employdata = $this->Employee->find('first', array('conditions' => array('Employee.id' => $id)));
			$this->set('employee', $employdata);
		}
		if (!empty($this->request->data)) {
			$this->request->data['Employee']['user_id'] = $this->Session->read('Auth.User.User.id');
			if ($this->data['Employee']['image']['name']) {
				$file_name = $this->data['Employee']['image']['name'];
				$file_size = $this->data['Employee']['image']['size'];
				$file_tmp = $this->data['Employee']['image']['tmp_name'];
				$file_type = $this->data['Employee']['image']['type'];
				if ($file_size > 2097152) {
					$this->Session->setFlash(__('File size must be less than 2 MB'));
				} else {
					$namechange = time() . $file_name;
					$data = WWW_ROOT . 'bss_files/' . $namechange;
					$url = "http://abdevs.com/attendance/bss_files/" . $namechange;
					if (move_uploaded_file($file_tmp, $data)) {
						$this->request->data['Employee']['image'] = $namechange;
						$this->request->data['Employee']['employee_email'] = $this->request->data['Employee']['email'];
						if ($this->Employee->save($this->request->data)) {
							$this->Session->setFlash(__('The employee has been saved.'));
							return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
						} else {
							$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
						}
					}
				}

			} else {

				$this->request->data['Employee']['image'] = '';
				$this->request->data['Employee']['user_id'] = $this->Session->read('Auth.User.User.id');
				if ($this->Employee->save($this->request->data)) {
					$this->Session->setFlash(__('The employee has been saved.'));
					return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
				} else {
					$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
				}
			}
		}
	}
	public function Meetingadd($id = NULL) {

		$this->layout = 'home';

		$authdata = $this->Session->read('Auth.User.User.id');

		$allDate = $this->Employee->find('all', array('conditions' => array('Employee.user_id' => $authdata)));
		$result = $this->paginate('Employee');
		$this->set('employee', $allDate);
		$this->set('id', $id);

		if ($this->request->is('post')) {

			$this->request->data['EmployeeSchedule']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['EmployeeSchedule']['location_id'] = $id;
			$this->request->data['EmployeeSchedule']['startDate'] = $this->request->data['EmployeeSchedule']['startDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['day'];
			$this->request->data['EmployeeSchedule']['endDate'] = $this->request->data['EmployeeSchedule']['endDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['day'];
			$this->request->data['EmployeeSchedule']['meeting_start_time'] = $this->request->data['EmployeeSchedule']['meeting_start_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['meridian'];
			$this->request->data['EmployeeSchedule']['meeting_end_time'] = $this->request->data['EmployeeSchedule']['meeting_end_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['meridian'];
			$saveddata = $this->EmployeeSchedule->save($this->request->data);

			$this->Session->setFlash(__('The new employee has been added.'));
		}
		//return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));

		// if (empty($id) && !empty($this->request->data)) {
		// 	$this->request->data['EmployeeSchedule']['user_id'] = $this->Session->read('Auth.User.User.id');
		// 	$this->request->data['EmployeeSchedule']['startDate'] = $this->request->data['EmployeeSchedule']['startDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['day'];
		// 	$this->request->data['EmployeeSchedule']['endDate'] = $this->request->data['EmployeeSchedule']['endDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['day'];
		// 	$this->request->data['EmployeeSchedule']['meeting_start_time'] = $this->request->data['EmployeeSchedule']['meeting_start_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['meridian'];
		// 	$this->request->data['EmployeeSchedule']['meeting_end_time'] = $this->request->data['EmployeeSchedule']['meeting_end_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['meridian'];
		// 	$saveddata = $this->EmployeeSchedule->save($this->request->data);
		// } else {
		// 	if ($this->request->data) {
		// 		$this->request->data['EmployeeSchedule']['user_id'] = $this->Session->read('Auth.User.User.id');
		// 		$this->request->data['EmployeeSchedule']['startDate'] = $this->request->data['EmployeeSchedule']['startDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['startDate']['day'];
		// 		$this->request->data['EmployeeSchedule']['endDate'] = $this->request->data['EmployeeSchedule']['endDate']['year'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['month'] . ':' . $this->request->data['EmployeeSchedule']['endDate']['day'];
		// 		$this->request->data['EmployeeSchedule']['meeting_start_time'] = $this->request->data['EmployeeSchedule']['meeting_start_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_start_time']['meridian'];
		// 		$this->request->data['EmployeeSchedule']['meeting_end_time'] = $this->request->data['EmployeeSchedule']['meeting_end_time']['hour'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['min'] . ':' . $this->request->data['EmployeeSchedule']['meeting_end_time']['meridian'];
		// 		$saveddata = $this->EmployeeSchedule->save($this->request->data);
		// 	}
		// }

	}
	public function Meetinglist() {
		$this->layout = 'home';
		$authdata = $this->Session->read('Auth.User.User.id');
		$this->paginate = array(
			'conditions' => array('EmployeeSchedule.user_id' => $authdata),
			'joins' => array(
				array('table' => 'employees',
					'type' => 'INNER',
					'conditions' => array('employees.id' => '21')),
			),
			'limit' => 10,
			'order' => array('id' => 'desc'),
		);
		//$allDate = $this->Employee->find('all',array('conditions'=>array('EmployeeSchedule.user_id'=>$authdata)));
		// $result = $this->paginate();
		//$this->set('schedules', $result);

	}
}
?>
