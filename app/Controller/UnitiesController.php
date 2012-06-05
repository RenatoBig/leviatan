<?php
App::uses('AppController', 'Controller');
/**
 * Unities Controller
 *
 * @property Unity $Unity
 */
class UnitiesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Unity->recursive = 0;
		$this->set('unities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			throw new NotFoundException(__('Invalid unity'));
		}
		$this->set('unity', $this->Unity->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Unity->create();
			if ($this->Unity->save($this->request->data)) {
				$this->Session->setFlash(__('The unity has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity could not be saved. Please, try again.'));
			}
		}
		$regions = $this->Unity->Region->find('list');
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		$this->set(compact('regions', 'healthDistricts', 'unityTypes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			throw new NotFoundException(__('Invalid unity'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Unity->save($this->request->data)) {
				$this->Session->setFlash(__('The unity has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Unity->read(null, $id);
		}
		$regions = $this->Unity->Region->find('list');
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		$this->set(compact('regions', 'healthDistricts', 'unityTypes'));
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
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			throw new NotFoundException(__('Invalid unity'));
		}
		if ($this->Unity->delete()) {
			$this->Session->setFlash(__('Unity deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unity was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
