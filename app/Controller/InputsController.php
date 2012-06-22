<?php
App::uses('AppController', 'Controller');
/**
 * Inputs Controller
 *
 * @property Input $Input
 */
class InputsController extends AppController {

	var $uses = array('Input', 'InputSubcategory');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Input->recursive = 0;
		$this->set('inputs', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			throw new NotFoundException(__('Insumo inválido'));
		}
		$this->set('input', $this->Input->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Input->create();
			if ($this->Input->save($this->request->data)) {
				$this->Session->setFlash(__('O insumo foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O insumo não pode ser alterado. Por favor, tente novamente.'));
			}
		}
		
		$inicio = array(''=>'Selecione um item');		
		$inputCategories = $this->Input->InputCategory->find('list');
		//$inputSubcategories = $this->Input->InputSubcategory->find('list');
		//-------------
		$inputCategories = $inicio + $inputCategories;
		//$inputSubcategories = $inicio + $inputSubcategories;
		$this->set(compact('inputCategories'));
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
			throw new NotFoundException(__('Insumo inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Input->save($this->request->data)) {
				$this->Session->setFlash(__('O insumo foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O insumo não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Input->read(null, $id);
		}
		
		$inicio = array(''=>'Selecione um item');
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
			$inicio = array(''=>'Selecione um item');
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
			throw new MethodNotAllowedException();
		}
		$this->Input->id = $id;
		if (!$this->Input->exists()) {
			throw new NotFoundException(__('Insumo inválido'));
		}
		
		$input = $this->Input->read(null, $id);
		if(!empty($input['PngcCode'])) {
			$this->Session->setFlash('Você não pode deletar este registro, ele está cadastrado em outra tabela.');
			$this->redirect(array('action' => 'index'));
		}
				
		if ($this->Input->delete()) {
			$this->Session->setFlash(__('Insumo deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O insumo não pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}	

}
