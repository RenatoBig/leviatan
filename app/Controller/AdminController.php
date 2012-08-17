<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AdminController extends AppController {
	
	public $layout = 'leviatan';
	
	
	
/**
 * 
 */
	public function index() {
		
		
		$modules['users'][] = array('name'=>'GRUPOS', 'controller'=>'groups', 'action'=>'index');
		$modules['users'][] = array('name'=>'USUÁRIOS', 'controller'=>'urser', 'action'=>'index');
		$modules['users'][] = array('name'=>'FUNCIONÁRIOS', 'controller'=>'employees', 'action'=>'index'); 
		//-----------------		
		$modules['unities'][] = array('name'=>'UNIDADES_SETORES', 'controller'=>'unity_sectors', 'action'=>'index');
		$modules['unities'][] = array('name'=>'SETORES', 'controller'=>'sectors', 'action'=>'index');
		$modules['unities'][] = array('name'=>'UNIDADES', 'controller'=>'unities', 'action'=>'index');
		$modules['unities'][] = array('name'=>'TIPOS UNIDADES', 'controller'=>'unity_types', 'action'=>'index');
		$modules['unities'][] = array('name'=>'DISTRITOS', 'controller'=>'health_districts', 'action'=>'index');
		$modules['unities'][] = array('name'=>'REGIÕES', 'controller'=>'regions', 'action'=>'index');
		$modules['unities'][] = array('name'=>'CIDADES', 'controller'=>'cities', 'action'=>'index');
		$modules['unities'][] = array('name'=>'ÁREAS', 'controller'=>'areas', 'action'=>'index');
		//-----------------
		
		$this->set(compact('modules'));		
	}
}