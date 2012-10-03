<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class ItemsController extends AppController {
	
	public $helpers = array('Fck');
	public $components = array('Upload');
	public $elements = array('pagination');
	public $layout = 'leviatan';
	public $uses = array('Item', 'PngcCode','ItemGroup', 'ItemClass', 'CartItem', 'SolicitationItem', 'InputCategory', 'InputSubcategory');
	
	
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
		
		$this->Item->recursive = 0;
		
		$options['order'] = array('ItemClass.keycode'=>'asc');
		$options['limit'] = 10;

		$this->paginate = $options;

		$this->set('items', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect($this->referer());
		}
		
		$item = $this->Item->read(null, $id);
		
		$this->set(compact('item'));
		
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
			$this->Item->create();
			if(!empty($this->request->data['Item']['image_path']['name'])) {
				$imagem = $this->__uploadImage($this->request->data['Item']['image_path']);
				if($imagem) {
					$this->request->data['Item']['image_path'] = $imagem;
				}else {
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao fazer upload da imagem.').'</div>');
					$this->__getInformationForm();
					return;
				}
			}else {
				$imagem = '';
				$this->request->data['Item']['image_path'] = '';
			}
			//gerando o código do item
			$options['conditions'] = array(
					'Item.item_class_id'=>$this->request->data['Item']['item_class_id']
			);			
			$qtde_item_classes = $this->Item->find('count', $options);
			
			$this->ItemClass->recursive = -1;
			$item_class = $this->ItemClass->read(null, $this->request->data['Item']['item_class_id']);
			$this->request->data['Item']['keycode'] = (string)($item_class['ItemClass']['keycode']).'-'.($qtde_item_classes+1);
			//---------
			if ($this->Item->save($this->request->data)) {	
				$this->__getMessage(SUCCESS);			
				$this->redirect(array('action' => 'index'));
			} else {				
				$this->__getMessage(ERROR);
				if($imagem != '') {
					$this->__removeImage($this->request->data['Item']['image_path']);
				}
			}
		}
		
		$this->__getInformationForm();		
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getInformationForm($id = null) {
		$inicio = array(''=>'-- Nenhum --');
		$this->ItemGroup->recursive = -1;
		$this->InputCategory->recursive = -1;
		$this->InputSubcategory->recursive = -1;
		
		$options['fields'] = array(
			'ItemGroup.id', 'ItemGroup.keycode', 'ItemGroup.name'	
		);		
		$itemGroups = $this->ItemGroup->find('all', $options);
		
		foreach($itemGroups as $ig):
			$values[$ig['ItemGroup']['id']]= $ig['ItemGroup']['keycode'].' - '.$ig['ItemGroup']['name'];
		endforeach;
		$itemGroups = $values;
		
		$op['order'] = array('PngcCode.keycode'=>'asc');
		$pngcCodes = $this->PngcCode->find('all', $op);
		
		foreach($pngcCodes as $key=>$pc):
			$input_category = $this->InputCategory->read(null, $pc['Input']['input_category_id']);
			if($pc['Input']['input_subcategory_id'] != null) {
				$input_subcategory = $this->InputSubcategory->read(null, $pc['Input']['input_subcategory_id']);
			}else {
				$input_subcategory['InputSubcategory'] = '';
			}
			
			if($input_subcategory['InputSubcategory'] != '') {
				$valuesPngc[$pc['PngcCode']['id']] = $pc['PngcCode']['keycode'].' - '.$pc['ExpenseGroup']['name'].' - '.$input_category['InputCategory']['name'].' - '.$input_subcategory['InputSubcategory']['name'];
			}else {
				$valuesPngc[$pc['PngcCode']['id']] = $pc['PngcCode']['keycode'].' - '.$pc['ExpenseGroup']['name'].' - '.$input_category['InputCategory']['name'];
			}
		endforeach;
		
		$pngcCodes = $valuesPngc;
		
		$itemGroups = $inicio + $itemGroups;
		$pngcCodes = $inicio + $pngcCodes;
		
		//Se id != null então é o formulário de edição. Carrega as classes do item
		if($id != null) {			
			$ope['conditions'] = array('ItemClass.item_group_id'=>$id);
			$ope['order'] = array('ItemClass.keycode'=>'asc');
			$this->ItemClass->recursive = -1;
			$itemClasses = $this->ItemClass->find('all', $ope);
				
			foreach($itemClasses as $value):
				$valuesEdit[$value['ItemClass']['id']] = $value['ItemClass']['keycode'].' - '.$value['ItemClass']['name'];
			endforeach;
				
			$itemClasses = $inicio + $valuesEdit;
		}else {
			$itemClasses = array(''=>'-- Selecione um grupo --');
		}
		
		$this->set(compact('itemClasses', 'itemGroups', 'pngcCodes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect($this->referer());
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$imagemAnterior = $this->request->data['Item']['prev_image'];

			if(empty($this->request->data['Item']['image_path']['name'])) {				
				$this->request->data['Item']['image_path'] = $imagemAnterior;
			}else {
				$imagem = $this->__uploadImage($this->data['Item']['image_path']);
				if($imagem) {
					$this->request->data['Item']['image_path'] = $imagem;					
					$this->__removeImage($imagemAnterior);					
				}else {
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao fazer upload da imagem.').'</div>');
					$this->__getInformationForm();
					$this->request->data['Item']['image_path'] = $imagemAnterior;					
					return;
				}
			}		
			
			if ($this->Item->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
			$this->__getInformationForm($this->request->data['ItemClass']['item_group_id']);
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
			$this->redirect(array('action'=>'index'));
		}
		//Recupera o item caso de algum probla ao excluir a imagem, salva o item novamente
		$item = $this->Item->read(null, $id);
		
		if($item['Item']['image_path'] != '') {
			//remove a imagem
			$remove = $this->__removeImage($item['Item']['image_path']);

			if(!$remove) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao remover a imagem.').'</div>');
				$this->redirect(array('action' => 'index'));	
			}	
		}		
		
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete()) {		
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
	private function __uploadImage($image) {
		
		$this->Upload->upload($image);
		$imgName = date('dmY_His');
		
		$this->Upload->file_new_name_body = $imgName;
		$this->Upload->image_resize = true;
		$this->Upload->image_x = 150;
		$this->Upload->image_x = 150;
		//$this->Upload->image_ratio_y = true;
		$this->Upload->jpeg_quality = 100;
		$this->file_max_size = '3000';
		
		$this->Upload->allowed = array('image/jpeg','image/jpg','image/gif','image/png');
		$this->Upload->process('img/items/');
		
		if($this->Upload->processed) {
			$this->Upload->clean();
		} else {
			debug($this->Upload->error);exit;
			//$this->erro = $this->Upload->error;
			return false;
		}
		
		return $imgName.'.'.$this->Upload->file_src_name_ext;		
	}
	
/**
 * 
 * Função que remove uma imagem do servidor
 * @param nome da imagem
 */
	private function __removeImage($image_path) {
		
		$image_path = IMAGES.'items'.DS.$image_path;

		return $this->__removeFile($image_path);
	}
	
/**
 * 
 * Função que remove um arquivo do servidor
 * @param caminho para o arquivo no servidor
 */
	private function __removeFile($path_file) {
		// Teste para saber se existe o arquivo e para evitar Warning devido os diretorios localizadores (ponto e ponto ponto)
		if (is_file($path_file) && (substr($path_file, -1) != '.' && substr($path_file, -2) != '..')) {
			return unlink($path_file);
		} else {
			return false;
		}
	}
	
/**
 * 
 * Enter description here ...
 */
	public function autoComplete() {
		$this->layout = 'ajax';
		
		$items = $this->Item->find('all', array(
				'conditions'=>array('Item.name LIKE' => $this->params['url']['q'].'%'),
				'fields'=>array('name', 'id')
			)
		);
		
		$this->set(compact('items'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function getItems() {
		$this->layout = 'ajax';
		if($this->request->is('ajax')) {
			debug($this->request);exit;
			if(isset($this->data['Item']['busca'])) {
				$conditions = array(
					'conditions'=>array('Item.name LIKE '=>'%'.$this->data['Item']['busca'].'%'),
					'limit'=>10,
					'order'=>array('Item.name'=>'asc')
				);
				$items = $this->Item->find('all', $conditions);
				$this->paginate = $conditions;
				debug($items);exit;
			}
			$this->set(compact('items'));
		}
	}
	
/**
 * 
 * Enter description here ...
 */
	public function changeStatus($id) {
		
		if($this->request->is('ajax')) {
			
			$this->Item->recursive = -1;
			$item = $this->Item->read(null, $id);
			$this->Item->id = $item['Item']['id'];
						
			if($item['Item']['status_id'] == ATIVO) {
				$status_id = INATIVO;
			}else if($item['Item']['status_id'] == INATIVO) {
				$status_id = ATIVO;
			}
			
			if($this->Item->saveField('status_id', $status_id, false)) {
				echo '1';
			}else {
				echo '0';				
			}			
			exit;
		
		}else {
			echo '-1';				
			exit;
		}		
	}
	
}
