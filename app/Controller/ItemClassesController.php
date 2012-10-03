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
 * (non-PHPdoc)
 * @see Controller::beforeFilter()
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemClass->recursive = 0;
		
		$options['order'] = array('ItemClass.keycode'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('itemClasses', $this->paginate());
	}
	
/**
 * view method 
 * 
 * @return void
 */
	public function view($id = null) {
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		$itemClass = $this->ItemClass->read(null, $id);
		
		$this->set(compact('itemClass'));
		
		if($this->Auth->user() == null) {
			$this->layout = 'login';
		}else {
			$this->layout = 'leviatan';
		}		
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

		$itemGroups = $this->__getInformationForm();
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
	
/**
 * 
 */
	public function get_categories() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$item_group_id = $this->request->data['parent_id'];
			
			if($item_group_id == "") {
				echo json_encode(array(''=>'Selecione um grupo'));
				return;
			}

			$this->ItemClass->recursive = -1;
			$options['conditions'] = array(
				'ItemClass.item_group_id'=>$item_group_id
			);
			$options['fields'] = array(
				'ItemClass.id', 'ItemClass.keycode', 'ItemClass.name'	
			);
			$options['order'] = array('ItemClass.id'=>'asc');			
			
			$itemClasses = $this->ItemClass->find('all', $options);
			
			foreach($itemClasses as $ic):
				$values[$ic['ItemClass']['id']] = $ic['ItemClass']['keycode'].' - '.$ic['ItemClass']['name'];
			endforeach;
			
			$itemClasses = $values;			
			
			$inicio = array(''=>'-- Nenhum --');
			$itemClasses = $inicio + $itemClasses;
			
			echo json_encode($itemClasses);
		}
	}
	
/**
 * 
 */
	private function __getInformationForm() {
		
		$this->ItemClass->ItemGroup->recursive = -1;
		$options['fields'] = array(
			'ItemGroup.id', 'ItemGroup.keycode', 'ItemGroup.name'	
		);
		$options['order'] = array('ItemGroup.keycode');
		
		$values = $this->ItemClass->ItemGroup->find('all', $options);
		
		foreach($values as $value):
			$itemGroups[$value['ItemGroup']['id']] = $value['ItemGroup']['keycode'].' - '.$value['ItemGroup']['name'];
		endforeach;
		
		$inicio = array(''=>'-- Nenhum --');
		$itemGroups = $inicio + $itemGroups;
		
		return $itemGroups;
	}
}
