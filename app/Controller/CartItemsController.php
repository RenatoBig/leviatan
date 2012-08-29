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
		
		$options['limit'] = 2;
		$options['conditions'] = array(
			'CartItem.user_id'=>$user_id
		);
		$this->paginate = $options;
		
		$items = $this->paginate();
		
		$this->set(compact('items'));
			
		if($this->request->is('ajax')) {
			$this->render('ajax', 'ajax');
		}	
	}
	
/**
 * 
 */
	public function add($id) {
		if($this->request->is('ajax')) {
			
			$user_id = $this->Auth->user('id');
			
			$this->CartItem->create();
			$data['CartItem']['user_id'] = $user_id;
			$data['CartItem']['item_id'] = $id;
			
			if($this->CartItem->save($data)) {
				echo 1;
			}else {
				echo -1;
			}
			
			$this->autoRender = false;
		}
	}
	
/**
 * 
 * @param unknown_type $id
 */
	public function delete($id) {		
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$this->CartItem->id = $id;
			if (!$this->CartItem->exists()) {
				echo '-1';
			}
			
			if($this->CartItem->delete()) {
				$user_id = $this->Auth->user('id');
				$op['conditions'] = array('CartItem.user_id'=>$user_id);
				$count = $this->CartItem->find('count', $op);

				if($count == 0) {
					echo '2';
				}else {		
					echo '1';
				}
			}else {
				echo '0';
			}			
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
				$this->__getMessage(INVALID_RECORD);
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
			$data['Solicitation']['memo_number'] = $this->request->data['memo_number'];
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
					$this->__getMessage(ERROR);
					echo '0';
					exit;
				}
				$this->__getMessage(SUCCESS);				
				echo true;
				exit;
			}else {
				$this->__getMessage(ERROR);
				echo '0';
				exit;
			}			
		}
	}

}
