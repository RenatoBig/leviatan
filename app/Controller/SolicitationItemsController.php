<?php
App::uses('AppController', 'Controller');
/**
 * SolicitationItems Controller
 *
 * @property SolicitationItem $SolicitationItem
 */
class SolicitationItemsController extends AppController {
	
	public $helpers = array('Utils');
	var $uses = array('SolicitationItem', 'Solicitation', 'Item', 'User', 'UnitySector', 'Region', 'UnityType', 'HealthDistrict', 'CartItem');
	var $layout = "leviatan";
	

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		if($this->request->is('post')){
			$term = $this->request->data['Search']['term'];
		}else{
			$term = '';
		}
		
		$options['conditions'] = array(
				'Item.name LIKE'=>'%'.$term.'%',
				'Item.status_id'=>ATIVO
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '10';
		
		$this->paginate = $options;
		
		$items = $this->paginate('Item');
		$cart_items = $this->__getCartItems();
		$solicitation_items = $this->__getSolicitationItems();
		$action = 'index';
		
		$this->set(compact('items', 'cart_items', 'solicitation_items', 'action'));
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
 * Monta a pagina de itens de acordo com o seu status no banco de dados
 * @param unknown_type $status
 */
	public function items($status) {

		if(!in_array($status, array(PENDENTE, APROVADO, HOMOLOGADO, NEGADO))) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Inválido').'</div>');
			$this->redirect($this->referer());
		}
		
		$values = array('', '', '');
		if($this->request->is('post')) {
			$values = $this->__getDataPost($this->request->data);
		}
		
		$itemsSelect = $values[0];
		$usersSelect = $values[1];
		$solicitationsSelect = $values[2];
		
		$options['conditions'] = array(
				'SolicitationItem.status_id'=>$status,
				$itemsSelect,
				$usersSelect,
				$solicitationsSelect
		);
		$options['order'] = array('Item.name'=>'asc');
		$options['limit'] = '5';
		
		$this->paginate = $options;
		
		$items = $this->__getItems($status);
		$users = $this->__getUsers();
		$solicitations = $this->__getSolicitations();
		$allItems = $this->__getOthersDatas($this->paginate());
		
		$this->set(compact('allItems', 'items', 'users', 'solicitations', 'status'));
		$this->render('/SolicitationItems/items');
		
	}
	
/**
 * 
 * Muda o status do item da solicitação
 */
	public function changeStatus($id, $status) {
		if($this->request->is('post')) {						
			$this->SolicitationItem->id = $id;

			if($this->SolicitationItem->saveField('status_id', $status, false)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('Item atualizado').'</div>');
			}else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser atualizado').'</div>');
			}

			$this->redirect($this->referer());
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

		$user_ids = array();
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