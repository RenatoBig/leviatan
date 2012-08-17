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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('controller'=>'pages', 'action'=>'home'));
		}

		if(!$this->Justification->save($this->request->data)) {
			$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			echo 0;
		}
		
		$this->layout = 'ajax';
		$this->Justification->recursive = -1;
		$options['conditions'] = array('Justification.solicitation_item_id'=>$solicitation_item_id);
		$justification = $this->Justification->find('first', $options);
		
		$this->set(compact('justification'));		
	}
	
/**
 *
 * Muda o status do item da solicitação
 */
	public function changeStatus($id, $status) {
		if($this->request->is('post')) {
			$this->SolicitationItem->id = $id;
	
			if($this->SolicitationItem->saveField('status_id', $status, false)) {
				$this->__getMessage(SUCCESS);
			}else {
				$this->__getMessage(ERROR);
			}
	
			$this->redirect($this->referer());
		}
	}

}
