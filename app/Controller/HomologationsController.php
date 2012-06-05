<?php
App::uses('AppController', 'Controller');
/**
 * Homologations Controller
 *
 * @property Homologation $Homologation
 */
class HomologationsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Homologation->recursive = 0;
		$this->set('homologations', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Invalid homologation'));
		}
		$this->set('homologation', $this->Homologation->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Homologation->create();
			if ($this->Homologation->save($this->request->data)) {
				$this->Session->setFlash(__('The homologation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The homologation could not be saved. Please, try again.'));
			}
		}
		$orderItems = $this->Homologation->OrderItem->find('list');
		$this->set(compact('orderItems'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Invalid homologation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Homologation->save($this->request->data)) {
				$this->Session->setFlash(__('The homologation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The homologation could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Homologation->read(null, $id);
		}
		$orderItems = $this->Homologation->OrderItem->find('list');
		$this->set(compact('orderItems'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Invalid homologation'));
		}
		if ($this->Homologation->delete()) {
			$this->Session->setFlash(__('Homologation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Homologation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
