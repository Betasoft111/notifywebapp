<?php
App::uses('AppController', 'Controller');
/**
 * Teachers Controller
 *
 * @property Teacher $Teacher
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LocationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Auth', 'Gcm');
	public $uses = array('Employee', 'User', 'Location', 'LocationChecklist', 'EmployeeSchedule');
/**
 * index method
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		//$this->Auth->allow();
		$authdata = $this->Session->read('Auth.User.User.id');
		$parentData = $this->User->findById($authdata);
		$this->set('parentData', $parentData);
	}

	/**
	 * List Locations
	 */
	public function index() {
		$this->set('title', 'Locations List');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$userRole = $this->Session->read('Auth.User.Role');

		$userLocation = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata)));

		$currentUser = $this->User->find('first', array('conditions' => array('User.id' => $authdata)));

		$userView = ($currentUser['User'] && $currentUser['User']['userview']) ? $currentUser['User']['userview'] : '';

		$userRole = ($userRole[0] && $userRole[0]['role']) ? $userRole[0]['role'] : '';

		if ($userView === 'Healthcare' && $userRole == 10) {
			if (empty($userLocation)) {
				$this->Session->setFlash(__('Please add the location'));
				$this->redirect(array('controller' => 'locations', 'action' => 'add'));
			}
		}

		$user_id = $this->Session->read('Auth.User.User.id');
		$this->paginate = array(
			'conditions' => array('Location.user_id' => $user_id),
			'limit' => 10,
			'order' => array('id' => 'desc'),
		);

		$locations = $this->paginate('Location');
		$this->set('locations', $locations);
	}

	/**
	 * List Locations
	 */
	public function locationsList() {
		$this->set('title', 'Locations List');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$userRole = $this->Session->read('Auth.User.Role');

		$userLocation = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata)));

		$currentUser = $this->User->find('first', array('conditions' => array('User.id' => $authdata)));

		$userView = ($currentUser['User'] && $currentUser['User']['userview']) ? $currentUser['User']['userview'] : '';

		$userRole = ($userRole[0] && $userRole[0]['role']) ? $userRole[0]['role'] : '';

		if ($userView === 'Healthcare' && $userRole == 10) {
			if (empty($userLocation)) {
				$this->Session->setFlash(__('Please add the location'));
				$this->redirect(array('controller' => 'locations', 'action' => 'add'));
			}
		}

		$user_id = $this->Session->read('Auth.User.User.id');
		$this->paginate = array(
			'conditions' => array('Location.user_id' => $user_id),
			'limit' => 10,
			'order' => array('id' => 'desc'),
		);

		$locations = $this->paginate('Location');
		$this->set('locations', $locations);
	}

	/**
	 * Add Location
	 */
	public function add() {
		$this->set('title', 'Add Location');
		$this->layout = 'home_hc';

		$this->loadModel('Beacon');
		$beacons = $this->Beacon->find('all');

		$this->set('beacons', $beacons);

		if ($this->request->is('post')) {

			if ($this->request->data['Location']['location_type'] === 'beacon_location') {
				if (!$this->request->data['Location']['Beacon'] || $this->request->data['Location']['Beacon'] == '') {
					$this->Session->setFlash(__('Please select a beacon atleast'));
					$this->redirect(array('controller' => 'locations', 'action' => 'add'));

				} else {
					$this->request->data['Location']['beacon_id'] = $this->request->data['Location']['Beacon'];
				}

			} else if ($this->request->data['Location']['location_type'] === 'manuall_address') {

				if (!$this->request->data['Location']['location_Setup'] || $this->request->data['Location']['location_Setup'] == '') {

					$this->Session->setFlash(__('Please enter the location address'));
					$this->redirect(array('controller' => 'locations', 'action' => 'add'));
				}
			}

			$this->request->data['Location']['user_id'] = $this->Session->read('Auth.User.User.id');
			$savedData = $this->Location->save($this->request->data);
			if ($savedData) {

				$this->Session->setFlash(__('Location has been successfully added'));
				$this->redirect(array('controller' => 'locations', 'action' => 'index'));

			}
		}
	}

	/**
	 * Update Location
	 */
	public function edit($id = null) {

		$this->set('title', 'Update Location');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');

		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $id)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to update the selected location'));
			$this->redirect('/locations');
		}

		if ($this->request->is('post')) {

			$this->Location->id = $id;

			if ($this->request->data['Location']['location_type'] === 'beacon_location') {
				if (!$this->request->data['Location']['Beacon'] || $this->request->data['Location']['Beacon'] == '') {
					$this->Session->setFlash(__('Please select a beacon atleast'));
					$this->redirect(array('controller' => 'locations', 'action' => 'add'));

				} else {
					$this->request->data['Location']['beacon_id'] = $this->request->data['Location']['Beacon'];
				}

			} else if ($this->request->data['Location']['location_type'] === 'manuall_address') {

				if (!$this->request->data['Location']['location_Setup'] || $this->request->data['Location']['location_Setup'] == '') {

					$this->Session->setFlash(__('Please enter the location address'));
					$this->redirect(array('controller' => 'locations', 'action' => 'add'));
				}
			}

			$this->request->data['Location']['user_id'] = $this->Session->read('Auth.User.User.id');
			$savedData = $this->Location->save($this->request->data);

			if ($savedData) {

				$this->Session->setFlash(__('Location has been successfully updated'));
				$this->redirect(array('controller' => 'locations', 'action' => 'index'));

			}
		}

		$this->loadModel('Beacon');
		$beacons = $this->Beacon->find('all');
		$this->set('id', $id);
		$this->set('beacons', $beacons);
		$this->set('location', $location['Location']);
	}

	/**
	 * View Location
	 */
	public function view($id = null) {

		$this->set('title', 'View Location');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');

		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $id)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to update the selected location'));
			$this->redirect('/locations');
		}

		$this->set('id', $id);

	}

	/**
	 * Delete Location
	 */
	public function delete($id = null) {
		//$this->Teacher->deleteAll(array('Teacher.id' => $idde));

		$authdata = $this->Session->read('Auth.User.User.id');

		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $id)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to delete the selected location'));
			$this->redirect('/locations');
		}

		$this->Location->deleteAll(array('Location.id' => $id));
		$this->Session->setFlash(__('Location has been successfully deleted'));
		$this->redirect(array('controller' => 'locations', 'action' => 'index'));
	}

	/**
	 * Create Checklist
	 */
	public function checklist($id = null) {
		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		$this->set('id', $id);

		if ($this->request->is('post')) {

			$this->request->data['LocationChecklist']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['LocationChecklist']['location_id'] = $id;
			$savedData = $this->LocationChecklist->save($this->request->data);
			if ($savedData) {

				$this->Session->setFlash(__('Location checklist has been successfully added'));
				$this->redirect(array('controller' => 'management', 'action' => 'index'));

			}
		}
	}

	/**
	 * Add Employee
	 */
	public function addemployee($id = null) {

		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		$this->set('id', $id);

		if ($this->request->is('post')) {
			$this->Employee->create();
			$this->request->data['Employee']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['Employee']['location_id'] = $id;

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
						$this->request->data['Employee']['location_id'] = $id;
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

	/**
	 * List Employees Of Selected Location
	 */
	public function employees($id = null) {
		$this->set('title', 'Location Employees');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $id)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$employees = $this->Employee->find('all', array('conditions' => array('Employee.location_id' => $id)));
		$this->set('id', $id);
		//$employees = $this->paginate('Employee');
		$this->set('employees', $employees);
	}

	/**
	 * Edit the employee details
	 */
	public function employeesview($locationid, $empid) {
		$this->set('title', 'Location Employees');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locationid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$employdata = $this->Employee->find('first', array('conditions' => array('Employee.id' => $empid)));
		if (empty($employdata)) {
			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations/view/' . $locationid);
		}

		$this->set('locationid', $locationid);
		$this->set('empid', $empid);
	}

	/**
	 * Update the employee details
	 */
	public function emplyeeupdate($locationid, $empid) {

		$this->set('title', 'Location Employees');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locationid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations/view/' . $locationid);
		}

		$this->Employee->id = $empid;
		$employdata = $this->Employee->find('first', array('conditions' => array('Employee.id' => $empid)));

		if (empty($employdata)) {
			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		if ($this->request->is('post')) {
			//$this->Employee->create();
			$this->Employee->id = $empid;
			$this->request->data['Employee']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['Employee']['location_id'] = $locationid;

			if ($this->data['Employee']['image']['name']) {
				$file_name = $this->data['Employee']['image']['name'];
				$file_size = $this->data['Employee']['image']['size'];
				$file_tmp = $this->data['Employee']['image']['tmp_name'];
				$file_type = $this->data['Employee']['image']['type'];
				if ($file_size > 2097152) {
					$this->Session->setFlash(__('File size must be less than 2 MB'));
					$this->redirect('/locations/emplyeeupdate/' . $locationid . '/' . $empid);
				} else {
					$namechange = time() . $file_name;
					$data = WWW_ROOT . 'bss_files/' . $namechange;
					$url = "http://abdevs.com/attendance/bss_files/" . $namechange;
					if (move_uploaded_file($file_tmp, $data)) {
						$this->request->data['Employee']['image'] = $namechange;
						$this->request->data['Employee']['employee_email'] = $this->request->data['Employee']['email'];
						$this->request->data['Employee']['location_id'] = $id;
						if ($this->Employee->save($this->request->data)) {
							$this->Session->setFlash(__('The employee has been saved.'));
							//return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
							$this->redirect('/locations/employeesview/' . $locationid . '/' . $empid);
						} else {
							$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
						}
					}
				}

			} else {
				$this->request->data['Employee']['image'] = '';
				if ($this->Employee->save($this->request->data)) {
					$this->Session->setFlash(__('The employee has been saved.'));
					$this->redirect('/locations/employeesview/' . $locationid . '/' . $empid);
					//return $this->redirect(array('controller' => 'management', 'action' => 'employlist'));
				} else {
					$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
					$this->redirect('/locations/emplyeeupdate/' . $locationid . '/' . $empid);
				}
			}
		}

		$this->set('employee', $employdata);
		$this->set('locationid', $locationid);
		$this->set('empid', $empid);

		//$this->redirect('/locations/employees/' . $locationid);
	}

	/**
	 * Delete the employee
	 */
	public function delete_emp($id) {

		$this->layout = null;
		$this->autoRender = false;

		$deleted = $this->Employee->deleteAll(array('Employee.id' => $id));

		if ($deleted) {
			$response = array('success' => true);
			echo json_encode($response);
			return;
		} else {
			$response = array('success' => false);
			echo json_encode($response);
			return;
		}
	}

	/**
	 * List of checklist for the location
	 */
	public function checklists($id) {
		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $id)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$checklists = $this->LocationChecklist->find('all', array('conditions' => array('LocationChecklist.location_id' => $id)));

		$this->set('id', $id);
		$this->set('checklists', $checklists);
	}

	/**
	 * View the selected checklist for the location
	 */
	public function viewchecklist($locid, $id) {

		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$this->set('locid', $locid);
		$this->set('id', $id);
	}

	/**
	 * Delete checklist
	 */
	public function delete_checklist($id) {

		$this->layout = null;
		$this->autoRender = false;

		$deleted = $this->LocationChecklist->deleteAll(array('LocationChecklist.id' => $id));

		if ($deleted) {
			$response = array('success' => true);
			echo json_encode($response);
			return;
		} else {
			$response = array('success' => false);
			echo json_encode($response);
			return;
		}
	}

	/**
	 * Add New checklist to the location
	 */
	public function addchecklist($locid) {

		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		if ($this->request->is('post')) {

			$this->request->data['LocationChecklist']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['LocationChecklist']['location_id'] = $locid;

			$savedData = $this->LocationChecklist->save($this->request->data);
			if ($savedData) {

				$this->Session->setFlash(__('LocationChecklist has been successfully added'));
				$this->redirect('/locations/checklists/' . $locid);

			}
		}

		$this->set('locid', $locid);
	}

	/**
	 * Update the details about the cheklist
	 */
	public function checklistupdate($locid, $id) {
		$this->set('title', 'Location Checklist');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		if ($this->request->is('post')) {

			$this->request->data['LocationChecklist']['user_id'] = $this->Session->read('Auth.User.User.id');
			$this->request->data['LocationChecklist']['location_id'] = $locid;

			$this->LocationChecklist->id = $id;
			$savedData = $this->LocationChecklist->save($this->request->data);
			if ($savedData) {

				$this->Session->setFlash(__('LocationChecklist has been successfully added'));
				$this->redirect('/locations/checklists/' . $locid);

			}
		}

		$checklistData = $this->LocationChecklist->find('first', array('conditions' => array('LocationChecklist.id' => $id)));

		if (empty($checklistData)) {

			$this->Session->setFlash(__('Your are not authorized for this action'));
			$this->redirect('/locations/checklists/' . $locid);
		}

		$this->set('locid', $locid);
		$this->set('id', $id);
		$this->set('checklistData', $checklistData['LocationChecklist']);
	}

	/**
	 * List All Meetings On The Location
	 */
	public function meetings($locid) {

		$this->set('title', 'Location Meetings');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$meetings = $this->EmployeeSchedule->find('all', array('conditions' => array('EmployeeSchedule.location_id' => $locid)));

		$this->set('locid', $locid);
		$this->set('meetings', $meetings);
	}

	/**
	 * View Details Of Meeting
	 */
	public function viewmeeting($locid, $id) {

		$this->set('title', 'Meeting Details');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$this->set('id', $id);
		$this->set('locid', $locid);
	}

	/**
	 * Add New Meeting
	 */
	public function addmeeting($locid) {

		$this->set('title', 'Add Meeting');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		$allDate = $this->Employee->find('all', array('conditions' => array('Employee.user_id' => $authdata)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$this->set('employee', $allDate);
		$this->set('locid', $locid);
		//	$this->set('id', $id);
	}

	/**
	 * Update The Meeting Details
	 */
	public function updatemeeting($locid, $id) {

		$this->set('title', 'Update Meeting');
		$this->layout = 'home_hc';

		$authdata = $this->Session->read('Auth.User.User.id');
		$location = $this->Location->find('first', array('conditions' => array('Location.user_id' => $authdata, 'Location.id' => $locid)));

		if (empty($location)) {

			$this->Session->setFlash(__('You are not authorized to access this page'));
			$this->redirect('/locations');
		}

		$meetings = $this->EmployeeSchedule->find('first', array('conditions' => array('EmployeeSchedule.id' => $locid)));

		$this->set('id', $id);
		$this->set('locid', $locid);
		$this->set('meetings', $meetings);
	}
}
