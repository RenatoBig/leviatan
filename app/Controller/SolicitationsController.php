<?php
App::uses('AppController', 'Controller');
/**
 * Solicitations Controller
 *
 * @property Solicitation $Solicitation
 */
class SolicitationsController extends AppController {
	
	public $helpers = array('Utils', 'Js', 'Fck', 'Time');
	public $uses = array('Solicitation', 'SolicitationItem', 'User');
	public $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		if($this->request->is('post')){
			$status = $this->request->data['Solicitation']['status_id'];
			if(!empty($status)) {
				$this->request->params['named'] = array();
				$options['conditions'][] = array(
					'Solicitation.status_id'=>$status		
				);
			}
		}

		$user_id = $this->Auth->user('id');		
		$options['conditions'][] = array(
			'Solicitation.user_id'=>$user_id	
		);
		$options['limit'] = 5;
		$options['order'] = array('Solicitation.created'=>'desc');
		
		$this->paginate = $options;
		$solicitations = $this->paginate();

		$statuses = array(''=>'Todas as solicitações', PENDENTE=>'Pendentes', CONCLUIDO=>'Concluídos');
		
		$this->set(compact('solicitations', 'statuses'));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function view($id = null) {
		
		$this->Solicitation->recursive = -1;
		$solicitation = $this->Solicitation->read(null, $id);
		
		$options['conditions'] = array(
			'SolicitationItem.solicitation_id'=>$solicitation['Solicitation']['id']
		);
		$options['limit'] = '10';

		$this->paginate = $options;
		$items = $this->paginate('SolicitationItem');
		
		$this->set(compact('items'));
		
	}

/**
 * 
 */
	public function printout($id) {
		
		$this->layout = 'print';
		
		$options['conditions'] = array(
			'SolicitationItem.solicitation_id'=>$id	
		);
		
		$data = $this->SolicitationItem->find('all', $options);

		$this->set(compact('data'));
		
		$params = array(
				'download' => false,
				'name' => 'solicitacao_'.$id.'.pdf',
				'paperOrientation' => 'portrait',
				'paperSize' => 'A4'
		);
		$this->set($params);
	}
	
/**
 * 
 */
	public function all() {
		
		$this->Solicitation->recursive = -1;
		$options['conditions'] = array(
					'Solicitation.status_id'=>PENDENTE
				);
		$options['order'] = array('Solicitation.keycode');
		$options['limit'] = '10';
		
		$this->paginate = $options;
		
		$solicitations = $this->paginate();
		$pendingSolicitations = $this->__getPendingSolicitations();
		
		foreach($solicitations as $key=>$solicitation) {
			$solicitations[$key] = $this->__getAllDataSolicitation($solicitation);
		}

		$this->set(compact('solicitations', 'pendingSolicitations'));		
	}
	
/**
 *
 * @param unknown_type $solicitation
 */
	private function __getAllDataSolicitation($solicitation) {
		 
		$user = $this->__getTable('User', $solicitation['Solicitation']['user_id']);
		$group = $this->__getTable('Group', $user['User']['group_id']);
		$employee = $this->__getTable('Employee', $user['User']['employee_id']);
		$unity_sector = $this->__getTable('UnitySector', $employee['Employee']['unity_sector_id']);
		$sector = $this->__getTable('Sector', $unity_sector['UnitySector']['sector_id']);
		$unity = $this->__getTable('Unity', $unity_sector['UnitySector']['unity_id']);
		$unity_type = $this->__getTable('UnityType', $unity['Unity']['unity_type_id']);
		$region = $this->__getTable('Region', $unity['Unity']['region_id']);
		$health_district = $this->__getTable('HealthDistrict', $unity['Unity']['health_district_id']);
		$city = $this->__getTable('City', $region['Region']['city_id']);
		$area = $this->__getTable('Area', $region['Region']['area_id']);
	
		$solicitationFull = array_merge(
				$solicitation, $user, $group, $employee, $unity_sector, $sector,
				$unity, $unity_type, $region, $health_district, $city, $area
		);
		 
		return $solicitationFull;
	}
	
/**
 * 
 */
	private function __getPendingSolicitations() {
		
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
	
}