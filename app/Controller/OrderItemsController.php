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
			throw new NotFoundException(__('Invalid order item'));
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
				$this->Session->setFlash(__('The order item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order item could not be saved. Please, try again.'));
			}
		}
		$orders = $this->OrderItem->Order->find('list');
		$items = $this->OrderItem->Item->find('list');
		$statuses = $this->OrderItem->Status->find('list');
		$this->set(compact('orders', 'items', 'statuses'));
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
			throw new NotFoundException(__('Invalid order item'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->OrderItem->save($this->request->data)) {
				$this->Session->setFlash(__('The order item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->OrderItem->read(null, $id);
		}
		$orders = $this->OrderItem->Order->find('list');
		$items = $this->OrderItem->Item->find('list');
		$statuses = $this->OrderItem->Status->find('list');
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
			throw new NotFoundException(__('Invalid order item'));
		}
		if ($this->OrderItem->delete()) {
			$this->Session->setFlash(__('Order item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
