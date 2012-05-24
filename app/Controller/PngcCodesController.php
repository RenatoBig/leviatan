<?php
App::uses('AppController', 'Controller');
/**
 * PngcCodes Controller
 *
 * @property PngcCode $PngcCode
 */
class PngcCodesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PngcCode->recursive = 0;
		$this->set('pngcCodes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PngcCode->id = $id;
		if (!$this->PngcCode->exists()) {
			throw new NotFoundException(__('Invalid pngc code'));
		}
		$this->set('pngcCode', $this->PngcCode->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PngcCode->create();
			if ($this->PngcCode->save($this->request->data)) {
				$this->Session->setFlash(__('The pngc code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pngc code could not be saved. Please, try again.'));
			}
		}
		$expenseGroups = $this->PngcCode->ExpenseGroup->find('list');
		$functionalUnits = $this->PngcCode->FunctionalUnit->find('list');
		$inputCategories = $this->PngcCode->InputCategory->find('list');
		$inputSubcategories = $this->PngcCode->InputSubcategory->find('list');
		$measureTypes = $this->PngcCode->MeasureType->find('list');
		$this->set(compact('expenseGroups', 'functionalUnits', 'inputCategories', 'inputSubcategories', 'measureTypes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PngcCode->id = $id;
		if (!$this->PngcCode->exists()) {
			throw new NotFoundException(__('Invalid pngc code'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PngcCode->save($this->request->data)) {
				$this->Session->setFlash(__('The pngc code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pngc code could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PngcCode->read(null, $id);
		}
		$expenseGroups = $this->PngcCode->ExpenseGroup->find('list');
		$functionalUnits = $this->PngcCode->FunctionalUnit->find('list');
		$inputCategories = $this->PngcCode->InputCategory->find('list');
		$inputSubcategories = $this->PngcCode->InputSubcategory->find('list');
		$measureTypes = $this->PngcCode->MeasureType->find('list');
		$this->set(compact('expenseGroups', 'functionalUnits', 'inputCategories', 'inputSubcategories', 'measureTypes'));
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
		$this->PngcCode->id = $id;
		if (!$this->PngcCode->exists()) {
			throw new NotFoundException(__('Invalid pngc code'));
		}
		if ($this->PngcCode->delete()) {
			$this->Session->setFlash(__('Pngc code deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pngc code was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
