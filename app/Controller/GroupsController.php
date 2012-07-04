<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {
	
	var $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Grupo inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O grupo foi salvo')."</div>");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O grupo não pode ser salvo. Por favor, tente novamente.').'</div>');
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Grupo inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O grupo foi salvo').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O grupo não pode ser salvo. Por favor, tente novamente.').'</div>');
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Requisição inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Grupo inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Group->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('Grupo deletado').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('O grupo não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.').'</div>');
		$this->redirect(array('action' => 'index'));
	}

}
