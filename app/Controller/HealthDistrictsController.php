<?php
App::uses('AppController', 'Controller');
/**
 * HealthDistricts Controller
 *
 * @property HealthDistrict $HealthDistrict
 */
class HealthDistrictsController extends AppController {

	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->HealthDistrict->recursive = -1;
		
		$options['order'] = array('HealthDistrict.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;		
		
		$this->set('healthDistricts', $this->paginate());
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
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->HealthDistrict->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->HealthDistrict->id = $id;
		if (!$this->HealthDistrict->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->HealthDistrict->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
