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
			throw new NotFoundException(__('Unidade inválida'));
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
				$this->Session->setFlash(__('A unidade foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A unidade não pode ser cadastrada. Por favor, tente novamente.'));
			}
		}
		
		$inicio = array(''=>'Selecione um item');		
		$cities = $this->Unity->Region->City->find('list');
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		//---------------
		$cities = $inicio + $cities;
		$healthDistricts = $inicio + $healthDistricts;
		$unityTypes = $inicio + $unityTypes;
		$this->set(compact('cities', 'healthDistricts', 'unityTypes'));
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
			throw new NotFoundException(__('Unidade inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Unity->save($this->request->data)) {
				$this->Session->setFlash(__('A unidade foi alterada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A unidade não pode ser alterada. por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Unity->read(null, $id);
			$this->__getInformationEdit();
		}
		
	}
	
/**
 * 
 * Recupera informações para popular o formulário de edição de uma unidade
 * 
 */
	private function __getInformationEdit() {
		
		//id da cidade
		$city_id = $this->request->data['Region']['city_id'];
		//Recupera as áreas de acordo com a cidade escolhida
		$areas = $this->Unity->Region->find('all', 
			array(
				'conditions' => array(
						'Region.city_id' => $city_id,
						'Region.area_id = Area.id'
					),					
				'recursive' => 0,
				'fields' => array('Region.id', 'Area.name')
			)
		);
		
		// organiza o array para colocar no value o id do UnitySector
		// e coloca no text o nome do setor
		$newAreas[''] = "Selecione um item";
		foreach($areas as $value):
			$newAreas[$value['Region']['id']] = $value['Area']['name']; 
		endforeach;
		
		$inicio = array(''=>'Selecione um item');		
		$cities = $this->Unity->Region->City->find('list');
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		//---------------
		$cities = $inicio + $cities;
		$healthDistricts = $inicio + $healthDistricts;
		$unityTypes = $inicio + $unityTypes;
		$this->set(compact('cities', 'healthDistricts', 'unityTypes'));
 		
		$this->set(compact('newAreas', 'cities', 'healthDistricts', 'unityTypes'));
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
