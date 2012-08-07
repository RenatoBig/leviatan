<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {

	public $uses = array('Order', 'OrderItem', 'Solicitation', 'SolicitationItem',
				'Item');	
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
 * 
 */
	public function view($id) {
		
		if(!$this->request->is('POST')) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			$this->redirect($this->referer());	
		}
		
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Pedido inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		//---------------------------------------
		$optionsOrderItems['conditions'] = array(
			'OrderItem.order_id'=>$id
		);
		$optionsOrderItems['fields'] = array(
			'OrderItem.solicitation_id'		
		);
		$id_solicitations = $this->OrderItem->find('list', $optionsOrderItems);
		//-----------------------------------
		$this->Solicitation->recursive = -1;
		$optionsUsers['conditions'] = array(
			'Solicitation.id'=>$id_solicitations
		);
		$optionsUsers['fields'] = array(			
			'DISTINCT Solicitation.user_id',
		);
		$users = $this->Solicitation->find('all', $optionsUsers);
		//--------------------------------------------------
		$this->SolicitationItem->recursive = 0;
		foreach($users as $key=>$user):			
			//Dados do usuário
			//---------------------------
			$q_users = 'SELECT * FROM `users` AS `User`
						JOIN(`employees` AS `Employee`) ON (`Employee`.`id`=`User`.`employee_id`)
						JOIN(`unity_sectors` AS `UnitySector`) ON (`UnitySector`.`id`=`Employee`.`unity_sector_id`)
						JOIN(`unities` AS `Unity`) ON (`UnitySector`.`unity_id`=`Unity`.`id`)
						WHERE `User`.`id`='.$user['Solicitation']['user_id'];
			$employee = $this->User->query($q_users);
			$data[$key] = $employee[0];
			
			//---------------------------------------------			
			$op['conditions'] = array(
					'Solicitation.id'=>$id_solicitations, 
					'Solicitation.user_id'=>$user['Solicitation']['user_id']
			);
			$solicitations = $this->Solicitation->find('all', $op);
			//-----------------------------------------------------
			foreach($solicitations AS $solicitation):
				$options['conditions'] = array(
					'SolicitationItem.solicitation_id'=>$solicitation['Solicitation']['id'],
					'Solicitation.user_id'=>$user['Solicitation']['user_id'],
					'SolicitationItem.status_id'=>APROVADO
				);
				$solicitation_items = $this->SolicitationItem->find('all', $options);
				if(!empty($solicitation_items)):					
					$data[$key]['solicitations'][] = $solicitation;
					$data[$key]['solicitation_items'][] = $solicitation_items;
				endif;				
			endforeach;
		endforeach;
		$this->set(compact('data'));
		
		if(isset($data[0]['solicitations'])){		
			$params = array(
					'download' => false,
					'name' => 'pedido.pdf',
					'paperOrientation' => 'portrait',
					'paperSize' => 'legal'
			);
			$this->set($params);
		}else {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Este pedidio não possui itens aprovados.').'</div>');
			$this->redirect(array('action'=>'index'));
		}		
	}
	
/**
 * 
 * @param unknown_type $solicitation_id
 */
	private function __getSolicitationItemsForSolicitation($solicitation_id) {
		
		$this->SolicitationItem->recursive = -1;
		$options['conditions'] = array(
					'SolicitationItem.solicitation_id'=>$solicitation_id
				);
		$solicitation_items = $this->SolicitationItem->find('all', $options);
		
		return $solicitation_items;
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
