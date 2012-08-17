<?php
App::uses('AppController', 'Controller');
/**
 * ItemClasses Controller
 *
 * @property ItemClass $ItemClass
 */
class ItemClassesController extends AppController {
	
	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemClass->recursive = 0;
		
		$options['order'] = array('ItemClass.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('itemClasses', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemClass->create();
			if ($this->ItemClass->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		$inicio = array(''=>'Selecione um item');
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
		$itemGroups = $inicio + $itemGroups;
		$this->set(compact('itemGroups'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemClass->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->ItemClass->read(null, $id);
		}
		$inicio = array(''=>'Selecione um item');
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
		$itemGroups = $inicio + $itemGroups;
		$this->set(compact('itemGroups'));
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
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->ItemClass->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR);
		}
		
		$this->redirect(array('action' => 'index'));
	}
}
