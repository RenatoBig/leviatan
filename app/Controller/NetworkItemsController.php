<?php
App::uses('AppController', 'Controller');
/**
 * NetworkItems Controller
 *
 * @property NetworkItem $NetworkItem
 */
class NetworkItemsController extends AppController {
	
	var $layout = 'leviatan';
	var $uses = array('NetworkItem', 'Item', 'SolicitationItem', 'Solicitation');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$options['limit'] = 5;
		
		$this->paginate = $options;		
		$items = $this->paginate();

		
		$this->set(compact('items'));		
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->NetworkItem->id = $id;
		if (!$this->NetworkItem->exists()) {
			throw new NotFoundException(__('Invalid network item'));
		}
		$this->set('networkItem', $this->NetworkItem->read(null, $id));
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
