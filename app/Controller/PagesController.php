<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 */
	public $helpers = array('Html', 'Session');
	public $elements = array();

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Item', 'ItemGroup');
	
	
/**
 * (non-PHPdoc)
 * @see AppController::beforeFilter()
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('home', 'autocomplete'));
	}

/** 
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
/**
 * 
 */
	public function home() {
		if($this->request->is('ajax')) {
			if($this->request->data) {
				$item_class_id = $this->request->data['item_class_id'];
				$item_name = $this->request->data['item_name'];
				
				$options = array();
				if($item_class_id != '') {
					$options['conditions'][] = array('Item.item_class_id'=>$item_class_id);
				}
				if($item_name != '') {
					$options['conditions'][] = array('Item.name'=>$item_name);
				}
				$this->Session->write('options', $options);
			}
		}
		if($this->request->is('ajax') && $this->Session->read('options')) {
			$options = $this->Session->read('options');
		}else {
			$this->Session->delete('options');
		}

		$options['conditions'][] = array(
			'Item.status_id'=>ATIVO
		);
		$options['limit'] = 10;
		$options['order'] = array(
			'Item.item_class_id'=>'asc'
		);

		$this->paginate = $options;
		$items = $this->paginate('Item');
		
		$groups = $this->__getItemGroups();
		
		$this->set(compact('items', 'groups'));		

		if($this->Auth->user() == null) {
			$this->layout = 'login';
		}else {
			$this->layout = 'leviatan';
		}
		
		if($this->request->is('ajax')) {
			$this->render('ajax', 'ajax');
		}
	}
	
/**
 * 
 */
	public function autocomplete() {
		
		if($this->request->is('ajax')) {
			
			$item_class_id = $this->request->data['item_class_id'];
			$limit = $this->request->data['limit'];
			$item_name = $this->request->data['term'];
			
			if($item_class_id == '') {
				$options['conditions'] = array(
					'Item.name LIKE' => '%'.$item_name.'%',
				);
			}else {
				$options['conditions'] = array(
					'Item.name LIKE' => '%'.$item_name.'%',
					'Item.item_class_id'=>$item_class_id
				);
			}
			
			
			$options['limit'] = $limit;
			
			$data = $this->Item->find('all', $options);
				
			$response = array();
			foreach($data as $i=>$value) {
				$response[$i]= array('label'=>$value['Item']['name']);
			}

			echo json_encode($response);
			exit;
		}
	}
	
	
/**
 * 
 */
	private function __getItemGroups() {
		
		$q_groups = 'SELECT * FROM `item_groups` AS `ItemGroup`
						WHERE `ItemGroup`.`id` IN
							(SELECT `ItemClass`.`item_group_id`
								FROM `item_classes` AS `ItemClass`
								WHERE `ItemClass`.`id` IN
									(SELECT DISTINCT `Item`.`item_class_id` FROM `items` AS `Item`)
							)
		';
		$groups = $this->ItemGroup->query($q_groups);
		
		foreach($groups as $group):
			$values[$group['ItemGroup']['id']] = $group['ItemGroup']['keycode'].' - '.$group['ItemGroup']['name'];
		endforeach;
		$groups = array(''=>'Selecione um grupo') + $values;
		
		return $groups;
	}

}
