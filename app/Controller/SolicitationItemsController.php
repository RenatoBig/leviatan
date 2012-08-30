<?php
App::uses('AppController', 'Controller');
/**
 * SolicitationItems Controller
 *
 * @property SolicitationItem $SolicitationItem
 */
class SolicitationItemsController extends AppController {

	public $layout = "leviatan";
	public $helpers = array('Utils', 'Fck');
	public $uses = array('SolicitationItem', 'Solicitation', 'Item', 'ItemGroup', 'ItemClass', 'User', 'UnitySector', 'Region', 'UnityType', 'HealthDistrict', 'CartItem', 'PngcCode');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		if($this->request->is('ajax') && $this->request->data) {
			$item_group_id = $this->request->data['item_group_id'];
			$item_class_id = $this->request->data['item_class_id'];
			$pngc_code_id = $this->request->data['pngc_code_id']; 
			
			$options = array();
			if($item_group_id != '') {
				$options['conditions'][] = array('ItemClass.item_group_id'=>$item_group_id);
			}
			if($item_class_id != '') {
				$options['conditions'][] = array('Item.item_class_id'=>$item_class_id);
			}
			if($pngc_code_id != '') {
				$options['conditions'][] = array('Item.pngc_code_id'=>$pngc_code_id);
			}	
			$this->Session->write('options', $options);
		}

		if($this->request->is('ajax') && $this->Session->read('options')) {
			$options = $this->Session->read('options');
		}else {
			$this->Session->delete('options');
		}
		
		$options['conditions'][] = array(
				'Item.status_id'=>ATIVO,
		);
		$options['order'] = array('ItemClass.keycode'=>'asc');
		$options['limit'] = '3';
		
		$this->paginate = $options;
		
		$items = $this->paginate('Item');
		$cart_items = $this->__getCartItems();
		$solicitation_items = $this->__getSolicitationItems();
		
		$this->__getDataFilter();
		
		$this->set(compact('items', 'cart_items', 'solicitation_items'));
		if($this->request->is('ajax')) {
			$this->render('ajax', 'ajax');
		}
	}
	
/**
 * 
 */
	private function __getDataFilter() {
		
		$inicio = array(''=>'-- Nenhum --');
		
		$q_groups = 'SELECT * FROM `item_groups` AS `ItemGroup`
						WHERE `ItemGroup`.`id` IN
							(SELECT `ItemClass`.`item_group_id` 
								FROM `item_classes` AS `ItemClass`
								WHERE `ItemClass`.`id` IN
									(SELECT DISTINCT `Item`.`item_class_id` FROM `items` AS `Item`)
							) 
					';
		$groups = $this->ItemGroup->query($q_groups);
		
		foreach($groups as $group):
			$values[$group['ItemGroup']['id']] = $group['ItemGroup']['keycode'].' - '.$group['ItemGroup']['name']; 
		endforeach;
		$groups = $inicio + $values;
		
		
		$q_pngc = 'SELECT * FROM `pngc_codes` AS `PngcCode`
						JOIN(`expense_groups` AS `ExpenseGroup`) ON (`PngcCode`.`expense_group_id`=`ExpenseGroup`.`id`)
						JOIN(`inputs` AS `Input`) ON (`Input`.`id`=`PngcCode`.`input_id`)
						JOIN(`input_categories` AS `InputCategory`) ON (`Input`.`input_category_id`=`InputCategory`.`id`)
						WHERE `PngcCode`.`id` IN
							(SELECT DISTINCT `Item`.`pngc_code_id` FROM `items` AS `Item`)	
				  ';
		$pngcs = $this->PngcCode->query($q_pngc);
		
		foreach($pngcs as $key=>$pngc):
			if($pngc['Input']['input_subcategory_id'] != NULL) {
				$inputSubcategory = $this->InputSubcategory->read(null, $pngc['Input']['input_subcategory_id']);		
			}
			if(isset($inputSubcategory)) {
				$vPngcs[$pngc['PngcCode']['id']] = $pngc['PngcCode']['keycode'].' - '.$pngc['ExpenseGroup']['name'].' - '.$pngc['InputCategory']['name'].$inputSubcategory['InputSubcategory']['name'];
			}else {
				$vPngcs[$pngc['PngcCode']['id']] = $pngc['PngcCode']['keycode'].' - '.$pngc['ExpenseGroup']['name'].' - '.$pngc['InputCategory']['name'];
			}
		endforeach;
		$pngcs = $inicio + $vPngcs;
		
		$classes = array(''=>'-- Selecione um grupo --');
								
		$this->set(compact('groups', 'pngcs', 'classes'));
		
	}
	
/**
 * 
 */
	public function get_classes() {
		if($this->request->is('ajax')) {
			
			$inicio = array(''=>'-- Nenhum --');
			
			$this->Item->recursive = 0;
			$options['fields'] = array('ItemClass.*');
			$options['order'] = array('ItemClass.keycode');
			$options['conditions'] = array(
				'ItemClass.item_group_id'=>$this->request->data['SolicitationItem']['item_group_id'],
			);
			var_dump($this->request->data['SolicitationItem']['item_group_id']);
			$items = $this->Item->find('all', $options);
			
			if(empty($items)) {
				$values = array(''=>'-- Selecione um grupo --');
			}else {
				foreach($items as $item):
					$values[$item['ItemClass']['id']] = $item['ItemClass']['keycode'].' - '.$item['ItemClass']['name'];
				endforeach;
				$values = $inicio + $values;
			}
			
			$this->set(compact('values'));
		}
	}
	
	
/**
 * Itens que foram solicitados por todos por todos, sem repetição
 */	 
	public function requestedItems() {
		
		if($this->request->is('post')){
			$term = $this->request->data['Search']['term'];
		}else{
			$term = '';
		}
		
		$options['conditions'] = array(
				'Item.name LIKE'=>'%'.$term.'%',
			'SolicitationItem.status_id'=>APROVADO
		);
		$options['fields'] = array(
			'Item.*'
		);
		$options['group'] = array('SolicitationItem.item_id');
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '10';
		
		$this->paginate = $options;
		
		$items = $this->paginate();
		$cart_items = $this->__getCartItems();
		$solicitation_items = $this->__getSolicitationItems();
		$action = 'requestedItems';
		
		$this->set(compact('items', 'cart_items', 'solicitation_items', 'action'));
		
		$this->render('/SolicitationItems/index/');
	}
	
/**
 * Monta a pagina de itens de acordo com a solicitação
 * @param unknown_type $status
 */
	public function all_items($solicitation_id) {

		if($this->request->is('post')){
			$status = $this->request->data['SolicitationItem']['status'];
			if(!empty($status)) {				
				$this->request->params['named'] = array();
				$options['conditions'][] = array(
						'SolicitationItem.status_id'=>$status
				);
			}
		}
		
		$options['conditions'][] = array(
					'SolicitationItem.solicitation_id'=>$solicitation_id
				);
		$options['order'] = array('Solicitation.keycode'=>'asc');
		$options['limit'] = 10;

		$this->paginate = $options;
		
		$solicitationItems = $this->paginate();		
		$statuses = array(''=>'Selecione um status',PENDENTE=>'Pendentes', APROVADO=>'Aprovados', NEGADO=>'Negados');
		
		$this->set(compact('solicitationItems', 'statuses'));		
	}
	
/**
 *
 * Muda o status do item da solicitação
 */
	public function changeStatus($id, $status) {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			$this->SolicitationItem->id = $id;
	
			if($this->SolicitationItem->saveField('status_id', $status, false)) {
				echo '1';
			}else {
				echo '-1';
			}
		}
	}
	
	public function approvedAll() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			
			$ids = $this->request->data['ids'];
			
			$fields = array('SolicitationItem.status_id'=>APROVADO);
			$conditions = array('SolicitationItem.id'=>$ids);
			if($this->SolicitationItem->updateAll($fields, $conditions)) {
				echo '1';
			}else {
				echo '-1';
			}
		}		
	}
		
}