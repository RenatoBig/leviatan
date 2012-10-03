<?php
App::uses('AppController', 'Controller');
/**
 * Sectors Controller
 *
 * @property Sector $Sector
 */
class SectorsController extends AppController {
	
	var $uses = array('Sector', 'UnitySector');
	var $layout = 'leviatan';


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sector->recursive = -1;
		
		$options['order'] = array('Sector.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('sectors', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sector->create();
			if ($this->Sector->save($this->request->data)) {
				$this->__getMessage(SUCCESS);				
			} else {
				$this->__getMessage(ERROR);
			}
			$this->redirect(array('controller'=>'unity_sectors', 'action' => 'add'));
		}
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}else {
			$this->__getMessage(BAD_REQUEST);
			$this->redirect($this->referer());
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Sector->id = $id;
		if (!$this->Sector->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sector->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->Sector->read(null, $id);
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
		}
		$this->Sector->id = $id;
		if (!$this->Sector->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Sector->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Função que retorna os setores que ainda não estão 
 * cadastradas na tabela de unidades setores
 */
	public function get_sectors() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			
			//id da unidade			
			$unityId = $this->request->data['parent_id'];

			if($unityId == "") {
				$sectors = array(''=>'Selecione uma unidade');
				echo json_encode($sectors);
				return;
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
			
			echo json_encode($sectors);
		}		
	}
	
/**
 *
 */
	public function get_children() {		
		$values = $this->request->data['values'];		
		parent::get_children('UnitySector', 'Unity', 'Sector', $values);
	}
	
}
