<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	
	public $layout = 'leviatan';
	
	
/**
 * (non-PHPdoc)
 * @see AppController::beforeFilter()
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		
		$options['order'] = array('User.id'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('users', $this->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			//Pega o id do funcionario que vem do formulário
			$id = $this->request->data['User']['employee_id'];
			//Faz a consulta no banco de dados   
			$registration = $this->User->Employee->find('first', array(
					'conditions'=>array('Employee.id'=>$id),
					'fields'=>array('Employee.registration'),
					'recursive'=>'-1'
				)
			);
			//Pega apenas a matrícula do funcionário
			$registration = $registration['Employee']['registration'];
			//Atribui a matrícula ao nome de usuário para ser salvo na tabela de usuários			
			$this->request->data['User']['username'] = $registration;
			
			$this->User->create();			
			if ($this->User->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		}
		$inicio = array(''=>'Selecione um item');
		$employees = $this->User->Employee->find('list');
		$groups = $this->User->Group->find('list');
		//-------
		$employees = $inicio + $employees;
		$groups = $inicio + $groups;
		$this->set(compact('employees', 'groups'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));			
		}
		if ($this->request->is('post') || $this->request->is('put')) {			
			if ($this->User->save($this->request->data)) {
				$this->__getMessage(SUCCESS);				
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}	
		$inicio = array(''=>'Selecione um item');	
		$employees = $this->User->Employee->find('list');
		$groups = $this->User->Group->find('list');
		//-------
		$employees = $inicio + $employees;
		$groups = $inicio + $groups;
		$this->set(compact('employees', 'groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * 
 * Enter description here ...
 */
	public function login() {
		$this->autoRender = false;
	    if ($this->request->is('post')) {
	    	if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('<div class="alert alert-error">'.__('Usuário ou senha incorretos.').'</div>');
	            $this->redirect($this->referer());
	        }
	    }
	}
	
/**
 * 
 * Enter description here ...
 */
	public function logout() {
		// Destruindo a sessão
		if ($this->Session->valid()) {
			$this->Session->destroy(); 
		    $this->Session->setFlash('<div class="alert alert-success">'.__('Adeus').'</div>');
			$this->redirect('/');
		}
	}
}
