<?php
App::uses('AppController', 'Controller');
/**
 * UnitySectors Controller
 *
 * @property UnitySector $UnitySector
 */
class UnitySectorsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnitySector->recursive = 0;
		$this->set('unitySectors', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->UnitySector->id = $id;
		if (!$this->UnitySector->exists()) {
			throw new NotFoundException(__('Invalid unity sector'));
		}
		$this->set('unitySector', $this->UnitySector->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnitySector->create();
			if ($this->UnitySector->save($this->request->data)) {
				$this->Session->setFlash(__('The unity sector has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity sector could not be saved. Please, try again.'));
			}
		}
		
		
		$unities = $this->UnitySector->Unity->find('list');
		$sectors = $this->UnitySector->Sector->find('list');
		$this->set(compact('unities', 'sectors'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->UnitySector->id = $id;
		if (!$this->UnitySector->exists()) {
			throw new NotFoundException(__('Invalid unity sector'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnitySector->save($this->request->data)) {
				$this->Session->setFlash(__('The unity sector has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unity sector could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->UnitySector->read(null, $id);
		}
		$unities = $this->UnitySector->Unity->find('list');
		$sectors = $this->UnitySector->Sector->find('list');
		$this->set(compact('unities', 'sectors'));
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
		$this->UnitySector->id = $id;
		if (!$this->UnitySector->exists()) {
			throw new NotFoundException(__('Invalid unity sector'));
		}
		if ($this->UnitySector->delete()) {
			$this->Session->setFlash(__('Unity sector deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Unity sector was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Função que retorna os setores de acordo com a unidade escolhida
 */
	public function getSector() {
		if($this->request->is('ajax')) {
			//id da unidade			
			$unity_id = $this->request->data['Employee']['Unity'];
			//Recupera os setores de acordo com a unidade escolhida
			$inicial = array('0'=>'Selecione um item');
			$sectors = $this->UnitySector->find('all', 
				array(
					'conditions' => array(
							'UnitySector.unity_id' => $unity_id,
							'UnitySector.sector_id = Sector.id'
						),					
					'recursive' => 0,
					'fields' => array('UnitySector.id', 'Sector.name')
				)
			);
			// organiza o array para colocar no value o id do UnitySector
			// e coloca no text o nome do setor
			foreach($sectors as $value):
				$newSectors[$value['UnitySector']['id']] = $value['Sector']['name']; 
			endforeach;
	 		
			$this->set(compact('newSectors'));
			$this->layout = 'ajax';
		}		
	}
	
}
