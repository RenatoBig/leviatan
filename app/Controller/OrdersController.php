<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	public $uses = array('Order', 'OrderItem', 'Solicitation');
	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 0;
		
		$options['limit'] = 10;
		$options['order'] = array('Order.created'=>'desc');
		
		$this->paginate = $options;
		
		$orders = $this->paginate();
		
		$this->set(compact('orders'));
	}

/**
 * add method
 *
 * Gera um pedido e modifica o status dos registros da tabela solicitations,
 * que são pendentes para concluído 
 *
 * @return void
 */
	public function add() {
		if(!$this->request->is('post')) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			$this->redirect($this->referer());
		}
		
		//Verifica se existe alguma solicitação pendente
		if($this->__getCountPendingSolicitations() == 0) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Não existe solicitações pendentes.').'</div>');
			$this->redirect($this->referer());
		}
		//Verifica se tem algum item das solicitações com pendência
		$pending = $this->__getPendingSolicitationItems();
		if(!empty($pending)) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Possui algum item pendente nas solicitações. Por favor verfique e tente novamente.').'</div>');
			$this->redirect($this->referer());
		}

		$options['conditions'] = array('Solicitation.status_id'=>PENDENTE);
		$pendingSolicitations = $this->Solicitation->find('list', $options);
		
		$this->Order->create();
		$data['Order']['keycode'] = $this->__getRandomKeycode();
		
		foreach($pendingSolicitations as $key=>$solicitation):
			$this->OrderItem->create();
			$data['OrderItem'][$key]['solicitation_id'] = $solicitation;
		endforeach;
		
		if(!$this->Order->saveAll($data)) {		
			$this->Session->setFlash('<div class="alert alert-error">'.__('o pedido não pode ser concluído.').'</div>');
			$this->redirect($this->referer());
		}		
		
		$conditions = array(
				'Solicitation.status_id'=>PENDENTE
		);
		$fields = array(
				'Solicitation.status_id'=>CONCLUIDO
		);
		
		$status = $this->Solicitation->updateAll($fields, $conditions);
		
		if(!$status) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Não foi possível concluir o pedido.').'</div>');
		}
		
		$this->Session->setFlash('<div class="alert alert-success">'.__('Pedido concluído.').'</div>');
		$this->redirect(array('controller'=>'orders', 'action'=>'index'));
	}
	
/**
 *
 */
	private function __getPendingSolicitationItems() {
	
		$this->Solicitation->recursive = -1;
	
		$pending = array();
		$options['conditions'] = array('Solicitation.status_id'=>PENDENTE);
		$pendingSolicitations = $this->Solicitation->find('list', $options);
	
		foreach($pendingSolicitations as $value):
		$options['conditions'] = array(
				'SolicitationItem.solicitation_id'=>$value,
				'SolicitationItem.status_id'=>PENDENTE
		);
		$solicitationItem = $this->SolicitationItem->find('count', $options);
	
		if($solicitationItem != 0) {
			$pending[] = $value;
		}
		endforeach;
	
		return $pending;
	}
	
/**
 * 
 */
	private function __getCountPendingSolicitations() {
		
		$options['conditions'] = array('Solicitation.status_id'=>PENDENTE);
		
		$count = $this->Solicitation->find('count', $options);
		
		return $count;
	}
}
