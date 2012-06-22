<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 */
class EmployeesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Employee->recursive = 0;
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
			throw new NotFoundException(__('Funcionário inválido'));
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
				$this->Session->setFlash(__('O funcionário foi cadastrado.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O funcionário não pode ser cadastrado. Por favor, tente novamente.'));
			}
		}
		
		$inicial = array(''=>'Selecione um item');
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
			throw new NotFoundException(__('Funcionário inválido.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('O funcionário foi alterado.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O funcionário não pode ser cadastrado. Por favor, tente novamente.'));
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
		
		$inicial = array(''=>'Selecione um item');
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
			throw new MethodNotAllowedException();
		}
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			throw new NotFoundException(__('Funcionário inválido.'));
		}
		
		if ($this->Employee->delete()) {
			$this->Session->setFlash(__('Funcionário deletado.'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Não foi possível deletar o funcionário. Possivelmente o registro está cadastrado em outra tabela.'));
		$this->redirect(array('action' => 'index'));
	}
}
