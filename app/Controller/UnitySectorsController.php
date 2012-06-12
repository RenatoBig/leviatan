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
			throw new NotFoundException(__('Unidade_setor inválido'));
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
				$this->Session->setFlash(__('A unidade_setor foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A unidade_setor não pode ser cadastrada. por favor, tente novamente.'));
			}
		}
		
		$inicio = array(''=>'Selecione um item');
		$unities = $this->UnitySector->Unity->find('list');
		$sectors = $this->UnitySector->Sector->find('list');
		//--------------
		$unities = $inicio + $unities;
		$sectors = $inicio + $sectors;
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
		
		$inicio = array(''=>'Selecione um item');
		$unities = $this->UnitySector->Unity->find('list');
		$sectors = $this->UnitySector->Sector->find('list');
		//--------------
		$unities = $inicio + $unities;
		$sectors = $inicio + $sectors;
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
			$newSectors[''] = "Selecione um item";
			foreach($sectors as $value):
				$newSectors[$value['UnitySector']['id']] = $value['Sector']['name']; 
			endforeach;
	 		
			$this->set(compact('newSectors'));
			$this->layout = 'ajax';
		}		
	}
	
}
