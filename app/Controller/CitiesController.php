<?php
App::uses('AppController', 'Controller');
/**
 * Cities Controller
 *
 * @property City $City
 */
class CitiesController extends AppController {


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
			throw new NotFoundException(__('Cidade inválida.'));
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
				$this->Session->setFlash(__('A cidade foi cadastrada.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A cidade não pode ser cadastrada. Por favor tente novamente.'));
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
			throw new NotFoundException(__('Cidade inválida.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->City->save($this->request->data)) {
				$this->Session->setFlash(__('A cidade foi alterada.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A cidade não pode ser alterada. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Cidade inválida.'));
		}
		
		$city = $this->City->read(null, $id);
		if(!empty($city['Region'])) {
			$this->Session->setFlash('Você não pode deletar esta Cidade, ela está cadastrada em outra tabela.');
			$this->redirect(array('action' => 'index'));
		}
		
		if($this->City->delete()) {
			$this->Session->setFlash(__('Cidade deletada.'));
			$this->redirect(array('action' => 'index'));
		}

		$this->Session->setFlash(__('Cidade não pode ser deletada.'));
		$this->redirect(array('action' => 'index'));
	}
}
