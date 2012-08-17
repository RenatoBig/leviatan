<?php
App::uses('AppController', 'Controller');
/**
 * Unities Controller
 *
 * @property Unity $Unity
 */
class UnitiesController extends AppController {
	
	public $layout = 'leviatan';
	public $uses = array('Unity', 'Region', 'City');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Unity->recursive = 0;
		
		$options['order'] = array('Unity.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
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
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		
		$inicio = array(''=>'Selecione um item');		
		$cities = $this->__getCities();
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		//---------------
		$cities = $inicio + $cities;
		$healthDistricts = $inicio + $healthDistricts;
		$unityTypes = $inicio + $unityTypes;
		$this->set(compact('cities', 'healthDistricts', 'unityTypes'));
	}
	
/**
 * 
 * Enter description here ...
 */
	private function __getCities() {
		
		$db = $this->Region->getDataSource();			
		$subQuery = $db->buildStatement(
		    array(
		        'fields'     => array('DISTINCT Region.city_id'),
		        'table'      => $db->fullTableName($this->Region),
		        'alias'      => 'Region',
		        'limit'      => null,
		        'offset'     => null,
		        'joins'      => array(),
		        'conditions' => array(
		    	),
		        'order'      => null,
		        'group'      => null
		    ),
		    $this->Region
		);
		$subQuery = ' EXISTS (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$cities = $this->Unity->Region->City->find('list', compact('conditions'));

		return $cities;
		
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
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Unity->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Unity->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
}
