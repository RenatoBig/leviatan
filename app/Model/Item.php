<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property ItemClass $ItemClass
 * @property PngcCode $PngcCode
 * @property OrderItem $OrderItem
 */
class Item extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ItemClass' => array(
			'className' => 'ItemClass',
			'foreignKey' => 'item_class_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PngcCode' => array(
			'className' => 'PngcCode',
			'foreignKey' => 'pngc_code_id',
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
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'item_id',
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
		'item_class_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma classe do item.',
			)
		),
		'pngc_code_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher um código PNGC.',
			)
		),
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio informar um nome para o item.',
			)
		),
		'description' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio informar uma descrição para o item.',
			)
		)		
	);
	

}
