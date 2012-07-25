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
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session'
    );
    public $helpers = array('Html', 'Form', 'Session', 'Js');
    public $uses = array('User', 'Employee', 'CartItem', 'SolicitationItem');

    public function beforeFilter() {
    	    	
        //Configure AuthComponent
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'display');

        $u = $this->Auth->user();
        if($u != null) {
        	$user = $this->User->read(null, $u['id']);
        	
        	$this->set(compact('user'));
        }
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
    protected function __getSolicitationItems() {
    	$user_id = $this->Auth->user('id');
    
    	$options['conditions'] = array(
    			'Solicitation.user_id'=>$user_id,
    			'OR'=>array(
    					array('SolicitationItem.status_id'=>PENDENTE),
    					array('SolicitationItem.status_id'=>APROVADO),
    					array('SolicitationItem.status_id'=>HOMOLOGADO)
    			)
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
	
}
