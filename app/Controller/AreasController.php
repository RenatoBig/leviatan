<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {
	
	public $uses = array('Area', 'Region');
	public $layout = 'leviatan';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		
		$this->recursive = -1;
		$options['order'] = array(
			'Area.name'=>'asc'	
		);
		$options['limit'] = 10;
		
		$this->paginate = $options;

		$this->set('areas', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Area->create();
			if ($this->Area->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
			} else {
				$this->__getMessage(ERROR);
			}			
			$this->redirect(array('controller'=>'regions','action' => 'add'));
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Area->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR_DELETE);
			}
		} else {
			$this->request->data = $this->Area->read(null, $id);
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}

		if ($this->Area->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);			
		}
		$this->redirect(array('action' => 'index'));
	}
	
	
/**
 * 
 * Função que retorna as áreas que ainda não estão 
 * cadastradas na tabela de regiões
 */
	public function get_areas() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			//id da unidade			
			$cityId = $this->request->data['parent_id'];

			if($cityId == "") {
				$areas = array(''=>"Selecione uma cidade");
				echo json_encode($areas);
				
				return;
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
			
			echo json_encode($areas);
		}		
	}
	
/**
 *
 */
	public function get_children() {
		$values = $this->request->data['values'];
		parent::get_children('Region', 'City', 'Area', $values);
	}

}
