<?php
App::uses('AppController', 'Controller');

/**
 * InputSubcategories Controller
 *
 * @property InputSubcategory $InputSubcategory
 */
class InputSubcategoriesController extends AppController {
	
	public $uses = array('InputSubcategory', 'Input');
	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->InputSubcategory->recursive = -1;
		
		$options['order'] = array('InputSubcategory.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('inputSubcategories', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InputSubcategory->create();
			if ($this->InputSubcategory->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->InputSubcategory->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->InputSubcategory->read(null, $id);
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
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->InputSubcategory->delete()) {
			$this->__getMessage(SUCCESS);
		}else{
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Função que retorna as subcategorias de insumos que ainda não estão 
 * cadastradas na tabela de insumos
 */
	public function getSubcategories() {
		if($this->request->is('ajax')) {
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
				$inicio = array(''=>'Selecione um item');
			}
			$subcategories = $inicio + $subcategories;
			
			$this->set(compact('subcategories'));
			$this->layout = 'ajax';
		}		
	}
	
/**
 * 
 * Enter description here ...
 */
	public function getSubcategoriesPngcCode() {
		if($this->request->is('ajax')) {
			//id da unidade			
			$inputCategoryId = $this->request->data['PngcCode']['input_category_id'];
			
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
			$subcategories = $this->InputSubcategory->find('list', compact('conditions'));
			
			if(empty($subcategories)) {
				$inicio = array(''=>'Não existem subcategorias ou foram todas cadastradas');	
			}else {
				$inicio = array(''=>'Selecione um item');
			}
			$subcategories = $inicio + $subcategories;

			$this->set(compact('subcategories'));
			$this->render('getSubcategories', 'ajax');
		}		
	}
	
}
