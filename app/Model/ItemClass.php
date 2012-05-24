<?php
App::uses('AppModel', 'Model');
/**
 * ItemClass Model
 *
 * @property ItemGroup $ItemGroup
 */
class ItemClass extends AppModel {
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
		'ItemGroup' => array(
			'className' => 'ItemGroup',
			'foreignKey' => 'item_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
