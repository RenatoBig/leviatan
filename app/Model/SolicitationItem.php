<?php
App::uses('AppModel', 'Model');
/**
 * SolicitationItem Model
 *
 * @property Solicitation $Solicitation
 * @property Item $Item
 * @property Status $Status
 * @property Homologation $Homologation
 */
class SolicitationItem extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Solicitation' => array(
			'className' => 'Solicitation',
			'foreignKey' => 'solicitation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 * 
 * Enter description here ...
 * @var unknown_type
 */
	var $validate = array(
		'solicitation_id'=>array(
			'keycodeRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher uma solicitação.'
			)
		),
		'item_id'=>array(
			'itemRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher um item.'
			)
		),
		'status_id'=>array(
			'statusRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher um status.'
			)
		),
		'quantity'=>array(
			'quantityRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher uma quantidade.'
			)
		)	
	);
	
/**
 * (non-PHPdoc)
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() { 
		
	//	$solicitationItem = $this->read(null, $this->id);
	//	if(!empty($solicitationItem['Homologation'])) {
	//		return false;
	//	}
	}

}
