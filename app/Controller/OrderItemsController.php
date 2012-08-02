<?php
App::uses('AppController', 'Controller');
/**
 * OrderItems Controller
 *
 * @property OrderItem $OrderItem
 */
class OrderItemsController extends AppController {
	
	public $layout = 'leviatan';

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
 *
 * 
 */
	public function view($order_id = null) {
		
		$options['conditions'] = array('Order.id'=>$order_id);
		$options['fields'] = array('Solicitation.*');
		$options['limit'] = '10';
		$options['order'] = array('Solicitation.created'=>'desc');
		
		$this->paginate = $options;
		
		$solicitations = $this->paginate();
		
		$solicitations = $this->__getEmployeesSolicitationss($solicitations);
		
		$this->set(compact('solicitations'));				
	}
	
/**
 * 
 * @param unknown_type $solicitations
 */
	private function __getEmployeesSolicitationss($solicitations) {
		
		foreach($solicitations as $key=>$solicitation) {
			$user = $this->__getTable('User', $solicitation['Solicitation']['user_id']);
			$employee = $this->__getTable('Employee', $user['User']['employee_id']);
			$unity_sector = $this->__getTable('UnitySector', $employee['Employee']['unity_sector_id']);
			$sector = $this->__getTable('Sector', $unity_sector['UnitySector']['sector_id']);
			$unity = $this->__getTable('Unity', $unity_sector['UnitySector']['unity_id']);
						
			$solicitationsFull[] = array_merge($solicitation, $user, $employee, $unity);
		}
		
		return $solicitationsFull;
	}
	
}

