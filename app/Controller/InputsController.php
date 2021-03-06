<?php
App::uses('AppController', 'Controller');
/**
 * Inputs Controller
 *
 * @property Input $Input
 */
class InputsController extends AppController {

	public $layout = 'leviatan';
	public $uses = array('Input', 'InputCategory','InputSubcategory');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Input->recursive = 0;
		
		$options['order'] = array('InputCategory.name'=>'asc', 'InputSubcategory.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('inputs', $this->paginate());
	}
	
/**
 * 
 */
	public function add() {
		
		if($this->request->is('post')) {

			$category = $this->request->data['Input']['input_category_id'];
			$subcategories = $this->request->data['Input']['input_subcategory_id'];
			
			foreach($subcategories as $value):
				$data[] = array('input_category_id'=>$category, 'input_subcategory_id'=>$value);
			endforeach;

			$this->Input->create();
			if($this->Input->saveMany($data)) {
				$this->__getMessage(SUCCESS);				
			}else {
				$this->__getMessage(ERROR);
			}
			$this->redirect(array('action'=>'index'));
		}
		
		$options['order'] = array('InputCategory.name'=>'asc');
		$inputCategories = array(''=>'-- Nenhum --') + $this->InputCategory->find('list', $options);

		$this->set(compact('inputCategories'));
	}
	
/**
 * 
 */
	private function __getDataSelect($model) {
		
		$inicio = array(''=>'-- Nenhum --');
		
		$options['fields'] = array(
				$model.'.id', $model.'.name'
		);
		$options['order'] = array($model.'.name'=>'asc');
		
		$this->$model->recursive = -1;
		$values = $this->$model->find('all', $options);
		foreach($values as $value):
			$data[$value[$model]['id']] = $value[$model]['name'];
		endforeach;
		
		$data = $inicio + $data;
		
		return $data;
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Input->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->Input->read(null, $id);
		}
		
		$inicio = array(''=>__('-- Nenhum --'));
		$inputCategories = $this->Input->InputCategory->find('list');
		//$inputSubcategories = $this->Input->InputSubcategory->find('list');
		//-------------
		$inputCategories = $inicio + $inputCategories;
		$inputSubcategories = array($this->request->data['InputSubcategory']['id']=>$this->request->data['InputSubcategory']['name']);
		
		$inputSubcategories = $inputSubcategories + $this->__getSubcategories();
				
		$this->set(compact('inputCategories', 'inputSubcategories'));
	}
	
/**
 * 
 * Função que retorna as subcategorias de insumos que ainda não estão 
 * cadastradas na tabela de insumos
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
		$subQuery = ' NOT EXISTS (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);
		
		$conditions[] = $subQueryExpression;
		$subcategories = $this->InputSubcategory->find('list', compact('conditions'));
		
		if(empty($subcategories)) {
			$inicio = array(''=>'Não existem subcategorias ou foram todas cadastradas');	
		}else {
			$inicio = array(''=>'-- Nenhum --');
		}
		$subcategories = $inicio + $subcategories;
		
		return $subcategories;
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
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
				
		if ($this->Input->delete()) {
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
		$model_integrator = 'Input';
		$model_parent = 'InputCategory';
		$model_child = 'InputSubcategory';
		$values = $this->request->data['values'];
		parent::checkEntries($model_integrator, $model_parent, $model_child, $values);
	}
	
}
