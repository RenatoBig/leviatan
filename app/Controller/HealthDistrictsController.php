<?php
App::uses('AppController', 'Controller');
/**
 * HealthDistricts Controller
 *
 * @property HealthDistrict $HealthDistrict
 */
class HealthDistrictsController extends AppController {

	var $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->HealthDistrict->recursive = 0;
		$this->set('healthDistricts', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->HealthDistrict->id = $id;
		if (!$this->HealthDistrict->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Distrito sanitário inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('healthDistrict', $this->HealthDistrict->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->HealthDistrict->create();
			if ($this->HealthDistrict->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O distrito sanitário foi cadastrado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('O distrito sanitário não pode ser cadastrado. Por favor, tente novamente.').'</div>');
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
		$this->HealthDistrict->id = $id;
		if (!$this->HealthDistrict->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Distrito sanitário inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HealthDistrict->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('O distrito sanitário não pode ser alterado').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('o distrito sanitário não foi alterado. por favor, tente novamente.').'</div>');
			}
		} else {
			$this->request->data = $this->HealthDistrict->read(null, $id);
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
		$this->HealthDistrict->id = $id;
		if (!$this->HealthDistrict->exists()) {
			$this->Session->setFlash('<div class="alert alert-error">'.__('Distrito sanitário inválido').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->HealthDistrict->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('O distrito sanitário foi deletado').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('O distrito sanitário não pode ser deletado. Possivelmente o registro está cadastrado em outra tabela.').'</div>');
		$this->redirect(array('action' => 'index'));
	}
}
