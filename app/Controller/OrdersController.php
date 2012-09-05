<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	public $layout = 'leviatan';
	public $helpers = array('Utils');
	public $uses = array('Order', 'OrderItem', 'Solicitation', 'SolicitationItem',
				'Item');	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Order->recursive = 0;

		$options['limit'] = 10;
		$options['order'] = array('Order.keycode'=>'asc');

		$this->paginate = $options;

		$orders = $this->paginate();

		$this->set(compact('orders'));
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
 * Salva os pedidos no banco de dados separados por categoria
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
		$pendingSolicitations = $this->Solicitation->find('all', $options);
		
		$this->SolicitationItem->recursive = 0;
		$itemsForClasses = array();
		foreach($pendingSolicitations as $value):
			
			$op['fields'] = array('DISTINCT Item.item_class_id');
			$op['conditions'] = array(
					'SolicitationItem.solicitation_id'=>$value['Solicitation']['id']
			);
			$item_classes = $this->SolicitationItem->find('all', $op);

			foreach($item_classes as $class):
				$ope['fields'] = array('SolicitationItem.*, Item.item_class_id');
				$ope['conditions'] = array(
					'Item.item_class_id'=>$class['Item']['item_class_id'],
					'SolicitationItem.solicitation_id'=>$value['Solicitation']['id']
				);
				$items = $this->SolicitationItem->find('all', $ope);
				
				foreach($items as $key=>$i):
					$itemsForClasses[$i['Item']['item_class_id']][] = $i['SolicitationItem']['id'];
				endforeach;
				
			endforeach;
			
		endforeach;
		
		foreach($itemsForClasses as $value):
			//---
			$count = $this->Order->find('count');
			$keycode = $count + 1;
			if($count < 10) {
				$keycode = '00'.$keycode;
			}else if($count >= 10 && $count < 100) {
				$keycode = '0'.$keycode;
			}		
			//---
			$this->Order->create();
			$data['Order']['keycode'] = $keycode.'/'.date('y');
			foreach($value as $v):
				$solicitation_item_ids[] = $v;
				$this->OrderItem->create();
				$data['OrderItem'][]['solicitation_item_id'] = $v;
			endforeach;

			if(!$this->Order->saveAll($data)) {
				$this->__getMessage(ERROR);
				$this->redirect();
			}
			$data = array();
		endforeach;
		
		$opSolicitations['fields'] = array('DISTINCT SolicitationItem.solicitation_id');
		$opSolicitations['conditions'] = array('SolicitationItem.id'=>$solicitation_item_ids);
		$solicitation_ids = $this->SolicitationItem->find('all', $opSolicitations);
		
		foreach($solicitation_ids as $j):
			$ids[] = $j['SolicitationItem']['solicitation_id'];
		endforeach;
		
		$conditions = array(
				'Solicitation.id'=>$ids
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
