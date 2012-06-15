<?php
App::uses('AppModel', 'Model');
/**
 * Input Model
 *
 * @property InputCategory $InputCategory
 * @property InputSubcategory $InputSubcategory
 * @property PngcCode $PngcCode
 */
class Input extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'InputCategory' => array(
			'className' => 'InputCategory',
			'foreignKey' => 'input_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InputSubcategory' => array(
			'className' => 'InputSubcategory',
			'foreignKey' => 'input_subcategory_id',
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
		'PngcCode' => array(
			'className' => 'PngcCode',
			'foreignKey' => 'input_id',
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
		'input_category_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma categoria.',
			)
		),
		'input_subcategory_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma subcategoria.',
			)
		)		
	);

}
