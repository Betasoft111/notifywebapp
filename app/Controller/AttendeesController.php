<?php
App::uses('AppController', 'Controller');
/**
 * Attendees Controller
 *
 * @property Attendee $Attendee
 * @property PaginatorComponent $Paginator
 */
class AttendeesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('addEventByHost', 'addEventByAttendee', 'attendeelist');
	}

/**
 * index method
 *
 * @return void
 */

	public function index() {
		$this->Attendee->recursive = 0;
		$this->set('attendees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
		$this->set('attendee', $this->Attendee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attendee->create();
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
			$this->request->data = $this->Attendee->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Attendee->delete()) {
			$this->Session->setFlash(__('The attendee has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attendee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Attendee->recursive = 0;
		$this->set('attendees', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
		$this->set('attendee', $this->Attendee->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attendee->create();
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Attendee->exists($id)) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Attendee->save($this->request->data)) {
				$this->Session->setFlash(__('The attendee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attendee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attendee.' . $this->Attendee->primaryKey => $id));
			$this->request->data = $this->Attendee->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Attendee->id = $id;
		if (!$this->Attendee->exists()) {
			throw new NotFoundException(__('Invalid attendee'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Attendee->delete()) {
			$this->Session->setFlash(__('The attendee has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attendee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function addEventByAttendee()
	{ 
		if(!empty($_POST['event_code']) && !empty($_POST['event_name']) && !empty($_POST['status']))
		{ 
			$this->loadModel('Event');
			$this->loadModel('Attendee');

			$count=$this->Event->find('count',array('conditions'=>array('Event.eventCode'=>trim($_POST['event_code']))));
	        if($count > '0')
	        {
	        	$data['Attendee'] = array('userid' => $_POST['event_userid'],
								'eventname' => $_POST['event_name'],
								'eventcode' => $_POST['event_code'],
								'status' => $_POST['status']
								);
	        	if ($this->Attendee->save($data))
				{
					echo json_encode(array('Message'=>'Successfully added','Data'=>$data)); die;
				}else{
					echo json_encode(array('Error' => 'Failed to store data.')); die;
				}
	        }else{
	        	echo json_encode(array('Error'=>'Event code does not exist!')); die;
	        }
		}

		echo json_encode(array('Error' => 'Parameter invalid!')); die;
	}

	public function addEventByHost()
	{
		if(!empty($_POST['eventName']) && !empty($_POST['status']))
		{ 
			$this->loadModel('Event');

			$data['Event'] = array('user_id' => $_POST['user_id'],
								'eventName' => $_POST['eventName'],
								'startTime' => $_POST['startTime'],
								'endTime' => $_POST['endTime'],
								'startDate' => $_POST['startDate'],
								'endDate' => $_POST['endDate'],
								'repeatType' => $_POST['repeatType'],
								'interval' => $_POST['interval'],
								'latitude' => $_POST['latitude'],
								'longitude' => $_POST['longitude'],
								'status' => $_POST['status']
								);

			if (isset($_POST['id']))
			{
				$data['Event']['id'] = $_POST['id'];
			}

			if (isset($_POST['district']))
			{
				$data['Event']['district'] = $_POST['district'];
			}

			if (isset($_POST['eventCode']))
			{
				$data['Event']['eventCode'] = $_POST['eventCode'];
			}

			$this->Event->create();
			
			if ($this->Event->save($data))
			{
				echo json_encode(array('Message'=>'Successfully added','Data'=>$data)); die;
			}else{
				echo json_encode(array('Error' => 'Failed to store data.')); die;
			}
		}

		echo json_encode(array('Error' => 'Parameter invalid!')); die;
	}

	public function attendeelist(){
		if(!empty($_POST['id']))
		{ 
			$this->loadModel('Attendee');
			$data=$this->Attendee->find('all',array('conditions'=>array('userid'=>trim($_POST['id'])),'recursive'=>-1));

			if(!empty($data))
			{
				echo json_encode(array('Message'=>'Successfully fetched.','Data'=>$data)); die;
			}
			else
			{
				echo json_encode(array('Error'=>'No record found')); die;
			}
		}

		echo json_encode(array('Error' => 'Parameter invalid!')); die;
	}
}
