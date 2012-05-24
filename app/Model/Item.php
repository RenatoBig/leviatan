<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property ItemClass $ItemClass
 * @property PngcCode $PngcCode
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
}
