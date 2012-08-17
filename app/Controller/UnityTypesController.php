<?php
App::uses('AppController', 'Controller');
/**
 * UnityTypes Controller
 *
 * @property UnityType $UnityType
 */
class UnityTypesController extends AppController {
	
	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnityType->recursive = -1;
		
		$options['order'] = array('UnityType.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('unityTypes', $this->paginate());
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
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnityType->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));		}
		
		if ($this->UnityType->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
