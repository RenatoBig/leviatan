<?php
App::uses('AppController', 'Controller');
/**
 * NetworkItems Controller
 *
 * @property NetworkItem $NetworkItem
 */
class NetworkItemsController extends AppController {
	
	var $layout = 'leviatan';
	var $uses = array('NetworkItem', 'CartItem', 'Item', 'SolicitationItem', 'Solicitation');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$options['limit'] = 6;
		$options['order'] = array('Item.name'=>'asc');
		
		$this->paginate = $options;		
		$items = $this->paginate();
		$cart_items = $this->__getCartItems();
		$solicitation_items = $this->__getSolicitationItems();
						
		$this->set(compact('items', 'cart_items', 'solicitation_items'));
		$this->render('/SolicitationItems/index');
	}
	
/**
 * Itens que estão no carrinho do usuário atual
 */
	private function __getCartItems() {
	
		$user_id = $this->Auth->user('id');
	
		$options['conditions'] = array(
				'CartItem.user_id'=>$user_id
		);
		$options['fields'] = array(
				'CartItem.item_id'
		);
		$cart_items = $this->CartItem->find('list', $options);
	
		$idItems = array();
		foreach($cart_items as $item):
		$idItems[] = $item;
		endforeach;
	
		return $idItems;
	}

/**
 *
 */
	private function __getSolicitationItems() {
		$user_id = $this->Auth->user('id');
	
		$options['conditions'] = array(
				'Solicitation.user_id'=>$user_id,
				'OR'=>array(
						array('SolicitationItem.status_id'=>PENDENTE),
						array('SolicitationItem.status_id'=>APROVADO)
				)
		);
		$options['fields'] = array(
				'SolicitationItem.item_id',
				'SolicitationItem.quantity'
		);
	
		$solicitationItems = $this->SolicitationItem->find('all', $options);
	
		$items = array();
		foreach($solicitationItems as $value):
		$items[$value['SolicitationItem']['item_id']] = $value['SolicitationItem']['quantity'];
		endforeach;
	
		return $items;
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
		$this->autoRender = false;
		if($this->request->is('post')) {
			$this->request->data['NetworkItem']['item_id'] = $id;
			$this->NetworkItem->create();
			if ($this->NetworkItem->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O item está na rede').'</div>');
				$this->redirect(array('action' => 'items'));
			}
			$this->Session->setFlash('<div class="alert alert-error">'.__('O item não pode ser lançado na rede').'</div>');
			$this->redirect(array('action' => 'items'));
		}	
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->NetworkItem->id = $id;
		if (!$this->NetworkItem->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Item inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if($this->NetworkItem->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('O item não está mais na rede').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('Não foi possível deletar o item da rede').'</div>');
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * items method
 * 
 * Itens que estão em estado aprovado e que podem ser jogados na rede
 * 
 * @return void
 */
	public function items() {
		
		$itemsNetwork = $this->NetworkItem->find('all', array('fields'=>'NetworkItem.item_id'));
		
		$ids = array();		
		foreach($itemsNetwork as $item):
			$ids[] = $item['NetworkItem']['item_id'];
		endforeach;
		
		$options['limit'] = 5;
		$options['group'] = array('SolicitationItem.item_id');
		$options['fields'] = array('Item.*');		
		$options['conditions'] = array(
			'SolicitationItem.status_id'=>APROVADO,
			'SolicitationItem.item_id NOT' => $ids
		);
		
		$this->paginate = $options;
		
		$items = $this->paginate('SolicitationItem');

		$this->set(compact('items'));		
	}
}
