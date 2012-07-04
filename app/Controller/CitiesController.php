<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {
	
	var $layout = "leviatan";

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->City->recursive = 0;
		$this->set('cities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->City->id = $id;
		if (!$this->City->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Cidade inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('city', $this->City->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->City->create();
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('A cidade foi cadastrada.').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A cidade não pode ser cadastrada. Por favor tente novamente.').'</div>');
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
		$this->City->id = $id;
		if (!$this->City->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Cidade inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('A cidade foi alterada.').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A cidade não pode ser alterada. Por favor, tente novamente.').'</div>');
			}
		} else {
			$this->request->data = $this->City->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if(!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->City->id = $id;
		if (!$this->City->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Cidade inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		if($this->City->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('Cidade deletada.').'</div>');
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash('<div class="alert alert-error">'.__('A cidade não pode ser deletada. Possivelmente o registro está cadastrado em outra tabela.').'</div>');
		$this->redirect(array('action' => 'index'));
	}
}
