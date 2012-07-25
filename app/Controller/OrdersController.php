<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	var $uses = array('Order', 'OrderItem', 'SolicitationItem');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 0;
		$this->set('orders', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->set('order', $this->Order->read(null, $id));
	}

/**
 * add method
 *
 * Gera um pedido e modifica o status da dos registros da tavela solicitation_items,
 * que são pendentes ou homologados, para concluído 
 *
 * @return void
 */
	public function add() {
		if(!$this->request->is('post')) {
			echo 'Requisição inválida';
			$this->redirect($this->referer());
		}
		
		$options['conditions'] = array('SolicitationItem.status_id'=>APROVADO);
		$approvedSolicitations = $this->SolicitationItem->find('list', $options);
		
		$this->Order->create();
		$data['Order']['keycode'] = $this->__getRandomKeycode();
		
		foreach($approvedSolicitations as $key=>$item):
			$this->OrderItem->create();
			$data['OrderItem'][$key]['solicitation_item_id'] = $item;
		endforeach;
		
		if(!$this->Order->saveAll($data)) {		
			$this->Session->setFlash('<div class="alert alert-error">'.__('o pedido não pode ser concluído.').'</div>');
			$this->redirect($this->referer());
		}		
		
		foreach($approvedSolicitations as $key=>$value):
			$this->SolicitationItem->id = $value;
			if(!$this->SolicitationItem->saveField('status_id', CONCLUIDO)) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('o pedido não pode ser concluído.').'</div>');
				$this->redirect($this->referer());
			}
		endforeach;
		
		$this->Session->setFlash('<div class="alert alert-success">'.__('Pedido concluído.').'</div>');
		$this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Order->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Order deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Order was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
