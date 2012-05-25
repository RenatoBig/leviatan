<?php
App::uses('AppController', 'Controller');
/**
 * InputSubcategories Controller
 *
 * @property InputSubcategory $InputSubcategory
 */
class InputSubcategoriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InputSubcategory->recursive = 0;
		$this->set('inputSubcategories', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			throw new NotFoundException(__('Invalid input subcategory'));
		}
		$this->set('inputSubcategory', $this->InputSubcategory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InputSubcategory->create();
			if ($this->InputSubcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The input subcategory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input subcategory could not be saved. Please, try again.'));
			}
		}
		$inputCategories = $this->InputSubcategory->InputCategory->find('list');
		$this->set(compact('inputCategories'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			throw new NotFoundException(__('Invalid input subcategory'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputSubcategory->save($this->request->data)) {
				$this->Session->setFlash(__('The input subcategory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The input subcategory could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->InputSubcategory->read(null, $id);
		}
		$inputCategories = $this->InputSubcategory->InputCategory->find('list');
		$this->set(compact('inputCategories'));
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
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			throw new NotFoundException(__('Invalid input subcategory'));
		}
		if ($this->InputSubcategory->delete()) {
			$this->Session->setFlash(__('Input subcategory deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Input subcategory was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
