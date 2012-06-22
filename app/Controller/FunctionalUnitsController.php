<?php
App::uses('AppController', 'Controller');
/**
 * FunctionalUnits Controller
 *
 * @property FunctionalUnit $FunctionalUnit
 */
class FunctionalUnitsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FunctionalUnit->recursive = 0;
		$this->set('functionalUnits', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->FunctionalUnit->id = $id;
		if (!$this->FunctionalUnit->exists()) {
			throw new NotFoundException(__('Unidade funcional inválida'));
		}
		$this->set('functionalUnit', $this->FunctionalUnit->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FunctionalUnit->create();
			if ($this->FunctionalUnit->save($this->request->data)) {
				$this->Session->setFlash(__('A unidade funcional foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A unidade funcional não pode ser cadastrada. Por favor, tente novamente.'));
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
		$this->FunctionalUnit->id = $id;
		if (!$this->FunctionalUnit->exists()) {
			throw new NotFoundException(__('Unidade funcional inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FunctionalUnit->save($this->request->data)) {
				$this->Session->setFlash(__('A unidade funcional foi alterada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A unidade funcional não pode ser alterada. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->FunctionalUnit->read(null, $id);
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
		$this->FunctionalUnit->id = $id;
		if (!$this->FunctionalUnit->exists()) {
			throw new NotFoundException(__('Unidade funcional inválida'));
		}
		
		$functionalUnits = $this->FunctionalUnit->read(null, $id);
		if(!empty($functionalUnits['PngcCode'])) {
			$this->Session->setFlash('Você não pode detelar esta unidade funcional, ele está cadastrado em outra tabela.');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->FunctionalUnit->delete()) {
			$this->Session->setFlash(__('A unidade funcional foi deletada'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A unidade não pode ser deletada'));
		$this->redirect(array('action' => 'index'));
	}
}
