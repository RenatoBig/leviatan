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
 * view method
 *
 * @param integer $id
 * @return void
 */
	public function view($id = null) {
	
		$this->InputSubcategory->id = $id;
		if (!$this->InputSubcategory->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
	
		$this->InputSubcategory->recursive = -1;
		$inputSubcategory = $this->InputSubcategory->read(null, $id);
	
		$this->set(compact('inputSubcategory'));
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
			} else {
				$this->__getMessage(ERROR);
			}
			$this->redirect(array('controller'=>'inputs', 'action'=>'add'));
		}
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}else {
			$this->__getMessage(BAD_REQUEST);
			$this->redirect($this->referer());
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
	public function get_subcategories() {
		
		$this->autoRender = false;
		if($this->request->is('ajax')) {			
			//id da unidade			
			$inputCategoryId = $this->request->data['parent_id'];
			
			if($inputCategoryId == "") {
				$subcategories = array(''=>'Selecione uma categoria');
				echo json_encode($subcategories);

				return;
			}
			
			$q_query_subcategories = 'SELECT `InputSubcategory`.`id`, `InputSubcategory`.`name`
										FROM `input_subcategories` AS `InputSubcategory`
										WHERE NOT EXISTS (
											SELECT `Input`.`input_subcategory_id` 
												FROM `inputs` AS `Input`
												WHERE `InputSubcategory`.`id`=`Input`.`input_subcategory_id` AND `Input`.`input_category_id`='.$inputCategoryId.')
									 ORDER BY `InputSubcategory`.`name`';
			$data = $this->InputSubcategory->query($q_query_subcategories);

			if(empty($data)) {
				$subcategories = array(''=>'Não existem subcategorias ou foram todas cadastradas');
			}else {			
				foreach($data as $value):
					$subcategories[$value['InputSubcategory']['id']] = $value['InputSubcategory']['name']; 
				endforeach;
				
				$inicio = array(''=>'-- Nenhum --');
				$subcategories = $inicio + $subcategories;
			}			
			
			echo json_encode($subcategories);
		}		
	}
	
/**
 * 
 */
	public function get_subcategories_pngc() {
		$this->autoRender = false;
		if($this->request->is('AJAX')) {
			$inputCategoryId = $this->request->data['parent_id'];
			
			if($inputCategoryId == "") {
				$subcategories = array(''=>'Selecione uma categoria');
				echo json_encode($subcategories);
				return;
			}
			
			$q_input_subcategories = 'SELECT `InputSubcategory`.`id`, `InputSubcategory`.`name`
										FROM `input_subcategories` AS `InputSubcategory`
										WHERE `InputSubcategory`.`id` IN
											(SELECT `Input`.`input_subcategory_id`
											FROM `inputs` AS `Input`
											WHERE `Input`.`input_category_id`='.$inputCategoryId.') 
										ORDER BY `InputSubcategory`.`name` ASC';
			$subcategories = $this->InputSubcategory->query($q_input_subcategories);
				
			if(empty($subcategories)) {
				$subcategories = array(''=>'Não existem subcategorias ou foram todas cadastradas');
			}else {
				foreach($subcategories as $subcategory):
				$data[$subcategory['InputSubcategory']['id']] = $subcategory['InputSubcategory']['name'];
				endforeach;
				$inicio = array(''=>'-- Nenhum --');
				$data = $inicio + $data;
			
				$subcategories = $data;
			}
			
			echo json_encode($subcategories);			
		}
	}
	
/**
 *
 */
	public function get_children() {
		$values = $this->request->data['values'];
		parent::get_children('Input', 'InputCategory', 'InputSubcategory', $values);
	}
	
}
