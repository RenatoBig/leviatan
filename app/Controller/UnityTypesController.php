<?php
App::uses('AppController', 'Controller');
/**
 * UnityTypes Controller
 *
 * @property UnityType $UnityType
 */
class UnityTypesController extends AppController {
	
	var $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnityType->recursive = 0;
		$this->set('unityTypes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Tipo da unidade inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('unityType', $this->UnityType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnityType->create();
			if ($this->UnityType->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O tipo da unidade foi cadastrado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O tipo da unidade não foi cadastrada. Por favor, tente novamente').'</div>');
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
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Tipo da unidade inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnityType->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O tipo da unidade foi alterado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O tipo da unidade não foi cadastrada. Por favor, tente novamente').'</div>');
			}
		} else {
			$this->request->data = $this->UnityType->read(null, $id);
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
		$this->UnityType->id = $id;
		if (!$this->UnityType->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Tipo da unidade inválido').'</div>');
			$this->redirect(array('action'=>'index'));		}
		
		if ($this->UnityType->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('tipo da unidade deletado').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('O tipo da unidade não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela').'</div>');
		$this->redirect(array('action' => 'index'));
	}
}
