<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {


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
			throw new NotFoundException(__('Grupo inválido'));
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
				$this->Session->setFlash(__('O grupo foi salvo'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grupo não pode ser salvo. Por favor, tente novamente.'));
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
			throw new NotFoundException(__('Grupo inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('O grupo foi salvo'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O grupo não pode ser salvo. Por favor, tente novamente.'));
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
			throw new MethodNotAllowedException();
		}
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Grupo inválido'));
		}
		
		$group = $this->Group->read(null, $id);
		if(!empty($group['User'])) {
			$this->Session->setFlash('Você não pode detelar este grupo, ele está cadastrado em outra tabela.');
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Grupo deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('O grupo não foi deletado'));
		$this->redirect(array('action' => 'index'));
	}

}
