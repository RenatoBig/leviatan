<?php
App::uses('AppController', 'Controller');
/**
 * UnitySectors Controller
 *
 * @property UnitySector $UnitySector
 */
class UnitySectorsController extends AppController {
	
	var $uses = array('UnitySector', 'Sector', 'Unity');
	var $layout = 'leviatan';
	
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Unidade setor inválido').'</div>');
			$this->redirect(array('action'=>'index'));
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
				$this->Session->setFlash('<div class="alert alert-success">'.__('A unidade_setor foi cadastrada').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A unidade_setor não pode ser cadastrada. por favor, tente novamente.').'</div>');
			}
		}
		
		$inicio = array(''=>'Selecione um item');
		$unities = $this->UnitySector->Unity->find('list');
		//--------------
		$unities = $inicio + $unities;
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Unidade setor inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UnitySector->save($this->request->data)) {
				$this->Session->setFlash('<div class="alert alert-success">'.__('A unidade_setor foi alterada').'</div>');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('<div class="alert alert-error">'.__('A unidade_setor foi alterada. Por favor, tente novamente.').'</div>');
			}
		} else {
			$this->request->data = $this->UnitySector->read(null, $id);
		}
		
		$inicio = array(''=>'Selecione um item');
		$unities = $this->UnitySector->Unity->find('list');
		$sectors = $this->UnitySector->Sector->find('list');
		//--------------
		$unities = $inicio + $unities;
		$sectors = array($this->request->data['Sector']['id']=>$this->request->data['Sector']['name']);
		$sectors = $sectors + $this->__getSectors();
		
		$this->set(compact('unities', 'sectors'));
	}
	
/**
 * 
 * Função que retorna os setores que ainda não estão 
 * cadastradas na tabela de unidades setores
 */
	private function __getSectors() {
			
		//id da unidade			
		$unityId = $this->request->data['UnitySector']['unity_id'];

		if($unityId == "") {
			exit;
		}

		$db = $this->UnitySector->getDataSource();			
		$subQuery = $db->buildStatement(
		    array(
		        'fields'     => array(' * '),
		        'table'      => $db->fullTableName($this->UnitySector),
		        'alias'      => 'UnitySector',
		        'limit'      => null,
		        'offset'     => null,
		        'joins'      => array(),
		        'conditions' => array(
		    		'Sector.id = UnitySector.sector_id',
		  			'UnitySector.unity_id'=>$unityId
		    	),
		        'order'      => null,
		        'group'      => null
		    ),
		    $this->Region
		);
		$subQuery = ' NOT EXISTS (' . $subQuery . ') ';
		$subQueryExpression = $db->expression($subQuery);
		$conditions[] = $subQueryExpression;
		$sectors = $this->Sector->find('list', compact('conditions'));

		if(empty($sectors)) {
			$inicio = array(''=>'Não existem setores ou foram todos cadastrados');	
		}else {
			$inicio = array(''=>'Selecione um item');
		}
		$sectors = $inicio + $sectors;
		
		return $sectors;
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
			$this->Session->setFlash('<div class="alert alert-error">'.__('Unidade setor inválida').'</div>');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->UnitySector->delete()) {
			$this->Session->setFlash('<div class="alert alert-success">'.__('Unidade_setor foi deletada').'</div>');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash('<div class="alert alert-error">'.__('A unidade_setor não pode ser deletada. Possivelmente o registro está cadastrado em outra tabela.').'</div>');
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
