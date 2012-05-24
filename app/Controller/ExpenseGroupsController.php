<?php
App::uses('AppController', 'Controller');
/**
 * ExpenseGroups Controller
 *
 * @property ExpenseGroup $ExpenseGroup
 */
class ExpenseGroupsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ExpenseGroup->recursive = 0;
		$this->set('expenseGroups', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ExpenseGroup->id = $id;
		if (!$this->ExpenseGroup->exists()) {
			throw new NotFoundException(__('Invalid expense group'));
		}
		$this->set('expenseGroup', $this->ExpenseGroup->read(null, $id));
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
				$this->Session->setFlash(__('The expense group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expense group could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid expense group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ExpenseGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The expense group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expense group could not be saved. Please, try again.'));
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
			throw new MethodNotAllowedException();
		}
		$this->ExpenseGroup->id = $id;
		if (!$this->ExpenseGroup->exists()) {
			throw new NotFoundException(__('Invalid expense group'));
		}
		if ($this->ExpenseGroup->delete()) {
			$this->Session->setFlash(__('Expense group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Expense group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
