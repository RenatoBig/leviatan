<?php
App::uses('AppController', 'Controller');
/**
 * MeasureTypes Controller
 *
 * @property MeasureType $MeasureType
 */
class MeasureTypesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MeasureType->recursive = 0;
		$this->set('measureTypes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->MeasureType->id = $id;
		if (!$this->MeasureType->exists()) {
			throw new NotFoundException(__('Inválido tipo de medida'));
		}
		$this->set('measureType', $this->MeasureType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->MeasureType->create();
			if ($this->MeasureType->save($this->request->data)) {
				$this->Session->setFlash(__('O tipo de medida foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('o tipo de medida não pode ser cadastrado. Por favor, tente novamente.'));
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
		$this->MeasureType->id = $id;
		if (!$this->MeasureType->exists()) {
			throw new NotFoundException(__('Inválido tipo de medida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeasureType->save($this->request->data)) {
				$this->Session->setFlash(__('o tipo de medida foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo de medida não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->MeasureType->read(null, $id);
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
		$this->MeasureType->id = $id;
		if (!$this->MeasureType->exists()) {
			throw new NotFoundException(__('Inválido tipo de medida'));
		}
		if ($this->MeasureType->delete()) {
			$this->Session->setFlash(__('Tipo de medida deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O tipo de medida nçao pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}
}
