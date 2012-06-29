<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	var $uses = array('Order', 'User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 2;
		$this->set('orders', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		$order = $this->Order->read(null, $id);
		$user = $this->User->read(null, $order['Order']['user_id']);
		
		$this->set(compact('order', 'user'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('O order foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O pedido não pode ser cadastrado. Por favor, tente novamente.'));
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
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('O pedido foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O pedido não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Order->read(null, $id);
			$this->__formmattDate();			
		}
		
		$this->__getInformationForms();
	}
	
/**
 * 
 * Formata a data de acordo com o padrão dd/mm/YYYY
 */
	private function __formmattDate() {
		
		$dataInicial = explode("-", $this->request->data['Order']['start_date']);
		$dataFinal = explode("-", $this->request->data['Order']['end_date']);
		
		$this->request->data['Order']['start_date'] = $dataInicial[2].'/'.$dataInicial[1].'/'.$dataInicial[0];
		$this->request->data['Order']['end_date'] = $dataFinal[2].'/'.$dataFinal[1].'/'.$dataFinal[0];
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getInformationForms() {
		$inicio = array(''=>'Selecione um item');
		$users = $this->Order->User->find('all', array('fields'=>array('User.id', 'Employee.name')));
		$statuses = $this->Order->Status->find('list');
		
		//Organiza array para enviar para view
		$newUsers = array();
		foreach($users as $user):
			$newUsers[$user['User']['id']] = $user['Employee']['name'];
		endforeach;
		$users = $newUsers;
		
		$users = $inicio + $users;
		$statuses = $inicio + $statuses;
		$this->set(compact('users', 'statuses'));
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
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Pedido inválido'));
		}
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('Pedido deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O pedido não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.'));
		$this->redirect(array('action' => 'index'));
	}
}
