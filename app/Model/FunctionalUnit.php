<?php
App::uses('AppModel', 'Model');
/**
 * FunctionalUnit Model
 *
 * @property PngcCode $PngcCode
 */
class FunctionalUnit extends AppModel {
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
		'PngcCode' => array(
			'className' => 'PngcCode',
			'foreignKey' => 'functional_unit_id',
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
