<?php
App::uses('AppController', 'Controller');
/**
 * Parrents Controller
 *
 * @property Parrent $Parrent
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ParrentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
  public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('app_add');
}
	public function index() {
		$this->Parrent->recursive = 0;
		$this->set('parrents', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Parrent->exists($id)) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		$options = array('conditions' => array('Parrent.' . $this->Parrent->primaryKey => $id));
		$this->set('parrent', $this->Parrent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Parrent->create();
			if ($this->Parrent->save($this->request->data)) {
				$this->Session->setFlash(__('The parrent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parrent could not be saved. Please, try again.'));
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
		if (!$this->Parrent->exists($id)) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Parrent->save($this->request->data)) {
				$this->Session->setFlash(__('The parrent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parrent could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Parrent.' . $this->Parrent->primaryKey => $id));
			$this->request->data = $this->Parrent->find('first', $options);
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
		$this->Parrent->id = $id;
		if (!$this->Parrent->exists()) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Parrent->delete()) {
			$this->Session->setFlash(__('The parrent has been deleted.'));
		} else {
			$this->Session->setFlash(__('The parrent could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Parrent->recursive = 0;
		$this->set('parrents', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Parrent->exists($id)) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		$options = array('conditions' => array('Parrent.' . $this->Parrent->primaryKey => $id));
		$this->set('parrent', $this->Parrent->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Parrent->create();
			if ($this->Parrent->save($this->request->data)) {
				$this->Session->setFlash(__('The parrent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parrent could not be saved. Please, try again.'));
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
		if (!$this->Parrent->exists($id)) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Parrent->save($this->request->data)) {
				$this->Session->setFlash(__('The parrent has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The parrent could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Parrent.' . $this->Parrent->primaryKey => $id));
			$this->request->data = $this->Parrent->find('first', $options);
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
		$this->Parrent->id = $id;
		if (!$this->Parrent->exists()) {
			throw new NotFoundException(__('Invalid parrent'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Parrent->delete()) {
			$this->Session->setFlash(__('The parrent has been deleted.'));
		} else {
			$this->Session->setFlash(__('The parrent could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
