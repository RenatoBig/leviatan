<?php
App::uses('AppController', 'Controller');
/**
 * InputCategories Controller
 *
 * @property InputCategory $InputCategory
 */
class InputCategoriesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InputCategory->recursive = 0;
		$this->set('inputCategories', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->InputCategory->id = $id;
		if (!$this->InputCategory->exists()) {
			throw new NotFoundException(__('Invalid input category'));
		}
		$this->set('inputCategory', $this->InputCategory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InputCategory->create();
			if ($this->InputCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The input category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input category could not be saved. Please, try again.'));
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
		$this->InputCategory->id = $id;
		if (!$this->InputCategory->exists()) {
			throw new NotFoundException(__('Invalid input category'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The input category has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input category could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InputCategory->read(null, $id);
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
		$this->InputCategory->id = $id;
		if (!$this->InputCategory->exists()) {
			throw new NotFoundException(__('Invalid input category'));
		}
		if ($this->InputCategory->delete()) {
			$this->Session->setFlash(__('Input category deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Input category was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
