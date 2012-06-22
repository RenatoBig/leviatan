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
			throw new NotFoundException(__('Categoria inválida'));
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
				$this->Session->setFlash(__('A categoria foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A categoria não pode ser cadastrada. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Categoria inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputCategory->save($this->request->data)) {
				$this->Session->setFlash(__('A categoria foi alterada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A categoria não pode ser alterada. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Categoria inválida'));
		}
		
		$inputCategory = $this->InputCategory->read(null, $id);
		if(!empty($inputCategory['Input'])) {
			$this->Session->setFlash('Você não pode deletar esta categoria, ela está cadastrada em outra tabela.');
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->InputCategory->delete()) {
			$this->Session->setFlash(__('Categoria deletada'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A categoria não pode ser deletada'));
		$this->redirect(array('action' => 'index'));
	}
}
