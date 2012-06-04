<?php
App::uses('AppController', 'Controller');
/**
 * ItemClasses Controller
 *
 * @property ItemClass $ItemClass
 */
class ItemClassesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemClass->recursive = 0;
		$this->set('itemClasses', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			throw new NotFoundException(__('Invalid item class'));
		}
		$this->set('itemClass', $this->ItemClass->read(null, $id));
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
				$this->Session->setFlash(__('The item class has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item class could not be saved. Please, try again.'));
			}
		}
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
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
			throw new NotFoundException(__('Invalid item class'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemClass->save($this->request->data)) {
				$this->Session->setFlash(__('The item class has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item class could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemClass->read(null, $id);
		}
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
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
			throw new MethodNotAllowedException();
		}
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			throw new NotFoundException(__('Invalid item class'));
		}
		if ($this->ItemClass->delete()) {
			$this->Session->setFlash(__('Item class deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item class was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function getByCategory() {
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$idItemGroup = $this->request->data['Item']['ItemGroup'];
			
			$inicial = array('0'=>'Selecione um item');
			$itemClasses = $this->ItemClass->find('list', array(
				'conditions' => array('ItemClass.item_group_id' => $idItemGroup),
				'recursive' => -1
			));
			
			//Concatena o array inicial com os dados vindos do banco de dados
			$itemClasses= $inicial+$itemClasses;
			
			$this->set(compact('itemClasses'));
		}
	}
}
