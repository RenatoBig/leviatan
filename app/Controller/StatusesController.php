<?php
App::uses('AppController', 'Controller');
/**
 * Statuses Controller
 *
 * @property Status $Status
 */
class StatusesController extends AppController {

	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Status->recursive = -1;
		
		$options['order'] = array('Status.id'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('statuses', $this->paginate());
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
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('controller'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Status->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);				
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->Status->id = $id;
		if (!$this->Status->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Status->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
