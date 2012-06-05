<?php
App::uses('AppController', 'Controller');
/**
 * Inputs Controller
 *
 * @property Input $Input
 */
class InputsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Input->recursive = 0;
		$this->set('inputs', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			throw new NotFoundException(__('Invalid input'));
		}
		$this->set('input', $this->Input->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Input->create();
			if ($this->Input->save($this->request->data)) {
				$this->Session->setFlash(__('The input has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input could not be saved. Please, try again.'));
			}
		}
		$inputCategories = $this->Input->InputCategory->find('list');
		$inputSubcategories = $this->Input->InputSubcategory->find('list');
		$this->set(compact('inputCategories', 'inputSubcategories'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			throw new NotFoundException(__('Invalid input'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Input->save($this->request->data)) {
				$this->Session->setFlash(__('The input has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Input->read(null, $id);
		}
		$inputCategories = $this->Input->InputCategory->find('list');
		$inputSubcategories = $this->Input->InputSubcategory->find('list');
		$this->set(compact('inputCategories', 'inputSubcategories'));
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
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			throw new NotFoundException(__('Invalid input'));
		}
		if ($this->Input->delete()) {
			$this->Session->setFlash(__('Input deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Input was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
