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
			throw new NotFoundException(__('Invalid functional unit'));
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
				$this->Session->setFlash(__('The functional unit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The functional unit could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid functional unit'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FunctionalUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The functional unit has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The functional unit could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid functional unit'));
		}
		if ($this->FunctionalUnit->delete()) {
			$this->Session->setFlash(__('Functional unit deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Functional unit was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
