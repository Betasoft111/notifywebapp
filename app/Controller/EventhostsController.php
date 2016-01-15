<?php
App::uses('AppController', 'Controller');
/**
 * Eventhosts Controller
 *
 * @property Eventhost $Eventhost
 * @property PaginatorComponent $Paginator
 */
class EventhostsController extends AppController {

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
	public function index() {
		$this->Eventhost->recursive = 0;
		$this->set('eventhosts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Eventhost->exists($id)) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		$options = array('conditions' => array('Eventhost.' . $this->Eventhost->primaryKey => $id));
		$this->set('eventhost', $this->Eventhost->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Eventhost->create();
			if ($this->Eventhost->save($this->request->data)) {
				$this->Session->setFlash(__('The eventhost has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The eventhost could not be saved. Please, try again.'));
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
		if (!$this->Eventhost->exists($id)) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Eventhost->save($this->request->data)) {
				$this->Session->setFlash(__('The eventhost has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The eventhost could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Eventhost.' . $this->Eventhost->primaryKey => $id));
			$this->request->data = $this->Eventhost->find('first', $options);
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
		$this->Eventhost->id = $id;
		if (!$this->Eventhost->exists()) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Eventhost->delete()) {
			$this->Session->setFlash(__('The eventhost has been deleted.'));
		} else {
			$this->Session->setFlash(__('The eventhost could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Eventhost->recursive = 0;
		$this->set('eventhosts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Eventhost->exists($id)) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		$options = array('conditions' => array('Eventhost.' . $this->Eventhost->primaryKey => $id));
		$this->set('eventhost', $this->Eventhost->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Eventhost->create();
			if ($this->Eventhost->save($this->request->data)) {
				$this->Session->setFlash(__('The eventhost has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The eventhost could not be saved. Please, try again.'));
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
		if (!$this->Eventhost->exists($id)) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Eventhost->save($this->request->data)) {
				$this->Session->setFlash(__('The eventhost has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The eventhost could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Eventhost.' . $this->Eventhost->primaryKey => $id));
			$this->request->data = $this->Eventhost->find('first', $options);
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
		$this->Eventhost->id = $id;
		if (!$this->Eventhost->exists()) {
			throw new NotFoundException(__('Invalid eventhost'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Eventhost->delete()) {
			$this->Session->setFlash(__('The eventhost has been deleted.'));
		} else {
			$this->Session->setFlash(__('The eventhost could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
