<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 *
 * @property OrderItem $OrderItem
 */
class OrderItemsController extends AppController {
	
	var $layout = "leviatan";


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OrderItem->recursive = 0;
		$this->set('orderItems', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id id do pedido
 * @return void
 */
	public function view($id = null) {
		$this->OrderItem->Order->id = $id;
		if (!$this->OrderItem->Order->exists()) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		
		$orderItems = $this->OrderItem->find('all', array('conditions'=>array('OrderItem.order_id'=>$id)));
		
		$this->set(compact('orderItems'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OrderItem->create();
			if ($this->OrderItem->save($this->request->data)) {
				$this->Session->setFlash(__('O item do pedido foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O item do pedido não pode ser cadastrado. Por favor, tente novamente.'));
			}
		}
		$this->__getInformationForms();
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->OrderItem->id = $id;
		if (!$this->OrderItem->exists()) {
			throw new NotFoundException(__('Item do pedido inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrderItem->save($this->request->data)) {
				$this->Session->setFlash(__('O item do pedido foi alterado.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('o item do pedido não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->OrderItem->read(null, $id);
		}
		
		$this->__getInformationForms();
	}
	
	private function __getInformationForms() {
		$inicio = array(''=>'Selecione um item');
		$orders = $this->OrderItem->Order->find('list', array('fields'=>array('Order.id', 'Order.keycode')));
		$items = $this->OrderItem->Item->find('all');
		$statuses = $this->OrderItem->Status->find('list');
		
		$orders = $inicio + $orders;
		//$items = $inicio + $items;
		$statuses = $inicio + $statuses;
		
		$this->set(compact('orders', 'items', 'statuses'));
	}

/**
 * delete method
 *
 * @param string $id id do pedido
 * @return void
 */
	public function delete($id = null) {
		if(!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->OrderItem->Order->id = $id;
		if (!$this->OrderItem->Order->exists()) {
			throw new NotFoundException(__('Item do pedido inválido.'));
		}
		
		$orderItems = $this->OrderItem->find('all', array('conditions'=>array('OrderItem.order_id'=>$id)));
		
		$deleteOk = true;
		$idsOrderItems = array();
		foreach($orderItems as $orderItem) {
			$idsOrderItems[] = $orderItem['OrderItem']['id']; 
			if(!empty($orderItem['Homologation'])) {
				$deleteOk = false;
				break;
			}
		}

		if($deleteOk) {
			foreach($idsOrderItems as $idOrdemItem):
				if(!$this->OrderItem->delete($idOrdemItem)) {
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao tentar deletar o pedido').'</div>');
				}
			endforeach;			
		}else {
			$this->Session->setFlash('<div class="alert alert-success">'.__('O pedido não pode ser deletado. Ainda existem pedidos para serem homologados.').'</div>');
			$this->redirect(array('controller'=>'order', 'action'=>'index'));
		}
				
		if(!$this->OrderItem->Order->delete($orderItems[0]['Order']['id'])) {
			$this->OrderItem->saveAssociated($orderItems);
			$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao tentar deletar o pedido').'</div>');
		}

		$this->Session->setFlash('<div class="alert alert-success">'.__('Pedido deletado').'</div>');
		$this->redirect(array('controller'=>'orders', 'action'=>'index'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function products($id = null) {		

		if($this->request->is('post')) {			
			$this->OrderItem->Item->recursive = -1;
			$items = $this->Session->read('items');
			if($items == null) {
				$items = array();
			}
						
			$item = $this->OrderItem->Item->find('first', array('conditions'=>array('Item.id'=>$id)));
			$items = am($items, array($item));
			
			$this->Session->write('items', $items);
			$this->Session->setFlash('<div class="alert alert-success">'.__("Item adicionado ao carrinho").'</div>');			
		}
		
		$items = $this->OrderItem->Item->find('all');		
		$this->set(compact('items'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function cart($id = null) {
		
		if($this->request->is('post')) {
			$idDelete = -1;
			$itemsSession = $this->Session->read('items');
			foreach($itemsSession as $key=>$item):
				if($item['Item']['id'] == $id) {
					$idDelete = $key;
					break;
				}
			endforeach;
			
			unset($itemsSession[$idDelete]);
			
			$items = $itemsSession;
			$this->Session->write('items', $items);
			$this->Session->setFlash('<div class="alert alert-success">'.__('Item removido com sucesso').'</div>');			
		}		
		
		$items = $this->Session->read('items');		
		$this->set(compact('items'));		
	}
	
/**
 * 
 * Enter description here ...
 */
	public function checkout() {
		if($this->request->is('post')) {
			
			$flag = true;
			$user = $this->Session->read('Auth');
			$date = date('d/m/Y');
			$keycode = rand(0, time());

			$this->OrderItem->Order->create();
			
			$order['Order']['keycode'] = $keycode;
			$order['Order']['user_id'] = $user['User']['id'];
			$order['Order']['start_date'] = $date;
			$order['Order']['end_date'] = null;
			$order['Order']['status_id'] = '1';
			
			if(!$this->OrderItem->Order->save($order)) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao salvar o pedido').'</div>');
				$this->redirect(array('action'=>'cart'));
			}			
			$idOrder = $this->OrderItem->Order->id;
			
			
			
			$orderItem['OrderItem']['order_id'] = $idOrder;
			$orderItem['OrderItem']['status_id'] = '1';			
			
			foreach($this->request->data['OrderItem'] as $key=>$row):
				$this->OrderItem->create();
				$orderItem['OrderItem']['item_id'] = $row['itemId'];
				$orderItem['OrderItem']['quantity'] = $row['quantity'];	
				if(!$this->OrderItem->save($orderItem)) {
					$this->OrderItem->Order->delete();
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao salvar o pedido').'</div>');
					$this->redirect(array('action'=>'cart'));
				}	
			endforeach;
			
			$this->Session->write('items', null);
			$this->Session->setFlash('<div class="alert alert-success">'.__('Pedido adicionado com sucesso').'</div>');
			$this->redirect(array('controller'=>'orders', 'action'=>'index'));
		} 
	}
	
}
