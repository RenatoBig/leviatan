<?php
App::uses('AppController', 'Controller');
/**
 * ItemGroups Controller
 *
 * @property ItemGroup $ItemGroup
 */
class ItemGroupsController extends AppController {

	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemGroup->recursive = 0;
		
		$options['order'] = array('ItemGroup.keycode'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('itemGroups', $this->paginate());
	}
	
/**
 * view method
 *
 * @return void
 */
	public function view($id = null) {
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		$this->ItemGroup->recursive = 0;
		$itemGroup= $this->ItemGroup->read(null, $id);

		$this->set(compact('itemGroup'));
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
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		$inicio = array(''=>'Selecione um item');
		$groupTypes = $this->ItemGroup->GroupType->find('list');
		
		$groupTypes = $inicio + $groupTypes;
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('controller'=>'item_groups', 'action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemGroup->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->ItemGroup->read(null, $id);
		}
		$inicio = array(''=>'Selecione um item');
		$groupTypes = $this->ItemGroup->GroupType->find('list');
		$groupTypes = $inicio + $groupTypes;
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('controller'=>'item_groups', 'action'=>'index'));		}
		$this->ItemGroup->id = $id;
		if (!$this->ItemGroup->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('controller'=>'item_groups', 'action'=>'index'));
		}
		
		if ($this->ItemGroup->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
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
 