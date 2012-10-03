<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers/')
            )
        ),
        'Session',
		'RequestHandler'
    );
    public $helpers = array('Html', 'Form', 'Session', 'Js');
    public $uses = array(
    		'User', 'Group', 'Employee', 'UnitySector', 'Sector', 'Unity',
    		'UnityType', 'HealthDistrict', 'Region', 'City', 'Area', 
    		'CartItem', 'Solicitation', 'SolicitationItem', 'Order', 'OrderItem'
    	);

    public function beforeFilter() {
    	    	
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'home');
        // Mensagens de erro
        $this->Auth->loginError = '<div class="alert alert-error">'.__('Usuário e/ou senha incorreto(s)', true).'</div>';
        $this->Auth->authError = '<div class="alert alert-error">'.__('Você precisa fazer login ou não tem autorização para acessar esta página', true).'</div>';
        
        $u = $this->Auth->user();
        if($u != null) {
        	$user = $this->User->read(null, $u['id']);        	
        	$this->set(compact('user'));
        }
        
        $menus = $this->__getMenus();
        $countSolicitations = $this->__getCountPendingSolicitations();
        $countCartItems = $this->__getCountCartItems();
        
        $this->set(compact('menus', 'countSolicitations', 'countCartItems'));
    }
    
/**
 * retorna os dados da tabela passada como parâmetro
 */
    protected function __getTable($model, $id) {
    	
    	$this->$model->recursive = -1;
    	$table = $this->$model->read(null, $id);
    	
    	return $table;
    }    
    
/**
 *
 */
    private function __getMenus() {
    	
    	if($this->Auth->user() == null) {
    		$menus[] = array('name'=>'Itens', 'link'=>array('controller'=>'pages', 'action'=>'home'));
    	}else {
    		if($this->Auth->user('group_id') == ADMIN) {
    			$menus[] = array('name'=>'Área administrativa', 'link'=>array('controller'=>'manager', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == DIRETOR) {
    			$menus[] = array('name'=>'Minhas solicitações', 'link'=>array('controller'=>'solicitations', 'action'=>'index'));
    			$menus[] = array('name'=>'Fazer solicitação', 'link'=>array('controller'=>'solicitation_items', 'action'=>'index'));
    			$menus[] = array('name'=>'Meu carrinho', 'link'=>array('controller'=>'cart_items', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == HOMOLOGADOR) {
    			$menus[] = array('name'=>'Itens', 'link'=>array('controller'=>'items', 'action'=>'index'));
    			$menus[] = array('name'=>'Adicionar item', 'link'=>array('controller'=>'items', 'action'=>'add'));
    			$menus[] = array('name'=>'Solicitações pendentes', 'link'=>array('controller'=>'solicitations', 'action'=>'all'));
    			$menus[] = array('name'=>'Pedidos', 'link'=>array('controller'=>'orders', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == CADASTRADOR) {
    			$menus[] = array('name'=>'Itens', 'link'=>array('controller'=>'items', 'action'=>'index'));
    			$menus[] = array('name'=>'Adicionar Itens', 'link'=>array('controller'=>'items', 'action'=>'add'));
    		}
    		
    		if($this->Auth->user('group_id') == GERENCIADOR) {
    		    $menus[] = array('name'=>'Usuários', 'link'=>array('controller'=>'users', 'action'=>'index'));			
    		}
    		
    	}
    
    	return $menus;
    }
    
/**
 * 
 */
    private function __getCountPendingSolicitations() {
    	
    	$options['conditions'] = array(
    		'Solicitation.status_id'=>PENDENTE,
    	);    	
    	
    	if($this->Auth->user('group_id') == ADMIN) {
    		$pending = $this->Solicitation->find('count', $options);
    	}else {
    		$pending = 0;
    	}

    	return $pending;
    }
    
/**
 * 
 */
    private function __getCountCartItems() {
    	
    	$options['conditions'] = array(
    		'CartItem.user_id'=>$this->Auth->user('id')
    	);
    	
    	$pending = $this->CartItem->find('count', $options);
    	
    	return $pending;
    }
    
/**
 * 
 */
    protected function __getMessage($type) {
    	
    	$value = '';
    	
    	switch($type){
    		case SUCCESS:
    			$value = $this->Session->setFlash(__("Operação realizada com sucesso"), 'default', array('class'=>'alert alert-success'));
    			break;
    		case ERROR:
    			$value = $this->Session->setFlash(__('Operação não realizada. Favor entrar em contato com o administrador do sistema'), 'default', array('class'=>'alert alert-error'));
    			break; 
    		case ERROR_DELETE:
    			$value = $this->Session->setFlash(__('Operação não realizada. Provavelmente o registro está associado a outra tabela'), 'default', array('class'=>'alert alert-error'));
    			break;
    		case INVALID_RECORD:
    			$value = $this->Session->setFlash(__('Registro inválido'), 'default', array('class'=>'alert alert-error'));
    			break;
    		case BAD_REQUEST:
    			$value = $this->Session->setFlash(__('Requisição inválida.'), 'default', array('class'=>'alert alert-error'));
    			break;    		
    	}
    	
    	return $value;
    }
    
/**
 * Função usada para povoar os selects das tabelas integradoras
 * Input, Region, UnitySector
 */
    protected function get_children($model_integrator, $model_parent, $model_child, $values) {
    	$this->autoRender = false;
    	if($this->request->is('ajax')) {
    		$ids = explode(',', $values);
    		$id_parent = $ids[0];
    		unset($ids[0]);
    		$id_children = $ids;
    		
    		$table_child = Inflector::tableize($model_child);
    		$table_parent = Inflector::tableize($model_parent);
    		$table_integrator = Inflector::tableize($model_integrator);
    		$field_child_id = Inflector::singularize($table_child).'_id';
    		$field_parent_id = Inflector::singularize($table_parent).'_id';
    
    		$query = 'SELECT `'.$model_child.'`.`id`, '.$model_child.'.`name`
							    		FROM `'.$table_child.'` AS `'.$model_child.'`
							    		WHERE NOT EXISTS (
								    		SELECT `'.$model_integrator.'`.`'.$field_child_id.'`
								    		FROM `'.$table_integrator.'` AS `'.$model_integrator.'`
								    		WHERE `'.$model_child.'`.`id`=`'.$model_integrator.'`.`'.$field_child_id.'` AND `'.$model_integrator.'`.`'.$field_parent_id.'`='.$id_parent.')
							    		ORDER BY `'.$model_child.'`.`name`';
    		$data = $this->$model_child->query($query);
    		
    		foreach($data as $value):
    			$children[$value[$model_child]['id']] = $value[$model_child]['name'];
    		endforeach;
    
    		foreach($id_children as $id):
    			unset($children[$id]);
    		endforeach;
    		
    		echo json_encode($children);
    	}
    }
    
/**
 * Função que verifica se os valores dos selects não estão cadastrados ou são iguais
 */
    protected function checkEntries($model_integrator, $model_parent, $model_child, $values) {
    	$this->autoRender = false;
    	if($this->request->is('ajax')) {
    			
    		$ids = explode(',', $values);
    		$id_parent = $ids[0];
    		unset($ids[0]);
    		$id_children = $ids;
    			
    		$result = array_unique($id_children);
    			
    		if(count($id_children) != count($result)) {
    			echo '0';
    			return;
    		}
    		
    		$table_child = Inflector::tableize($model_child);
    		$table_parent = Inflector::tableize($model_parent);
    		$table_integrator = Inflector::tableize($model_integrator);
    		$field_child_id = Inflector::singularize($table_child).'_id';
    		$field_parent_id = Inflector::singularize($table_parent).'_id';
    			
    		$exist = false;
    		$this->$model_integrator->recursive = -1;
    			
    		foreach($ids as $value):
	    		$op['conditions'] = array(
    				$model_integrator.'.'.$field_parent_id=>$id_parent,
    				$model_integrator.'.'.$field_child_id=>$value
	    		);
	    		$register = $this->$model_integrator->find('first', $op);
	    		if($register) {
	    			$exist = true;
	    			break;
	    		}
    		endforeach;
    			
    		if($exist) {
    			echo '-1';
    		}else {
    			echo '1';
    		}
    	}
    }
    
}
