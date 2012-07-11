<?php
App::uses('AppController', 'Controller');
/**
 * SolicitationItems Controller
 *
 * @property SolicitationItem $SolicitationItem
 */
class SolicitationItemsController extends AppController {
	
	public $helpers = array('Utils');
	var $uses = array('SolicitationItem', 'Solicitation', 'Item', 'User', 'UnitySector', 'Region', 'UnityType', 'HealthDistrict');
	var $layout = "leviatan";
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$conditions = array(
			'conditions'=>array('Item.status_id'=>ATIVO),
			'order'=>array('Item.name'=>'asc'),
			'limit'=>'3'			
		);
		$this->paginate = $conditions;
		
		$this->set('items', $this->paginate('Item'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function pendingSolicitations() {
		
		if($this->request->is('post')) {
			if(!empty($this->request->data['Item']['item'])) {
				$item_id = $this->request->data['Item']['item'];
			}	
			if(!empty($this->request->data['Item']['user'])) {
				$user_id = $this->request->data['Item']['user'];
			}	
			if(!empty($this->request->data['Item']['solicitation'])) {
				$solicitation_id = $this->request->data['Item']['solicitation'];
			}
		}
		
		$items = $this->__getItems();
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		
		if(isset($item_id)) {
			$itemsSelect = array('SolicitationItem.item_id'=>$item_id);
		}else {
			$itemsSelect = '';
		}
		
		if(isset($user_id)) {
			$usersSelect = array('Solicitation.user_id'=>$user_id);
		}else {
			$usersSelect = '';
		}
		
		if(isset($solicitation_id)) {
			$solicitationsSelect = array('SolicitationItem.solicitation_id'=>$solicitation_id);
		}else {
			$solicitationsSelect = '';
		}
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>AGUARDANDO, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$this->UnitySector->recursive = 0;
		$this->Region->recursive = 0;
		$this->UnityType->recursive = -1;
		$this->HealthDistrict->recursive = -1;
		
		$allItems = $this->paginate();
		$newItems = array();		
		foreach($allItems as $key=>$item):
			$user_id = $item['Solicitation']['user_id'];
			$user = $this->User->read(null,$user_id);
			
			$unity_sector = $this->UnitySector->read(null, $user['Employee']['unity_sector_id']);
			$region = $this->Region->read(null, $unity_sector['Unity']['region_id']);
			$unity_type = $this->UnityType->read(null, $unity_sector['Unity']['unity_type_id']);
			$health_district = $this->HealthDistrict->read(null, $unity_sector['Unity']['health_district_id']);
			
			$allItems[$key]['User'] = $user['User'];
			$allItems[$key]['Employee'] = $user['Employee'];
			$allItems[$key]['Sector'] = $unity_sector['Sector'];
			$allItems[$key]['Unity'] = $unity_sector['Unity'];
			$allItems[$key]['City'] = $region['City'];
			$allItems[$key]['Area'] = $region['Area'];
			$allItems[$key]['UnityType'] = $unity_type['UnityType'];
			$allItems[$key]['HealthDistrict'] = $health_district['HealthDistrict'];			
		endforeach;
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getItems() {
		
		//Itens cadastrados
		$op['fields'] = array('DISTINCT Item.id', 'Item.name');
		$op['conditions'] = array("SolicitationItem.status_id"=>AGUARDANDO);
		$temp = $this->SolicitationItem->find('all', $op);
		
		$items[''] = "Selecione um item";
		foreach($temp as $t):
			$items[$t['Item']['id']] = $t['Item']['name'];
		endforeach;
		
		return $items;
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getUsers() {

		$this->Solicitation->recursive = -1;
		
		$op['fields'] = array('Solicitation.id', 'Solicitation.user_id');
		$op['distinct'] = array('Solicitation.user_id');
		$users = $this->Solicitation->find('all', $op);
		
		foreach($users as $user):
			$user_ids[] = $user['Solicitation']['user_id']; 
		endforeach;
		
		$values = $this->User->find('all', array('conditions'=>array('User.id'=>$user_ids), 'fields'=>'Employee.name'));
		
		$employees[''] = 'Selecione um usuário';
		foreach($values as $v):
			$employees[$v['User']['id']] = $v['Employee']['name'];
		endforeach;
		
		return $employees;
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getSolicitations() {
		
		$this->Solicitation->recursive = -1;	

		$inicio = array(''=>'Selecione uma solicitação');
		$solicitations = $inicio + $this->Solicitation->find('list', array('fields'=>array('Solicitation.id', 'Solicitation.keycode')));
		
		return $solicitations;		
	}
	
	
/**
 * 
 * Enter description here ...
 */
	public function cart() {			
		
		$items = $this->Session->read('items');		
		$this->set(compact('items'));		
	}
	
/**
 * 
 * Adiciona item ao carrinho
 * @param unknown_type $id
 */
	public function addToCart($id) {
		$this->autoRender = false;
		if($this->request->is('ajax')) {			
			$this->Item->recursive = -1;
			$items = $this->Session->read('items');
			if($items == null) {
				$items = array();
			}
						
			$item = $this->Item->find('first', array('conditions'=>array('Item.id'=>$id)));
			
			$flag = true;
			$itemsSession = $this->Session->read('items');
			
			//Não adiciona no carrinho itens já adicionados
			foreach($itemsSession as $i):
				if($i['Item']['id'] == $id) {
					$flag = false;
					break;
				}
			endforeach;
			
			if($flag) {
				$items = am($items, array($item));
				$this->Session->write('items', $items);
			}			
						
			echo true;
		}
	}
	
/**
 * 
 * Remove item do carrinho
 * @param unknown_type $id
 */
	public function removeFromCart($id) {
		$this->autoRender = false;
		if($this->request->is('ajax')) {			
			$idDelete = -1;
			$itemsSession = $this->Session->read('items');
			foreach($itemsSession as $key=>$item):
				if($item['Item']['id'] == $id) {
					$idDelete = $key;
					break;
				}
			endforeach;
			
			unset($itemsSession[$idDelete]);
			
			$items = $itemsSession;
			$this->Session->write('items', $items);
			
			echo true;
		}
	}
	
/**
 * 
 * Adiciona os itens do carrinho em uma solicitação
 */
	public function checkout() {
		if($this->request->is('post')) {			
			$flag = true;
			$user = $this->Auth->user();
			
			$keycode = rand(0, time());

			$this->Solicitation->create();
			
			$solicitation['Solicitation']['keycode'] = $keycode;
			$solicitation['Solicitation']['user_id'] = $user['id'];
			$solicitation['Solicitation']['status_id'] = AGUARDANDO;
			
			if(!$this->Solicitation->save($solicitation)) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao salvar o solicitação').'</div>');
				$this->redirect(array('action'=>'cart'));
			}			
			$idSolicitation = $this->Solicitation->id;		
			
			$solicitationItem['SolicitationItem']['solicitation_id'] = $idSolicitation;
			
			foreach($this->request->data['SolicitationItem'] as $key=>$row):
				$this->SolicitationItem->create();
				$solicitationItem['SolicitationItem']['item_id'] = $row['item_id'];
				$solicitationItem['SolicitationItem']['quantity'] = $row['quantity'];	
				$solicitationItem['SolicitationItem']['status_id'] = AGUARDANDO;
				if(!$this->SolicitationItem->save($solicitationItem)) {
					$this->Solicitation->delete();
					$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao salvar o item da solicitação').'</div>');
					$this->redirect(array('action'=>'cart'));
				}	
			endforeach;
			
			$this->Session->write('items', null);
			$this->Session->setFlash('<div class="alert alert-success">'.__('Solicitação feita com sucesso').'</div>');
			$this->redirect(array('controller'=>'solicitations', 'action'=>'index'));
		} 		
	}
	
	
/**
 * 
 * Muda o status do item da solicitação
 */
	public function changeStatus($id = null) {
		if($this->request->is('ajax')) {
			
			$value = '';
			$status = $this->request->query['status'];

			if($status == "HOMOLOGADO") {
				$value = HOMOLOGADO;
			}else if($status == "NEGADO") {
				$value = NEGADO;
			}else if($status == "CONCLUIDO") {
				$value = CONCLUIDO;
			}
			
			$this->SolicitationItem->recursive = -1;
			$solicitationItem = $this->SolicitationItem->read(null, $id);
			$solicitation_id = $solicitationItem['SolicitationItem']['id'];
			
			$this->SolicitationItem->id = $solicitation_id;
			if($this->SolicitationItem->saveField('status_id', $value, false)) {
				echo true;
			}else {
				echo false;	
			}
			
			exit;
		}
	}
	
/**
 * 
 * Mostra registros que foram aprovados
 */
	public function approvedSolicitations() {
		
		if($this->request->is('post')) {
			if(!empty($this->request->data['Item']['item'])) {
				$item_id = $this->request->data['Item']['item'];
			}	
			if(!empty($this->request->data['Item']['user'])) {
				$user_id = $this->request->data['Item']['user'];
			}	
			if(!empty($this->request->data['Item']['solicitation'])) {
				$solicitation_id = $this->request->data['Item']['solicitation'];
			}
		}
		
		$items = $this->__getItemsApproved();
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		
		if(isset($item_id)) {
			$itemsSelect = array('SolicitationItem.item_id'=>$item_id);
		}else {
			$itemsSelect = '';
		}
		
		if(isset($user_id)) {
			$usersSelect = array('Solicitation.user_id'=>$user_id);
		}else {
			$usersSelect = '';
		}
		
		if(isset($solicitation_id)) {
			$solicitationsSelect = array('SolicitationItem.solicitation_id'=>$solicitation_id);
		}else {
			$solicitationsSelect = '';
		}
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>HOMOLOGADO, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$this->UnitySector->recursive = 0;
		$this->Region->recursive = 0;
		$this->UnityType->recursive = -1;
		$this->HealthDistrict->recursive = -1;
		
		$allItems = $this->paginate();
		$newItems = array();		
		foreach($allItems as $key=>$item):
			$user_id = $item['Solicitation']['user_id'];
			$user = $this->User->read(null,$user_id);
			
			$unity_sector = $this->UnitySector->read(null, $user['Employee']['unity_sector_id']);
			$region = $this->Region->read(null, $unity_sector['Unity']['region_id']);
			$unity_type = $this->UnityType->read(null, $unity_sector['Unity']['unity_type_id']);
			$health_district = $this->HealthDistrict->read(null, $unity_sector['Unity']['health_district_id']);
			
			$allItems[$key]['User'] = $user['User'];
			$allItems[$key]['Employee'] = $user['Employee'];
			$allItems[$key]['Sector'] = $unity_sector['Sector'];
			$allItems[$key]['Unity'] = $unity_sector['Unity'];
			$allItems[$key]['City'] = $region['City'];
			$allItems[$key]['Area'] = $region['Area'];
			$allItems[$key]['UnityType'] = $unity_type['UnityType'];
			$allItems[$key]['HealthDistrict'] = $health_district['HealthDistrict'];			
		endforeach;
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
	}
	
/**
 * 
 * Recupera os itens para mostrar no select do filtro das solicitações homologadas
 */
	private function __getItemsApproved() {
		
		//Itens cadastrados
		$op['fields'] = array('DISTINCT Item.id', 'Item.name');
		$op['conditions'] = array("SolicitationItem.status_id"=>HOMOLOGADO);
		$temp = $this->SolicitationItem->find('all', $op);
		
		$items[''] = "Selecione um item";
		foreach($temp as $t):
			$items[$t['Item']['id']] = $t['Item']['name'];
		endforeach;
		
		return $items;
	}
	
/**
 * 
 * Mostra as solicitações que foram negadas
 */
	public function deniedSolicitations() {
		
		if($this->request->is('post')) {
			if(!empty($this->request->data['Item']['item'])) {
				$item_id = $this->request->data['Item']['item'];
			}	
			if(!empty($this->request->data['Item']['user'])) {
				$user_id = $this->request->data['Item']['user'];
			}	
			if(!empty($this->request->data['Item']['solicitation'])) {
				$solicitation_id = $this->request->data['Item']['solicitation'];
			}
		}
		
		$items = $this->__getItemsDenied();
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		
		if(isset($item_id)) {
			$itemsSelect = array('SolicitationItem.item_id'=>$item_id);
		}else {
			$itemsSelect = '';
		}
		
		if(isset($user_id)) {
			$usersSelect = array('Solicitation.user_id'=>$user_id);
		}else {
			$usersSelect = '';
		}
		
		if(isset($solicitation_id)) {
			$solicitationsSelect = array('SolicitationItem.solicitation_id'=>$solicitation_id);
		}else {
			$solicitationsSelect = '';
		}
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>NEGADO, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$this->UnitySector->recursive = 0;
		$this->Region->recursive = 0;
		$this->UnityType->recursive = -1;
		$this->HealthDistrict->recursive = -1;
		
		$allItems = $this->paginate();
		$newItems = array();		
		foreach($allItems as $key=>$item):
			$user_id = $item['Solicitation']['user_id'];
			$user = $this->User->read(null,$user_id);
			
			$unity_sector = $this->UnitySector->read(null, $user['Employee']['unity_sector_id']);
			$region = $this->Region->read(null, $unity_sector['Unity']['region_id']);
			$unity_type = $this->UnityType->read(null, $unity_sector['Unity']['unity_type_id']);
			$health_district = $this->HealthDistrict->read(null, $unity_sector['Unity']['health_district_id']);
			
			$allItems[$key]['User'] = $user['User'];
			$allItems[$key]['Employee'] = $user['Employee'];
			$allItems[$key]['Sector'] = $unity_sector['Sector'];
			$allItems[$key]['Unity'] = $unity_sector['Unity'];
			$allItems[$key]['City'] = $region['City'];
			$allItems[$key]['Area'] = $region['Area'];
			$allItems[$key]['UnityType'] = $unity_type['UnityType'];
			$allItems[$key]['HealthDistrict'] = $health_district['HealthDistrict'];			
		endforeach;
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
	}
	
/**
 * 
 * Recupera os itens para mostrar no select do filtro das solicitações Negadas
 */
	private function __getItemsDenied() {
		
		//Itens cadastrados
		$op['fields'] = array('DISTINCT Item.id', 'Item.name');
		$op['conditions'] = array("SolicitationItem.status_id"=>NEGADO);
		$temp = $this->SolicitationItem->find('all', $op);
		
		$items[''] = "Selecione um item";
		foreach($temp as $t):
			$items[$t['Item']['id']] = $t['Item']['name'];
		endforeach;
		
		return $items;
	}
	
	
}