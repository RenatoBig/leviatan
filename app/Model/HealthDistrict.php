<?php
App::uses('AppModel', 'Model');
/**
 * HealthDistrict Model
 *
 * @property Unity $Unity
 */
class HealthDistrict extends AppModel {
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
		'Unity' => array(
			'className' => 'Unity',
			'foreignKey' => 'health_district_id',
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
