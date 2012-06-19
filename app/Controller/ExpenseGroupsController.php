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
			throw new NotFoundException(__('Grupo de gastos inválido'));
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
				$this->Session->setFlash(__('O grupo de gastos foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grupo de gastos não pode ser cadastrado. Por favor, tente novamente.'));
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
				$this->Session->setFlash(__('O grupo de gastos foi alterado.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grupo de gastos não pode ser alterado. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Grupo de gastos inválido'));
		}
		if ($this->ExpenseGroup->delete()) {
			$this->Session->setFlash(__('Grupo de gastos deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O grupo de gastos não pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}
}
