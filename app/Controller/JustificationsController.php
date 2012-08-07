<?php
App::uses('AppController', 'Controller');
/**
 * Justifications Controller
 *
 * @property Justification $Justification
 */
class JustificationsController extends AppController {
	
	public $helpers = array('Fck');
	
/**
 * 
 */
	public function add() {
		
		if(!$this->request->is('post')) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			$this->redirect(array('controller'=>'pages', 'action'=>'home'));
		}

		if(!$this->Justification->save($this->request->data)) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Não foi possível salva a justificativa').'</div>');
			$this->redirect(array('controller'=>'pages', 'action'=>'home'));
		}
		
		$id = $this->request->data['Justification']['solicitation_item_id'];
		$this->changeStatus($id, NEGADO);
	}
	
	
/**
 * 
 */
	public function view($solicitation_item_id) {
		
		if(!$this->request->is('ajax')) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			echo 0;
		}
		
		$this->layout = 'ajax';
		$this->Justification->recursive = -1;
		$options['conditions'] = array('Justification.solicitation_item_id'=>$solicitation_item_id);
		$justification = $this->Justification->find('first', $options);
		
		$this->set(compact('justification'));		
	}

}
