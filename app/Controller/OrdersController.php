<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	public $helpers = array('Utils');
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect($this->referer());	
		}
		
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			$this->__getMessage(INVALID_RECORD);
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

		foreach($users as $key=>$user):			
			//Dados do usuário
			//---------------------------
			$q_users = 'SELECT * FROM `users` AS `User`
						JOIN(`employees` AS `Employee`) ON (`Employee`.`id`=`User`.`employee_id`)
						JOIN(`unity_sectors` AS `UnitySector`) ON (`UnitySector`.`id`=`Employee`.`unity_sector_id`)
						JOIN(`sectors` AS `Sector`) ON (`UnitySector`.`sector_id` = `Sector`.`id`)
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
				
				$q_solicitation_items = 'SELECT * FROM `solicitation_items` as `SolicitationItem`
											JOIN(`solicitations` as `Solicitation`) ON (`SolicitationItem`.`solicitation_id` = `Solicitation`.`id`)
											JOIN(`items` as `Item`) ON (`SolicitationItem`.`item_id`=`Item`.`id`)
											JOIN(`item_classes` as `ItemClass`) ON (`Item`.`item_class_id`=`ItemClass`.`id`) 
											WHERE(`SolicitationItem`.`solicitation_id` = '.$solicitation['Solicitation']['id']. 
												' AND `Solicitation`.`user_id` = '.$user['Solicitation']['user_id'].
												' AND `SolicitationItem`.`status_id` = '.APROVADO.') ORDER BY `SolicitationItem`.`item_id` ASC';
				$solicitation_items = $this->SolicitationItem->query($q_solicitation_items);

				if(!empty($solicitation_items)):					
					$data[$key]['solicitations'][] = $solicitation;
					$data[$key]['solicitation_items'][] = $solicitation_items;
				endif;				
			endforeach;
		endforeach;
		$this->set(compact('data'));
		
		$ope['conditions'] = array(
			'SolicitationItem.solicitation_id' => $id_solicitations	
		);
		$ope['fields'] = array('DISTINCT SolicitationItem.item_id', 'Item.*');
		$ope['order'] = array('Item.id'=>'asc');
		
		$distinct_items = $this->SolicitationItem->find('all', $ope);
		$this->set(compact('distinct_items'));
		
		foreach($distinct_items as $d) {			
			$q_items = 'SELECT * FROM `solicitation_items` AS `SolicitationItem`
							JOIN(`solicitations` AS `Solicitation`) ON (`SolicitationItem`.`solicitation_id`=`Solicitation`.`id`)
							JOIN(`users` AS `User`) ON (`Solicitation`.`user_id`=`User`.`id`)
							JOIN(`employees` AS `Employee`) ON (`User`.`employee_id`=`Employee`.`id`)
							JOIN(`unity_sectors` AS `UnitySector`) ON (`Employee`.`unity_sector_id`=`UnitySector`.`id`)
							JOIN(`unities` AS `Unity`) ON (`UnitySector`.`unity_id`=`Unity`.`id`) 
							WHERE `SolicitationItem`.`solicitation_id` IN(
								SELECT `OrderItem`.`solicitation_id` FROM `order_items` AS `OrderItem` WHERE `OrderItem`.`order_id`='.$id.'
							) 
							AND	`SolicitationItem`.`item_id` = '.$d['Item']['id'];
			
			$solicitation_item = $this->SolicitationItem->query($q_items);
			$t[$d['Item']['id']] = $solicitation_item;
		}
		ksort($t);
		$this->set(compact('t'));	
			
		$this->layout = 'print';
		if(isset($data[0]['solicitations'])){		
			$params = array(
					'download' => false,
					'name' => 'pedido.pdf',
					'paperOrientation' => 'portrait',
					'paperSize' => 'A4'
			);
			$this->set($params);
		}else {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Este pedido não possui itens aprovados.').'</div>');
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
			$this->__getMessage(BAD_REQUEST);
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
			$this->__getMessage(ERROR);
			$this->redirect($this->referer());
		}
		
		$this->__getMessage(SUCCESS);
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
