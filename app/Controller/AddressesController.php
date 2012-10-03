<?php
App::uses('AppController', 'Controller');
/**
 * Areas Controller
 *
 * @property Area $Area
 */
class AddressesController extends AppController {

	public $layout = 'leviatan';
	
	
/**
 * 
 * @param unknown_type $id
 */
	public function view($id = null) {
		
		$this->Address->id = $id;
		if (!$this->Address->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Address->recursive = -1;
		
		$op['conditions'] = array('Address.id'=>$id);
		$op['fields'] = array('Address.*', 'District.*', 'City.*', 'State.*');
		$op['joins'] = array(
			array(
				'table'=>'districts',
				'alias'=>'District',
				'type'=>'inner',
				'conditions'=>array(
					'Address.district_id = District.id'	
				)
			),	
			array(
				'table'=>'cities',
				'alias'=>'City',
				'type'=>'inner',
				'conditions'=>array(
					'District.city_id = City.id'
				)
			),
			array(
				'table'=>'states',
				'alias'=>'State',
				'type'=>'inner',
				'conditions'=>array(
					'City.state_id = State.id'
				)
			)
		);
		
		$address = $this->Address->find('first', $op);

		$this->set(compact('address'));
	}
	
	
}