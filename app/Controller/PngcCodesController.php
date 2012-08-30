<?php
App::uses('AppController', 'Controller');
/**
 * PngcCodes Controller
 *
 * @property PngcCode $PngcCode
 */
class PngcCodesController extends AppController {
	
	public $layout = 'leviatan';
	public $uses = array('PngcCode', 'Input', 'InputCategory', 'InputSubcategory', 'ExpenseGroup', 'FunctionalUnit', 'MeasureType');
	
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
		$this->PngcCode->recursive = 0;
						
		$options['order'] = array('PngcCode.keycode'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$pngcCodes = $this->paginate();
		
		$this->InputCategory->recursive = -1;
		$this->InputSubcategory->recursive = -1;
		foreach($pngcCodes as $key=>$value) {
			$inputCategory = $this->InputCategory->read(null, $value['Input']['input_category_id']);
			if($value['Input']['input_subcategory_id'] != null) {
				$inputSubcategory = $this->InputSubcategory->read(null, $value['Input']['input_subcategory_id']);
			}else {
				$inputSubcategory['InputSubcategory'] = null;
			}
			$pngcCodes[$key]['InputCategory'] = $inputCategory['InputCategory'];
			$pngcCodes[$key]['InputSubcategory'] = $inputSubcategory['InputSubcategory'];
		}

		$this->set(compact('pngcCodes'));
	}
	
/**
 * view method
 *
 * @param integer $id
 * @return void
 */
	public function view($id = null) {
	
		$this->PngcCode->id = $id;
		if (!$this->PngcCode->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
	
		$pngcCode = $this->PngcCode->read(null, $id);
		$inputCategory = $this->InputCategory->read(null, $pngcCode['Input']['input_category_id']);
		$inputSubcategory = $this->InputSubcategory->read(null, $pngcCode['Input']['input_subcategory_id']);
	
		$this->set(compact('pngcCode', 'inputCategory', 'inputSubcategory'));
		
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
			$this->PngcCode->create();
			
			//Consulta para saber qual o id da tabela input
			//---------------------
			$options['recursive'] = '-1';
			$options['fields'] = array(
				'Input.id'
			);
			$options['conditions'] = array(
				'Input.input_category_id'=>$this->request->data['PngcCode']['input_category_id'],
				'Input.input_subcategory_id'=>$this->request->data['PngcCode']['input_subcategory_id']
			);
			$input = $this->PngcCode->Input->find('first', $options);
			
			if(!$input) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Categoria de insumo inexistente. Favor entrar em contato com ol administrador do sistema.').'</div>');
				$this->redirect($this->referer());
			}
			//-----------------------
			$this->request->data['PngcCode']['input_id'] = $input['Input']['id'];
			//-----------------------------
			
			if($this->PngcCode->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		$expenseGroups = $this->__getDataSelect('ExpenseGroup');
		$measureTypes = $this->__getDataSelect('MeasureType');		
		$inputCategories = $this->__getCategories();
		
		
		$this->set(compact('expenseGroups', 'functionalUnits', 'inputCategories', 'measureTypes'));
	}
	
/**
 * 
 */
	private function __getDataSelect($model) {
		
		$inicio = array(''=>'-- Nenhum --');
		
		$options['fields'] = array(
			$model.'.id', $model.'.name'	
		);
		$options['order'] = array(
			$model.'.name' => 'asc'		
		);
		
		$this->$model->recursive = -1;
		$values = $this->$model->find('all', $options);
		foreach($values as $value):
			$data[$value[$model]['id']] = $value[$model]['name'];
		endforeach;
		
		$data = $inicio + $data;
		
		return $data;
	}
	
	
/**
 * 
 * Enter description here ...
 */
	private function __getCategories() {
		
		$q_input_category = 'SELECT `InputCategory`.`id`, `InputCategory`.`name`
								FROM `input_categories` AS `InputCategory`
								WHERE `InputCategory`.`id` IN 
									(SELECT DISTINCT `Input`.`input_category_id` 
										FROM `inputs` AS `Input`) 
								ORDER BY `InputCategory`.`name` ASC';
		$categories = $this->InputCategory->query($q_input_category);
		
		foreach($categories as $categorie):
			$data[$categorie['InputCategory']['id']] = $categorie['InputCategory']['name']; 
		endforeach;
		
		$inicio = array(''=>'-- Nenhum --');
		$data = $inicio + $data;

		return $data;
		
	}
	
/**
 *
 * Enter description here ...
 */
	private function __getSubcategoriesEdit($input_category_id) {
	
		$q_input_subcategory = 'SELECT `InputSubcategory`.`id`, `InputSubcategory`.`name`
								FROM `input_subcategories` AS `InputSubcategory`
								WHERE `InputSubcategory`.`id` IN
									(SELECT `Input`.`input_subcategory_id`
										FROM `inputs` AS `Input`
										WHERE `Input`.`input_category_id`='.$input_category_id.' 
										) 
								ORDER BY `InputSubcategory`.`name` ASC';
		$subcategories = $this->InputSubcategory->query($q_input_subcategory);
		
		if(empty($subcategories)) {
			$data = array(''=>'-- Nenhum --');	
		}else {
			foreach($subcategories as $subcategorie):
				$data[$subcategorie['InputSubcategory']['id']] = $subcategorie['InputSubcategory']['name'];
			endforeach;
	
			$inicio = array(''=>'-- Nenhum --');
			$data = $inicio + $data;
		}
	
		return $data;
	
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('PNGC inválido').'</div>');
			$this->redirect(array('controller'=>'pngc_codes', 'action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			//Consulta para saber qual o id da tabela input
			//---------------------
			$options['recursive'] = '-1';
			$options['fields'] = array(
				'Input.id'
			);
			$options['conditions'] = array(
				'Input.input_category_id'=>$this->request->data['PngcCode']['input_category_id'],
				'Input.input_subcategory_id'=>$this->request->data['PngcCode']['input_subcategory_id']
			);
			$input = $this->PngcCode->Input->find('first', $options);
			//-----------------------
			$this->request->data['PngcCode']['input_id'] = $input['Input']['id'];
			
			if ($this->PngcCode->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->PngcCode->read(null, $id);
		}
		

		$expenseGroups = $this->__getDataSelect('ExpenseGroup');
		$measureTypes = $this->__getDataSelect('MeasureType');		
		$inputCategories = $this->__getCategories();
		$inputSubcategories = $this->__getSubcategoriesEdit($this->request->data['Input']['input_category_id']);

		$this->set(compact('expenseGroups', 'inputCategories', 'inputSubcategories','measureTypes'));
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
			$this->redirect(array('controller'=>'pngc_codes', 'action'=>'index'));
		}
		$this->PngcCode->id = $id;
		if (!$this->PngcCode->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('controller'=>'pngc_codes', 'action'=>'index'));
		}
		
		if ($this->PngcCode->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 */
	public function checkEntries() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {			
			$expense_group_id = $this->request->data['expense_group_id'];
			$input_category_id = $this->request->data['input_category_id'];
			$input_subcategory_id = $this->request->data['input_subcategory_id'];
			
			$op['conditions'] = array(
				'Input.input_category_id'=>$input_category_id,
				'Input.input_subcategory_id'=>$input_subcategory_id	
			);
			
			$input = $this->Input->find('first', $op);
			
			if(!$input) {
				echo '-1';
				return;
			}
			
			$options['conditions'] = array(
				'PngcCode.expense_group_id'=>$expense_group_id,
				'PngcCode.input_id'=>$input['Input']['id']
			);
			
			$exist = $this->PngcCode->find('first', $options);
			
			if($exist) {
				echo '0';
				return;
			}
			
			echo '1';			
		}
	}
}
