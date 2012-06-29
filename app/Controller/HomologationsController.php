<?php
App::uses('AppController', 'Controller');
/**
 * Homologations Controller
 *
 * @property Homologation $Homologation
 */
class HomologationsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Homologation->recursive = 0;
		$this->set('homologations', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Homologação inválida'));
		}
		
		$homologation = $this->Homologation->read(null, $id);
		$orderItem = $this->Homologation->OrderItem->read(null, $homologation['Homologation']['order_item_id']);

		$this->set(compact('homologation', 'orderItem'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Homologation->create();
			if ($this->Homologation->save($this->request->data)) {
				$this->Session->setFlash(__('A homologação foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A homologação não pode ser cadastrada. Por favor, tente novamente.'));
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
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Homologação inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Homologation->save($this->request->data)) {
				$this->Session->setFlash(__('The homologation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A homologação não pode ser alterada. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Homologation->read(null, $id);
		}
		
		$this->__getInformationForms();
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getInformationForms() {
		$orderItems = $this->Homologation->OrderItem->find('all');
		$orders = array();
		foreach($orderItems as $orderItem):
			$orders[$orderItem['OrderItem']['id']] = $orderItem['Order']['keycode'].' - '.$orderItem['Item']['name'];
		endforeach;
		$inicio = array(''=>'Selecione um item');
		$orderItems = $inicio + $orders;
		$this->set(compact('orderItems'));
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
		$this->Homologation->id = $id;
		if (!$this->Homologation->exists()) {
			throw new NotFoundException(__('Homologação inválida'));
		}
		if ($this->Homologation->delete()) {
			$this->Session->setFlash(__('A homologação foi deletada'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A homologação não pode ser deletada.'));
		$this->redirect(array('action' => 'index'));
	}
}
