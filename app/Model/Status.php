<?php
App::uses('AppModel', 'Model');
/**
 * Status Model
 *
 * @property OrderItem $OrderItem
 * @property Order $Order
 */
class Status extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SolicitationItem' => array(
			'className' => 'SolicitationItem',
			'foreignKey' => 'status_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Solicitation' => array(
			'className' => 'Solicitation',
			'foreignKey' => 'status_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
/**
 * 
 * Validação dos campos
 * @var unknown_type
 */
	var $validate = array(
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome do status.',
			)			
		)
	);
	
/**
 * (non-PHPdoc)
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$status = $this->read(null, $this->id);
		if(!empty($status['Solicitation']) || !empty($status['SolicitationItem'])) {
			return false;
		}	
	}

}
