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
			throw new NotFoundException(__('Invalid group type'));
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
				$this->Session->setFlash(__('The group type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group type could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid group type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GroupType->save($this->request->data)) {
				$this->Session->setFlash(__('The group type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group type could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid group type'));
		}
		if ($this->GroupType->delete()) {
			$this->Session->setFlash(__('Group type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
