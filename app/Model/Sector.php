<?php
App::uses('AppModel', 'Model');
/**
 * Sector Model
 *
 * @property UnitySector $UnitySector
 */
class Sector extends AppModel {
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
		'UnitySector' => array(
			'className' => 'UnitySector',
			'foreignKey' => 'sector_id',
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
				'message'=> 'É obrigátorio o nome do setor.',
			)			
		)
	);

}
