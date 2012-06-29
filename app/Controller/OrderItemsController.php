<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 *
 * @property OrderItem $OrderItem
 */
class OrderItemsController extends AppController {


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
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->OrderItem->id = $id;
		if (!$this->OrderItem->exists()) {
			throw new NotFoundException(__('Item do pedido inválido'));
		}
		$this->set('orderItem', $this->OrderItem->read(null, $id));
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
		$items = $this->OrderItem->Item->find('list');
		$statuses = $this->OrderItem->Status->find('list');
		
		$orders = $inicio + $orders;
		$items = $inicio + $items;
		$statuses = $inicio + $statuses;

		$this->set(compact('orders', 'items', 'statuses'));
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
		$this->OrderItem->id = $id;
		if (!$this->OrderItem->exists()) {
			throw new NotFoundException(__('Item do pedido inválido.'));
		}
		if ($this->OrderItem->delete()) {
			$this->Session->setFlash(__('Item do pedido deletado.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item do pedido não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.'));
		$this->redirect(array('action' => 'index'));
	}
}
