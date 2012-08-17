<?php
App::uses('AppController', 'Controller');
/**
 * GroupTypes Controller
 *
 * @property GroupType $GroupType
 */
class GroupTypesController extends AppController {
	
	public $layout = 'leviatan';


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupType->recursive = -1;
		
		$options['order'] = array('GroupType.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('groupTypes', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupType->create();
			if ($this->GroupType->save($this->request->data)) {
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
		$this->GroupType->id = $id;
		if (!$this->GroupType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupType->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->GroupType->read(null, $id);
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
			$this->redirect(array('action' => 'index'));
		}
		$this->GroupType->id = $id;
		if (!$this->GroupType->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->GroupType->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
