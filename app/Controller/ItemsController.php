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
	var $layout = 'leviatan';
	var $uses = array('Item', 'CartItem', 'SolicitationItem');
	 
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->Item->recursive = 0;
		$conditions = array(
			'limit'=>'6',
			'order'=>array('Item.name'=>'asc')
		);
		$this->paginate = $conditions;
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}
	
	
/**
 * 
 * @param unknown_type $id
 */
	public function details($id) {
		$this->Item->id = $id;
		if (!$this->Item->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		$item = $this->Item->read(null, $id);
		$cart_items = $this->__getCartItems();
		$solicitation_items = $this->__getSolicitationItems();
		
		$this->set(compact('item', 'cart_items', 'solicitation_items'));		
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

			if ($this->Item->save($this->request->data)) {				
				$this->Session->setFlash('<div class="alert alert-success">'.__('O item foi cadastrado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser cadastrado. Por favor, tente novamente.').'</div>');
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
	private function __getInformationForm() {
		$inicio = array(''=>'Selecione um item');
		$itemClasses = $this->Item->ItemClass->find('list');
		$pngcCodes = $this->Item->PngcCode->find('list', array('fields'=>array('PngcCode.id', 'PngcCode.keycode')));
		
		$itemClasses = $inicio + $itemClasses;
		$pngcCodes = $inicio + $pngcCodes;
		$this->set(compact('itemClasses', 'pngcCodes'));
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
			$this->redirect(array('action'=>'index'));
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
				$this->Session->setFlash('<div class="alert alert-success">'.__('O item foi alterado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser alterado. Por favor, tente novamente.').'</div>');
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
		
		$this->__getInformationForm();
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
		$this->Item->id = $id;
		
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
		
		if (!$this->Item->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Item->delete()) {						
			$this->Session->setFlash('<div class="alert alert-success">'.__('Item deletado').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.').'</div>');
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
				echo true;
			}else {
				echo '<div class="alert alert-error">Não foi possível alterar o status. </div>';				
			}
			
			exit;
		
		}else {
			echo false;
			exit;
		}		
	}
	
}
