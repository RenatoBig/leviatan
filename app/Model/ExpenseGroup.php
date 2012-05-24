<?php
App::uses('AppModel', 'Model');
/**
 * ExpenseGroup Model
 *
 * @property PngcCode $PngcCode
 */
class ExpenseGroup extends AppModel {
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
			'foreignKey' => 'expense_group_id',
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
