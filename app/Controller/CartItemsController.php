<?php
App::uses('AppController', 'Controller');
/**
 * CartItems Controller
 *
 * @property CartItem $CartItem
 */
class CartItemsController extends AppController {
	
	var $layout = 'leviatan';
	var $uses = array('CartItem', 'Solicitation', 'SolicitationItem');
	
/**
 * 
 */
	public function index() {
		$user_id = $this->Auth->user('id');
		
		$options['limit'] = 4;
		$options['conditions'] = array(
			'CartItem.user_id'=>$user_id
		);
		$this->paginate = $options;
		
		$items = $this->paginate();

		$this->set(compact('items'));
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
			
			$this->redirect(array('controller'=>'solicitation_items', 'action'=>'index'));				
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
			
			$this->redirect(array('action' => 'index'));
		}
	}
	
/**
 * 
 * @param unknown_type $id
 */
	public function edit($id) {
		
		if ($this->request->is('post') || $this->request->is('put')) {

			$this->CartItem->id = $id;
			if (!$this->CartItem->exists()) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
				$this->redirect(array('action'=>'index'));
			}
			
			$quantity = $this->request->data['CartItem']['quantity'];
			
			if ($this->CartItem->saveField('quantity', $quantity)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('Quantidade alterada com sucesso').'</div>');
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A quantidade não pode ser alterada.').'</div>');
			}
			
			$this->redirect(array('action' => 'index'));				
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
			
			$keycode = $this->__getRandom();
			
			$this->Solicitation->create();
			$data['Solicitation']['keycode'] = $keycode;
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
					$this->redirect(array('controller'=>'cart_items', 'action'=>'index'));
				}				
				$this->Session->setFlash('<div class="alert alert-success">'.__('A solicitação foi concluída.').'</div>');
				$this->redirect(array('controller'=>'solicitations', 'action'=>'index'));
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A solicitação não pode ser concluída.').'</div>');
				$this->redirect(array('controller'=>'cart_items', 'action'=>'index'));
			}			
		}
	}
	
/**
 * 
 */
	private function __getRandom() {
		
		$i = 0;
		$random = '';
		while($i < 3) {
			$random .= rand(10, 99);
			$i++;
		}
		
		$random = $random.'/'.date('y');

		return $random;
	}

}
