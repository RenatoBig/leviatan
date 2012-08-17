<?php
App::uses('AppController', 'Controller');
/**
 * MeasureTypes Controller
 *
 * @property MeasureType $MeasureType
 */
class MeasureTypesController extends AppController {
	
	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MeasureType->recursive = -1;
		
		$options['order'] = array('MeasureType.name'=>'asc');
		$options['limit'] = 10;
		
		$this->set('measureTypes', $this->paginate());
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
		$this->MeasureType->id = $id;
		if (!$this->MeasureType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MeasureType->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('controller'=>'measure_types', 'action'=>'index'));
		}
		$this->MeasureType->id = $id;
		if (!$this->MeasureType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('controller'=>'measure_types', 'action'=>'index'));
		}
				
		if ($this->MeasureType->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
