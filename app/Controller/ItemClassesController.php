<?php
App::uses('AppController', 'Controller');
/**
 * ItemClasses Controller
 *
 * @property ItemClass $ItemClass
 */
class ItemClassesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ItemClass->recursive = 0;
		$this->set('itemClasses', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			throw new NotFoundException(__('Item da classe inválido'));
		}
		$this->set('itemClass', $this->ItemClass->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ItemClass->create();
			if ($this->ItemClass->save($this->request->data)) {
				$this->Session->setFlash(__('Item da classe inválido'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O item da classe não foi cadastrado. por favor, tente novamente.'));
			}
		}
		$inicio = array(''=>'Selecione um item');
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
		$itemGroups = $inicio + $itemGroups;
		$this->set(compact('itemGroups'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			throw new NotFoundException(__('Item da classe inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ItemClass->save($this->request->data)) {
				$this->Session->setFlash(__('O item da classe foi alterado'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O item da classe não pode ser alterado. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->ItemClass->read(null, $id);
		}
		$inicio = array(''=>'Selecione um item');
		$itemGroups = $this->ItemClass->ItemGroup->find('list');
		$itemGroups = $inicio + $itemGroups;
		$this->set(compact('itemGroups'));
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
		$this->ItemClass->id = $id;
		if (!$this->ItemClass->exists()) {
			throw new NotFoundException(__('Item da classe inválido'));
		}
		if ($this->ItemClass->delete()) {
			$this->Session->setFlash(__('Item da classe deletado'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('o item da classe não pode ser deletado'));
		$this->redirect(array('action' => 'index'));
	}
}
