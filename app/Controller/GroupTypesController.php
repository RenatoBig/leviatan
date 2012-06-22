<?php
App::uses('AppController', 'Controller');
/**
 * GroupTypes Controller
 *
 * @property GroupType $GroupType
 */
class GroupTypesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GroupType->recursive = 0;
		$this->set('groupTypes', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->GroupType->id = $id;
		if (!$this->GroupType->exists()) {
			throw new NotFoundException(__('Tipo do grupo inválido'));
		}
		$this->set('groupType', $this->GroupType->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GroupType->create();
			if ($this->GroupType->save($this->request->data)) {
				$this->Session->setFlash(__('O tipo de grupo foi cadastrado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo de grupo não pode ser cadastrado. Por favor, tente novamente.'));
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
		$this->GroupType->id = $id;
		if (!$this->GroupType->exists()) {
			throw new NotFoundException(__('Tipo do grupo inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupType->save($this->request->data)) {
				$this->Session->setFlash(__('O tipo do grupo foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O tipo do grupo não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->GroupType->read(null, $id);
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
		$this->GroupType->id = $id;
		if (!$this->GroupType->exists()) {
			throw new NotFoundException(__('Tipo do grupo inválido'));
		}
		
		$group = $this->GroupType->read(null, $id);
		if(!empty($group['ItemGroup'])) {
			$this->Session->setFlash('Você não pode deletar este tipo do grupo, ele está cadastrado em outra tabela.');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->GroupType->delete()) {
			$this->Session->setFlash(__('Tipo do grupo deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tipo do grupo não pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}
}
