<?php
App::uses('AppController', 'Controller');
/**
 * Forwardings Controller
 *
 * @property Forwarding $Forwarding
 */
class ForwardingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Forwarding->recursive = 0;
		$this->set('forwardings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Forwarding->id = $id;
		if (!$this->Forwarding->exists()) {
			throw new NotFoundException(__('Invalid forwarding'));
		}
		$this->set('forwarding', $this->Forwarding->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Forwarding->create();
			if ($this->Forwarding->save($this->request->data)) {
				$this->Session->setFlash(__('The forwarding has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forwarding could not be saved. Please, try again.'));
			}
		}
		$domains = $this->Forwarding->Domain->find('list');
		$this->set(compact('domains'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Forwarding->id = $id;
		if (!$this->Forwarding->exists()) {
			throw new NotFoundException(__('Invalid forwarding'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Forwarding->save($this->request->data)) {
				$this->Session->setFlash(__('The forwarding has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forwarding could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Forwarding->read(null, $id);
		}
		$domains = $this->Forwarding->Domain->find('list');
		$this->set(compact('domains'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Forwarding->id = $id;
		if (!$this->Forwarding->exists()) {
			throw new NotFoundException(__('Invalid forwarding'));
		}
		if ($this->Forwarding->delete()) {
			$this->Session->setFlash(__('Forwarding deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Forwarding was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
