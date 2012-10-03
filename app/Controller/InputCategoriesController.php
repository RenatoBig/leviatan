<?php
App::uses('AppController', 'Controller');
/**
 * InputCategories Controller
 *
 * @property InputCategory $InputCategory
 */
class InputCategoriesController extends AppController {

	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InputCategory->recursive = 0;
		
		$options['order'] = array('InputCategory.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('inputCategories', $this->paginate());
	}
	
/**
 * view method
 *
 * @param integer $id
 * @return void
 */
	public function view($id = null) {
		$this->InputCategory->id = $id;
		if (!$this->InputCategory->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
	
		$this->InputCategory->recursive = -1;
		$inputCategory = $this->InputCategory->read(null, $id);
	
		$this->set(compact('inputCategory'));
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
				$this->__getMessage(SUCCESS);				
			} else {
				$this->__getMessage(ERROR);
			}
			$this->redirect(array('controller'=>'inputs','action' => 'add'));
		}
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}else {
			$this->__getMessage(BAD_REQUEST);
			$this->redirect($this->referer());
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputCategory->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action' => 'index'));
		}
		$this->InputCategory->id = $id;
		if (!$this->InputCategory->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->InputCategory->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
