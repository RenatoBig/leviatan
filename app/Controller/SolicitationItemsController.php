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
			'limit'=>'6'			
		);
		$this->paginate = $conditions;
		
		$this->set('items', $this->paginate('Item'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function pendingSolicitations() {
		
		$values = array('', '', '');
		if($this->request->is('post')) {
			$values = $this->__getDataPost($this->request->data);
		}			
		
		$itemsSelect = $values[0];
		$usersSelect = $values[1];
		$solicitationsSelect = $values[2];
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>PENDENTE, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$items = $this->__getItems(PENDENTE);
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();		
		$allItems = $this->__getOthersDatas($this->paginate());
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
	}
	
/**
 * 
 * Mostra registros que foram aprovados
 */
	public function approvedSolicitations() {
		
		$values = array('', '', '');
		if($this->request->is('post')) {
			$values = $this->__getDataPost($this->request->data);
		}			
		
		$itemsSelect = $values[0];
		$usersSelect = $values[1];
		$solicitationsSelect = $values[2];
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>APROVADO, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$items = $this->__getItems(APROVADO);
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		$allItems = $this->__getOthersDatas($this->paginate());		
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
	}
	
	
/**
 * 
 * Mostra as solicitações que foram negadas
 */
	public function deniedSolicitations() {
		
		$values = array('', '', '');
		if($this->request->is('post')) {
			$values = $this->__getDataPost($this->request->data);
		}			
		
		$itemsSelect = $values[0];
		$usersSelect = $values[1];
		$solicitationsSelect = $values[2];		
		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>NEGADO, 
			$itemsSelect, 
			$usersSelect,
			$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$items = $this->__getItems(NEGADO);
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		$allItems = $this->__getOthersDatas($this->paginate());
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations'));
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
			$solicitation['Solicitation']['status_id'] = PENDENTE;
			
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
				$solicitationItem['SolicitationItem']['status_id'] = PENDENTE;
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
	public function changeStatus($id, $status) {
		
		if($this->request->is('post')) {						
			$this->SolicitationItem->recursive = -1;
			$this->SolicitationItem->id = $id;
			
			if($this->SolicitationItem->saveField('status_id', $status, false)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('Item atualizado').'</div>');
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser atualizado').'</div>');
			}
			
			$this->redirect(array('action' => 'pendingSolicitations'));			
		}
	}
	

	
	
/**
 * 
 * Recupera os dados das outras tabelas para montar a página
 * @param unknown_type $allItens
 */
	private function __getOthersDatas($allItems) {
		
		$this->UnitySector->recursive = 0;
		$this->Region->recursive = 0;
		$this->UnityType->recursive = -1;
		$this->HealthDistrict->recursive = -1;
		
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
		
		return $allItems;
	}
	
/**
 * 
 * Recupera os itens de acordo com o status passado como parâmetro
 */
	private function __getItems($status) {
		
		//Itens cadastrados
		$op['group'] = array('SolicitationItem.item_id');
		$op['fields'] = array('Item.id', 'Item.name');
		$op['conditions'] = array("SolicitationItem.status_id"=>$status);
		$temp = $this->SolicitationItem->find('all', $op);
		
		$items[''] = "Selecione um item";
		foreach($temp as $t):
			$items[$t['Item']['id']] = $t['Item']['name'];
		endforeach;
		
		return $items;
	}
	
/**
 * 
 * Recupera os usuários para colocar no select do filtro
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
 * Recupera as solicitações para colocar no filtro
 */
	private function __getSolicitations() {
		
		$this->Solicitation->recursive = -1;	

		$inicio = array(''=>'Selecione uma solicitação');
		$solicitations = $inicio + $this->Solicitation->find('list', array('fields'=>array('Solicitation.id', 'Solicitation.keycode')));
		
		return $solicitations;		
	}
	
/**
 * 
 * Pega dados do post e retorna em um array para ser usado na consulta das páginas
 */
	private function __getDataPost($data) {
		
		if(!empty($data['Item']['item'])) {
			$item_id = $data['Item']['item'];
		}	
		if(!empty($data['Item']['user'])) {
			$user_id = $data['Item']['user'];
		}	
		if(!empty($data['Item']['solicitation'])) {
			$solicitation_id = $data['Item']['solicitation'];
		}
		
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
		
		$values = array($itemsSelect, $usersSelect, $solicitationsSelect);
		
		return $values;
	}
	
}