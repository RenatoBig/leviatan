<?php
App::uses('AppController', 'Controller');
/**
 * FunctionalUnits Controller
 *
 * @property FunctionalUnit $FunctionalUnit
 */
class FunctionalUnitsController extends AppController {

	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FunctionalUnit->recursive = -1;
		
		$options['order'] = array('FunctionalUnit.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('functionalUnits', $this->paginate());
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
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->FunctionalUnit->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->referer(array('action'=>'index'));
		}
		$this->FunctionalUnit->id = $id;
		if (!$this->FunctionalUnit->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->FunctionalUnit->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
