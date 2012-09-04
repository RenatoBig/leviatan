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
 * Gera seis números aleatórios seguido de /ano corrente
 */
    protected function __getRandomKeycode() {
    
    	$i = 0;
    	$random = '';
    	while($i < 3) {
    		$random .= rand(10, 99);
    		$i++;
    	}
    
    	$random = $random.'/'.date('y');
    
    	return $random;
    }
    
/**
 * Itens que estão no carrinho do usuário atual
 */
    protected function __getCartItems() {
    
    	$user_id = $this->Auth->user('id');
    
    	$options['conditions'] = array(
    			'CartItem.user_id'=>$user_id
    	);
    	$options['fields'] = array(
    			'CartItem.item_id'
    	);
    	$cart_items = $this->CartItem->find('list', $options);
    
    	$idItems = array();
    	foreach($cart_items as $item):
    		$idItems[] = $item;
    	endforeach;
    
    	return $idItems;
    }
    
/**
 * Itens que estão em algum processo de pendência
 */
    protected function __getSolicitationItems($status=null) {
    	$user_id = $this->Auth->user('id');
    
    	$options['conditions'] = array(
    			'Solicitation.user_id'=>$user_id,
    			'Solicitation.status_id'=>PENDENTE
    	);
    	
    	$options['fields'] = array(
    			'SolicitationItem.item_id',
    	);
    
    	$solicitationItems = $this->SolicitationItem->find('all', $options);

    	$items = array();
    	foreach($solicitationItems as $value):
    		$items[] = $value['SolicitationItem']['item_id'];
    	endforeach;
    
    	return $items;
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
    			$menus[] = array('name'=>'Área administrativa', 'link'=>array('controller'=>'admin', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == DIRETOR || $this->Auth->user('group_id') == ADMIN) {
    			$menus[] = array('name'=>'Minhas solicitações', 'link'=>array('controller'=>'solicitations', 'action'=>'index'));
    			$menus[] = array('name'=>'Fazer solicitação', 'link'=>array('controller'=>'solicitation_items', 'action'=>'index'));
    			$menus[] = array('name'=>'Meu carrinho', 'link'=>array('controller'=>'cart_items', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == HOMOLOGADOR || $this->Auth->user('group_id') == ADMIN) {
    			$menus[] = array('name'=>'Itens', 'link'=>array('controller'=>'items', 'action'=>'index'));
    			$menus[] = array('name'=>'Adicionar item', 'link'=>array('controller'=>'items', 'action'=>'add'));
    			$menus[] = array('name'=>'Solicitações pendentes', 'link'=>array('controller'=>'solicitations', 'action'=>'all'));
    			$menus[] = array('name'=>'Pedidos', 'link'=>array('controller'=>'orders', 'action'=>'index'));
    		}
    		
    		if($this->Auth->user('group_id') == CADASTRADOR || $this->Auth->user('group_id') == ADMIN) {
    			$menus[] = array('name'=>'Itens', 'link'=>array('controller'=>'items', 'action'=>'index'));
    			$menus[] = array('name'=>'Adicionar Itens', 'link'=>array('controller'=>'items', 'action'=>'add'));
    		}
    		
    		if($this->Auth->user('group_id') == GERENCIADOR || $this->Auth->user('group_id') == ADMIN) {
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
    
}
