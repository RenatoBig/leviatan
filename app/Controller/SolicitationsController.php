<?php
App::uses('AppController', 'Controller');
/**
 * Solicitations Controller
 *
 * @property Solicitation $Solicitation
 */
class SolicitationsController extends AppController {
	
	var $helpers = array('Utils');
	var $uses = array('Solicitation', 'SolicitationItem', 'User');
	var $layout = 'leviatan';
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Solicitation->recursive = 2;
		
		$user_id = $this->Auth->user('id');
		$conditions = array(
			'conditions'=>array(
				'Solicitation.user_id'=>$user_id
			),
			'limit'=>5,
			'order'=>array('Solicitation.name'=>'desc')
		);
		$this->paginate = $conditions;
		
		$this->set('solicitations', $this->paginate());
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
		$options['limit'] = '5';

		$this->paginate = $options;
		
		$this->set('items', $this->paginate('SolicitationItem'));
	}
	
/**
 * delete method
 *
 * @return void
 */
	public function delete($id = null) {
		
		//Se não for via post sai do método
		if(!$this->request->is('post')) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		$solicitation = $this->Solicitation->read(null, $id);
				
		//-------------
		//Não deixa o usuário deletar o pedido de outro usuário
		//Usuário logado
		$user = $this->Auth->user();
		//Usuário do pedido
		$userSolicitation = $solicitation['User']['id'];
		
		if($user['id'] != $userSolicitation) {
			$this->Session->setFlash('<div class="alert alert-error">'.__("Você não pode deletar o pedido de outro usuário.").'</div>');
			$this->redirect(array('controller'=>'orders', 'action'=>'index'));
		}
		//--------------------
		
		//pega ids dos itens da solicitação
		$idItems = array();
		foreach($solicitation['SolicitationItem'] as $solicitationItem):
			$idItems[] = $solicitationItem['id'];
		endforeach;
		
		$conditions = array(
			"SolicitationItem.id"=>$idItems,
		);		
		
		if($this->SolicitationItem->deleteAll($conditions, false)) {
			if(!$this->Solicitation->delete($id)) {
				$this->Session->setFlash('<div class="alert alert-error">'.__('Erro ao deletar o registro no banco de dados').'</div>');
			}
		}	
		
		$this->Session->setFlash('<div class="alert alert-success">'.__('Solicitação deletada com sucesso.').'</div>');
		$this->redirect(array('controller'=>'solicitations', 'action'=>'index'));
	}	

}