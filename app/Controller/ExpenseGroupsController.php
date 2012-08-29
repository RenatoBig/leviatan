<?php
App::uses('AppController', 'Controller');
/**
 * ExpenseGroups Controller
 *
 * @property ExpenseGroup $ExpenseGroup
 */
class ExpenseGroupsController extends AppController {
	
	public $layout = 'leviatan';
	public $helpers = array('Fck');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ExpenseGroup->recursive = -1;
		
		$options['order'] = array('ExpenseGroup.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('expenseGroups', $this->paginate());
	}
	
/**
 * view method
 *
 * @param integer $id
 * @return void
 */
	public function view($id = null) {
	
		$this->ExpenseGroup->id = $id;
		if (!$this->ExpenseGroup->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
	
		$this->ExpenseGroup->recursive = -1;
		$expenseGroup = $this->ExpenseGroup->read(null, $id);
	
		$this->set(compact('expenseGroup'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ExpenseGroup->create();
			if ($this->ExpenseGroup->save($this->request->data)) {
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
		$this->ExpenseGroup->id = $id;
		if (!$this->ExpenseGroup->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ExpenseGroup->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->ExpenseGroup->read(null, $id);
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
		$this->ExpenseGroup->id = $id;
		if (!$this->ExpenseGroup->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}

		if ($this->ExpenseGroup->delete()) {
			$this->__getMessage(SUCCESS);			
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
