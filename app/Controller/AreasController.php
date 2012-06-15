<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AreasController extends AppController {
	
	public $uses = array('Area', 'Region');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Area->recursive = 0;
		$this->set('areas', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Área inválida.'));
		}
		$this->set('area', $this->Area->read(null, $id));
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
				$this->Session->setFlash(__('A área foi cadastrada.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A área não pode ser cadastrada. Por favor, tente novamente.'));
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
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Área inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Area->save($this->request->data)) {
				$this->Session->setFlash(__('A área foi alterada'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('A área não pode ser alterada. Por favor, tente novamente.'));
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
			throw new MethodNotAllowedException();
		}
		$this->Area->id = $id;
		if (!$this->Area->exists()) {
			throw new NotFoundException(__('Área inválida'));
		}
		if ($this->Area->delete()) {
			$this->Session->setFlash(__('Área deletada'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('A área não pode ser alterada'));
		$this->redirect(array('action' => 'index'));
	}
	
	
/**
 * 
 * Função que retorna as áreas que ainda não estão 
 * cadastradas na tabela de regiões
 */
	public function getAreas() {
		if($this->request->is('ajax')) {
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
			
			$this->set(compact('areas'));
			$this->layout = 'ajax';
		}		
	}

}
