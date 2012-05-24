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
			throw new NotFoundException(__('Invalid measure type'));
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
				$this->Session->setFlash(__('The measure type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measure type could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid measure type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeasureType->save($this->request->data)) {
				$this->Session->setFlash(__('The measure type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The measure type could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid measure type'));
		}
		if ($this->MeasureType->delete()) {
			$this->Session->setFlash(__('Measure type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Measure type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
