<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		$this->set('area', $this->Area->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Area->create();
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('The area has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The area could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Area->read(null, $id);
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Invalid area'));
		}
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('Area deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Area was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
