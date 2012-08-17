<?php
App::uses('AppController', 'Controller');
/**
 * PngcCodes Controller
 *
 * @property PngcCode $PngcCode
 */
class PngcCodesController extends AppController {
	
	public $layout = 'leviatan';
	public $uses = array('PngcCode', 'Input', 'InputCategory');

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
		
		$this->set('pngcCodes', $this->paginate());
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
			//-----------------------
			$this->request->data['PngcCode']['input_id'] = $input['Input']['id'];
			
			if ($this->PngcCode->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		$inicio = array(''=>'Selecione um item');
		$expenseGroups = $this->PngcCode->ExpenseGroup->find('list');
		$functionalUnits = $this->PngcCode->FunctionalUnit->find('list');
		$inputCategories = $this->__getCategories();
		$measureTypes = $this->PngcCode->MeasureType->find('list');
		
		$inputCategories = $inicio + $inputCategories;
		$expenseGroups = $inicio + $expenseGroups;
		$functionalUnits = $inicio + $functionalUnits;
		$measureTypes = $inicio + $measureTypes;
		
		$this->set(compact('expenseGroups', 'functionalUnits', 'inputCategories', 'measureTypes'));
	}
	
	
/**
 * 
 * Enter description here ...
 */
	private function __getCategories() {
		
		$db = $this->Input->getDataSource();			
		$subQuery = $db->buildStatement(
		    array(
		        'fields'     => array('DISTINCT Input.input_category_id'),
		        'table'      => $db->fullTableName($this->Input),
		        'alias'      => 'Input',
		        'limit'      => null,
		        'offset'     => null,
		        'joins'      => array(),
		        'conditions' => array(
		    	),
		        'order'      => null,
		        'group'      => null
		    ),
		    $this->Input
		);
		$subQuery = ' InputCategory.id = (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$categories = $this->PngcCode->Input->InputCategory->find('list', compact('conditions'));

		return $categories;
		
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
		
		//---------------------
		$inicio = array(''=>'Selecione um item');
		$expenseGroups = $this->PngcCode->ExpenseGroup->find('list');
		$functionalUnits = $this->PngcCode->FunctionalUnit->find('list');
		$inputCategories = $this->__getCategories();
		$inputSubcategories = $this->__getSubcategories();
		$measureTypes = $this->PngcCode->MeasureType->find('list');
		
		$expenseGroups = $inicio + $expenseGroups;
		$functionalUnits = $inicio + $functionalUnits;
		$inputCategories = $inicio + $inputCategories;
		$measureTypes = $inicio + $measureTypes;
		
		$this->set(compact('expenseGroups', 'functionalUnits', 'inputCategories', 'inputSubcategories','measureTypes'));
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
 * Enter description here ...
 */
	private function __getSubcategories() {
		//id da unidade			
		$inputCategoryId = $this->request->data['Input']['input_category_id'];
		
		if($inputCategoryId == "") {
			exit;
		}

		$db = $this->Input->getDataSource();			
		$subQuery = $db->buildStatement(
		    array(
		        'fields'     => array(' * '),
		        'table'      => $db->fullTableName($this->Input),
		        'alias'      => 'Input',
		        'limit'      => null,
		        'offset'     => null,
		        'joins'      => array(),
		        'conditions' => array(
		    		'InputSubcategory.id = Input.input_subcategory_id',
		  			'Input.input_category_id'=>$inputCategoryId
		    	),
		        'order'      => null,
		        'group'      => null
		    ),
		    $this->Input
		);

		$subQuery = ' EXISTS (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);			
		$conditions[] = $subQueryExpression;
		$subcategories = $this->PngcCode->Input->InputSubcategory->find('list', compact('conditions'));
		
		if(empty($subcategories)) {
			$inicio = array(''=>'Não existem subcategorias ou foram todas cadastradas');	
		}else {
			$inicio = array(''=>'Selecione um item');
		}
		$subcategories = $inicio + $subcategories;

		return $subcategories;
	}		
}
