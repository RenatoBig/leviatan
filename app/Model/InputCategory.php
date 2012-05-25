<?php
App::uses('AppModel', 'Model');
/**
 * InputCategory Model
 *
 * @property InputSubcategory $InputSubcategory
 * @property PngcCode $PngcCode
 */
class InputCategory extends AppModel {
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
		'InputSubcategory' => array(
			'className' => 'InputSubcategory',
			'foreignKey' => 'input_category_id',
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
		'PngcCode' => array(
			'className' => 'PngcCode',
			'foreignKey' => 'input_category_id',
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
