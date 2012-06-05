<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
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
				$this->Session->setFlash(__('O usuário foi cadastrado com sucesso.'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('O usuário não pode ser cadastrado. Por favor tente novamente.'));
			}
		}
		$employees = $this->User->Employee->find('list');
		$groups = $this->User->Group->find('list');
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
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * (non-PHPdoc)
 * @see lib/Cake/Controller/Controller::beforeFilter()
 */
	public function beforeFilter() {
    	parent::beforeFilter();
    	$this->Auth->allow('*');
	}
	
/**
 * 
 * Enter description here ...
 */
	public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());
	        } else {
	            $this->Session->setFlash('Your username or password was incorrect.');
	        }
	    }
	}
	
/**
 * 
 * Enter description here ...
 */
	public function logout() {
	    //Leave empty for now.
	    $this->Session->setFlash('Good-Bye');
		$this->redirect($this->Auth->logout());
	}
}
