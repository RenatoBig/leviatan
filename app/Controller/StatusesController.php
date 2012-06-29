<?php
App::uses('AppController', 'Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 */
class StatusesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Status->recursive = 0;
		$this->set('statuses', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Status inválido'));
		}
		$this->set('status', $this->Status->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Status->create();
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('O status foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O status não pode ser cadastrado. Por favor, tente novamente.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Status inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Status->save($this->request->data)) {
				$this->Session->setFlash(__('O status foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O status não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Status->read(null, $id);
		}
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
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			throw new NotFoundException(__('Status inválido'));
		}
		if ($this->Status->delete()) {
			$this->Session->setFlash(__('Status deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O status não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.'));
		$this->redirect(array('action' => 'index'));
	}
}
