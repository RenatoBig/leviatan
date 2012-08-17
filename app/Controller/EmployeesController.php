<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 */
class EmployeesController extends AppController {
	
	public $layout = 'leviatan';
	public $helpers = array('Time');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Employee->recursive = 0;
		
		$options['order'] = array('Employee.name');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('employees', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		$this->set('employee', $this->Employee->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$this->Employee->create();
			if ($this->Employee->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		
		$inicial = array(''=>__('Selecione um item'));
		$unities = $this->Employee->UnitySector->Unity->find('list');
		
		$unities = $inicial + $unities;
		
		$this->set(compact('unities'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Employee->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			//Recupera o registro do funcionário para edição
			$this->request->data = $this->Employee->read(null, $id);
			$this->__getInformationEdit();
		}
		
	}
	
	/**
	 * 
	 * Recupera informações para popular o formulário de edição de um funcionário
	 * 
	 */
	private function __getInformationEdit() {
		
		$inicial = array(''=>__('Selecione um item'));
		//recupera as unidades
		$unities = $this->Employee->UnitySector->Unity->find('list');
		//Recupera os setores da unidade associados ao funcuinário selecionado
		$sectorsUnity = $this->Employee->UnitySector->find('all', 
			array(
				'conditions'=>array(
						'UnitySector.unity_id' => $this->request->data['UnitySector']['unity_id'],
						'UnitySector.sector_id = Sector.id'
				)
			)
		);
		
		$sectors[''] = "Selecione um item";
		//Organiza o array de setores
		foreach($sectorsUnity as $value):
			$sectors[$value['UnitySector']['id']] = $value['Sector']['name']; 
		endforeach;

		$unities = $inicial + $unities;
		
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
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Employee->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}

		$this->redirect(array('action' => 'index'));
	}
}
