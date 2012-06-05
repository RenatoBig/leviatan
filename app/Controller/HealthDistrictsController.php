<?php
App::uses('AppController', 'Controller');
/**
 * HealthDistricts Controller
 *
 * @property HealthDistrict $HealthDistrict
 */
class HealthDistrictsController extends AppController {


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
			throw new NotFoundException(__('Invalid health district'));
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
				$this->Session->setFlash(__('The health district has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The health district could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid health district'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HealthDistrict->save($this->request->data)) {
				$this->Session->setFlash(__('The health district has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The health district could not be saved. Please, try again.'));
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
			throw new NotFoundException(__('Invalid health district'));
		}
		if ($this->HealthDistrict->delete()) {
			$this->Session->setFlash(__('Health district deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Health district was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
