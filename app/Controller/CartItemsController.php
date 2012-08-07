<?php
App::uses('AppController', 'Controller');
/**
 * CartItems Controller
 *
 * @property CartItem $CartItem
 */
class CartItemsController extends AppController {
	
	public $layout = 'leviatan';
	public $uses = array('CartItem', 'Solicitation', 'SolicitationItem');
	public $helpers = array('Fck', 'Js');
	
/**
 * 
 */
	public function index() {
		$user_id = $this->Auth->user('id');
		
		$options['limit'] = 6;
		$options['conditions'] = array(
			'CartItem.user_id'=>$user_id
		);
		$this->paginate = $options;
		
		$items = $this->paginate();

		$this->set(compact('items'));
			
		if($this->request->is('ajax')) {
			$this->layout = 'ajax_js';
			$this->render('ajax');
		}	
	}
	
/**
 * 
 */
	public function add($id) {
		if($this->request->is('post')) {
			
			$user = $this->Auth->user();
			$user_id = $user['id'];
			
			$this->CartItem->create();
			$data['CartItem']['user_id'] = $user_id;
			$data['CartItem']['item_id'] = $id;
			
			if($this->CartItem->save($data)) {
				$this->Session->setFlash('<div class="alert alert-success">'."Produto adicionado com sucesso".'</div>');
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'."Não foi possível adicionar o item ao carrinho".'</div>');				
			}
			
			$this->redirect($this->referer());				
		}
	}
	
/**
 * 
 * @param unknown_type $id
 */
	public function delete($id) {
		if($this->request->is('post')) {
			$this->CartItem->id = $id;
			if (!$this->CartItem->exists()) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
				$this->redirect(array('action'=>'index'));
			}
			
			if ($this->CartItem->delete()) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O item foi removido').'</div>');
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser deletado').'</div>');
			}
			
			$this->redirect($this->referer());
		}
	}
	
/**
 * 
 * @param unknown_type $id
 */
	public function edit($id) {
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			
			$this->CartItem->id = $id;
			if (!$this->CartItem->exists()) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
				$this->redirect(array('action'=>'index'));
			}
			
			$quantity = $this->request->data['CartItem']['quantity'];
			
			if ($this->CartItem->saveField('quantity', $quantity)) {
				echo '<div class="alert alert-success">'.__('Quantidade alterada com sucesso').'</div>'; 
			} else {
				echo '<div class="alert alert-error">'.__('A quantidade não pode ser alterada.').'</div>';
			}
		}
	}
	
/**
 * 
 */
	public function checkout() {
		if($this->request->is('post')) {
			
			$user_id = $this->Auth->user('id');
			
			$this->CartItem->recursive = -1;
			$options['conditions'] = array(
				'CartItem.user_id'=>$user_id					
			);
			
			$items = $this->CartItem->find('all', $options);
			
			$keycode = $this->__getRandomKeycode();
			
			$this->Solicitation->create();
			$data['Solicitation']['keycode'] = $keycode;
			$data['Solicitation']['description'] = $this->request->data['description'];
			$data['Solicitation']['user_id'] = $user_id;
			$data['Solicitation']['status_id'] = PENDENTE;
			
			foreach($items as $key=>$item):
				$this->SolicitationItem->create();
				$data['SolicitationItem'][$key]['item_id'] = $item['CartItem']['item_id'];
				$data['SolicitationItem'][$key]['quantity'] = $item['CartItem']['quantity'];
				$data['SolicitationItem'][$key]['status_id'] = PENDENTE;
			endforeach;

			if($this->Solicitation->saveAll($data)) {				
				if(!$this->CartItem->deleteAll(array('CartItem.user_id'=>$user_id), false)) {
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao remover os itens do carrinho.').'</div>');
					echo '0';
					exit;
				}				
				$this->Session->setFlash('<div class="alert alert-success">'.__('A solicitação foi concluída.').'</div>');
				echo true;
				exit;
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A solicitação não pode ser concluída.').'</div>');
				echo '0';
				exit;
			}			
		}
	}

}
