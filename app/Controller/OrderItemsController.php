<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 *
 * @property OrderItem $OrderItem
 */
class OrderItemsController extends AppController {
	
	public $layout = 'leviatan';
	public $helpers = array('Utils');

/**
 *
 * 
 */
	public function printout($order_id = null) {
		
		//Quais as solicitações daquele pedido
		$op['conditions'] = array('OrderItem.order_id'=>$order_id);
		$op['fields'] = array('SolicitationItem.solicitation_id', 'SolicitationItem.id');
		$op['group'] = array('SolicitationItem.solicitation_id');		
		$solicitation_items = $this->OrderItem->find('all', $op);
		//----------------------
		//recupera o id dos itens da solicitação		
		$options['conditions'] = array('OrderItem.order_id'=>$order_id);
		$options['fields'] = array('SolicitationItem.id');		
		$id_solicitation_items = $this->OrderItem->find('all', $options);
		
		foreach($id_solicitation_items as $id):
			$v[] = $id['SolicitationItem']['id'];
		endforeach;
		$id_solicitation_items = $v;
		//-------------------------------
		//Organiza o array para montar o relatorio
		foreach($solicitation_items as $key=>$solicitation_item):
			$q_solicitations = 'SELECT * FROM `solicitations` AS `Solicitation`
									JOIN(`users` AS `User`) ON (`Solicitation`.`user_id`=`User`.`id`)
									JOIN(`employees` AS `Employee`) ON (`Employee`.`id`=`User`.`employee_id`)
									JOIN(`unity_sectors` AS `UnitySector`) ON (`UnitySector`.`id`=`Employee`.`unity_sector_id`)
									JOIN(`sectors` AS `Sector`) ON (`UnitySector`.`sector_id` = `Sector`.`id`)
									JOIN(`unities` AS `Unity`) ON (`UnitySector`.`unity_id`=`Unity`.`id`)
								WHERE(`Solicitation`.`id`='.$solicitation_item['SolicitationItem']['solicitation_id'].')';
			
			$solicitation = $this->Solicitation->query($q_solicitations);
			$solicitation = $solicitation[0];			
						
			$q_solicitation_item = 'SELECT * FROM `solicitation_items` AS `SolicitationItem`
										JOIN(`items` AS `Item`) ON (`SolicitationItem`.`item_id`=`Item`.`id`)
										WHERE(`SolicitationItem`.`id` IN (SELECT `OrderItem`.`solicitation_item_id` FROM `order_items` AS `OrderItem` WHERE `OrderItem`.`order_id`='.$order_id.') 
											AND `SolicitationItem`.`status_id`='.APROVADO.' 
											AND `SolicitationItem`.`solicitation_id`='.$solicitation_item['SolicitationItem']['solicitation_id'].')
										ORDER BY `Item`.`name` ASC'; 
			$items = $this->SolicitationItem->query($q_solicitation_item);
			if(!empty($items)) {
				$data[$key] = $solicitation;
				$data[$key]['solicitation_items'] = $items;
			}
			
		endforeach;		

		if(!isset($data)) {
			$this->Session->setFlash('Pedido não possui itens aprovados', 'default', array('class'=>'alert alert-error'));
			$this->redirect($this->referer());
		}
		
		$this->set(compact('data'));	
		//-------------------
		//organiza o array para montar o relatório consolidado dos pedidos
		$q_distinct_items = 'SELECT DISTINCT `SolicitationItem`.`item_id`, `Item`.* FROM `order_items` AS `OrderItem`
								JOIN(`solicitation_items` AS `SolicitationItem`) ON (`OrderItem`.`solicitation_item_id`=`SolicitationItem`.`id`)
								JOIN(`items` AS `Item`) ON (`SolicitationItem`.`item_id`=`Item`.`id`)
								WHERE `OrderItem`.`order_id`='.$order_id.'
								ORDER BY `Item`.`name` ASC
							';	
		$distinct_items = $this->OrderItem->query($q_distinct_items);
		$this->set(compact('distinct_items'));
		
		foreach($distinct_items as $d) {
			$q_items = 'SELECT * FROM `solicitation_items` AS `SolicitationItem`
			JOIN(`solicitations` AS `Solicitation`) ON (`SolicitationItem`.`solicitation_id`=`Solicitation`.`id`)
			JOIN(`users` AS `User`) ON (`Solicitation`.`user_id`=`User`.`id`)
			JOIN(`employees` AS `Employee`) ON (`User`.`employee_id`=`Employee`.`id`)
			JOIN(`unity_sectors` AS `UnitySector`) ON (`Employee`.`unity_sector_id`=`UnitySector`.`id`)
			JOIN(`unities` AS `Unity`) ON (`UnitySector`.`unity_id`=`Unity`.`id`)
			WHERE `SolicitationItem`.`id` IN(
				SELECT `OrderItem`.`solicitation_item_id` FROM `order_items` AS `OrderItem` WHERE `OrderItem`.`order_id`='.$order_id.'
				)
			AND	`SolicitationItem`.`item_id` = '.$d['Item']['id'];
				
			$solicitation_item = $this->SolicitationItem->query($q_items);
			$t[$d['Item']['id']] = $solicitation_item;
		}
		ksort($t);
		$this->set(compact('t'));
		//-------------------------------
		
		$this->layout = 'print';
		$params = array(
				'download' => false,
				'name' => 'pedido.pdf',
				'paperOrientation' => 'portrait',
				'paperSize' => 'A4'
		);
		$this->set($params);
			
	}
	
/**
 * 
 * @param unknown_type $solicitations
 */
	private function __getEmployeesSolicitations($solicitations) {
		
		$solicitation = $this->Solicitation->read(null, $solicitations[0]['SolicitationItem']['solicitation_id']);
	
		$user = $this->__getTable('User', $solicitation['Solicitation']['user_id']);
		$employee = $this->__getTable('Employee', $user['User']['employee_id']);
		$unity_sector = $this->__getTable('UnitySector', $employee['Employee']['unity_sector_id']);
		$sector = $this->__getTable('Sector', $unity_sector['UnitySector']['sector_id']);
		$unity = $this->__getTable('Unity', $unity_sector['UnitySector']['unity_id']);
						
		$solicitationsFull[] = array_merge($solicitation, $user, $employee, $unity);
		return $solicitationsFull;
	}
	
}

