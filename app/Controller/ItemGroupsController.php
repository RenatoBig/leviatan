<?php
App::uses('AppController', 'Controller');
/**
 * ItemGroups Controller
 *
 * @property ItemGroup $ItemGroup
 */
class ItemGroupsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemGroup->recursive = 0;
		$this->set('itemGroups', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		$this->set('itemGroup', $this->ItemGroup->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemGroup->create();
			if ($this->ItemGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The item group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}
		}
		$groupTypes = $this->ItemGroup->GroupType->find('list');
		$this->set(compact('groupTypes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The item group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ItemGroup->read(null, $id);
		}
		$groupTypes = $this->ItemGroup->GroupType->find('list');
		$this->set(compact('groupTypes'));
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
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			throw new NotFoundException(__('Invalid item group'));
		}
		if ($this->ItemGroup->delete()) {
			$this->Session->setFlash(__('Item group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function getByCategory() {
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$idTypeGroup = $this->request->data['Item']['GroupType'];
			
			$inicial = array('0'=>'Selecione um item');
			$itemGroups = $this->ItemGroup->find('list', array(
				'conditions' => array('ItemGroup.group_type_id' => $idTypeGroup),
				'order'=>array('ItemGroup.name ASC'),
				'recursive' => -1
			));
			
			//Concatena o array inicial com os dados vindos do banco de dados
			$itemGroups = $inicial+$itemGroups;
			
			$this->set(compact('itemGroups'));
		}
	}
}
