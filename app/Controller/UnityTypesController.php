<?php
App::uses('AppController', 'Controller');
/**
 * UnityTypes Controller
 *
 * @property UnityType $UnityType
 */
class UnityTypesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnityType->recursive = 0;
		$this->set('unityTypes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			throw new NotFoundException(__('Inválido tipo da unidade.'));
		}
		$this->set('unityType', $this->UnityType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnityType->create();
			if ($this->UnityType->save($this->request->data)) {
				$this->Session->setFlash(__('O tipo da unidade foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo da unidade não pode ser cadastrado. Por favor, tente novamente.'));
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
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			throw new NotFoundException(__('tipo da unidade inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnityType->save($this->request->data)) {
				$this->Session->setFlash(__('O tipo da unidade foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo da unidade não foi alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->UnityType->read(null, $id);
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
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			throw new NotFoundException(__('tipo da unidade inválida'));
		}
		if ($this->UnityType->delete()) {
			$this->Session->setFlash(__('tipo da unidade deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O tipo da unidade não pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}
}
