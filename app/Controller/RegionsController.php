<?php
App::uses('AppController', 'Controller');
/**
 * Regions Controller
 *
 * @property Region $Region
 */
class RegionsController extends AppController {

	var $uses = array('Region', 'Area');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Region->recursive = 0;
		$this->set('regions', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Região inválida'));
		}
		$this->set('region', $this->Region->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Region->create();
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('A região foi cadastrada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A região não pode ser cadastrada. Por favor, tente novamente'));
			}
		}
		$inicio = array(''=>'Selecione um item');
		$cities = $this->Region->City->find('list');
		$areas = $this->Region->Area->find('list');
		//---------------------
		$cities = $inicio + $cities;
		$areas = $inicio + $areas;
		$this->set(compact('cities', 'areas'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Região inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('A região foi alterada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A região não pode ser alterada. Por favor, tente novamente.'));
			}
		} else {
			$this->request->data = $this->Region->read(null, $id);
		}
		$inicio = array(''=>'Selecione um item');
		$cities = $this->Region->City->find('list');
		$areas = $this->Region->Area->find('list');
		//---------------------
		$cities = $inicio + $cities;
		$areas = array($this->request->data['Area']['id']=>$this->request->data['Area']['name']);
		$areas = $areas + $this->__getAreas();
		
		$this->set(compact('cities', 'areas'));
	}
	
	/**
	 * 
	 * Recupera as áreas que ainda não foram cadastradas na região
	 * @param unknown_type $cityId
	 */
	private function __getAreas() {
		//id da unidade			
		$cityId = $this->request->data['Region']['city_id'];

		if($cityId == "") {
			exit;
		}

		$db = $this->Region->getDataSource();			
		$subQuery = $db->buildStatement(
		    array(
		        'fields'     => array(' * '),
		        'table'      => $db->fullTableName($this->Region),
		        'alias'      => 'Region',
		        'limit'      => null,
		        'offset'     => null,
		        'joins'      => array(),
		        'conditions' => array(
		    		'Area.id = Region.area_id',
		  			'Region.city_id'=>$cityId
		    	),
		        'order'      => null,
		        'group'      => null
		    ),
		    $this->Region
		);
		$subQuery = ' NOT EXISTS (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$areas = $this->Area->find('list', compact('conditions'));
		
		if(empty($areas)) {
			$inicio = array(''=>'Não existem áreas ou foram todas cadastradas');	
		}else {
			$inicio = array(''=>'Selecione um item');
		}
		$areas = $inicio + $areas;
		
		return $areas;
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
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Região inválida'));
		}
				
		$region = $this->Region->read(null, $id);
		if(!empty($region['Unity'])) {
			$this->Session->setFlash('Você não pode deletar esta região, ela está cadastrada em outra tabela.');
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->Region->delete()) {
			$this->Session->setFlash(__('Região deletada'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A região não pode ser deletada.'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function getAreas() {
		if($this->request->is('ajax')) {
			//id da cidade
			$city_id = $this->request->data['Unity']['city_id'];
			//Recupera as áreas de acordo com a cidade escolhida
			$areas = $this->Region->find('all', 
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
	 		
			$this->set(compact('newAreas'));
			$this->layout = 'ajax';
		}		
	}
}
