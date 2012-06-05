<?php
App::uses('AppModel', 'Model');
/**
 * PngcCode Model
 *
 * @property ExpenseGroup $ExpenseGroup
 * @property FunctionalUnit $FunctionalUnit
 * @property Input $Input
 * @property MeasureType $MeasureType
 * @property Item $Item
 */
class PngcCode extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ExpenseGroup' => array(
			'className' => 'ExpenseGroup',
			'foreignKey' => 'expense_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FunctionalUnit' => array(
			'className' => 'FunctionalUnit',
			'foreignKey' => 'functional_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Input' => array(
			'className' => 'Input',
			'foreignKey' => 'input_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MeasureType' => array(
			'className' => 'MeasureType',
			'foreignKey' => 'measure_type_id',
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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'pngc_code_id',
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
