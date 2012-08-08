<?php
App::uses('AppController', 'Controller');
/**
 * SolicitationItems Controller
 *
 * @property SolicitationItem $SolicitationItem
 */
class SolicitationItemsController extends AppController {
	
	public $helpers = array('Utils', 'Fck');
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
 * Monta a pagina de itens de acordo com a solicitação
 * @param unknown_type $status
 */
	public function all_items($solicitation_id) {

		if($this->request->is('post')){
			$status = $this->request->data['SolicitationItem']['status'];
			if(!empty($status)) {
				$status_condition = array('SolicitationItem.status_id'=>$status);
			}else {
				$status_condition = '';
			}
		}else{
			$status_condition = '';
		}
		
		$options['conditions'] = array(
					'SolicitationItem.solicitation_id'=>$solicitation_id,
					$status_condition
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
	
}