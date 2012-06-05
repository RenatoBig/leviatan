<?php
App::uses('AppModel', 'Model');
/**
 * UnitySector Model
 *
 * @property Unity $Unity
 * @property Sector $Sector
 * @property Employee $Employee
 */
class UnitySector extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Unity' => array(
			'className' => 'Unity',
			'foreignKey' => 'unity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sector' => array(
			'className' => 'Sector',
			'foreignKey' => 'sector_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'unity_sector_id',
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

}
