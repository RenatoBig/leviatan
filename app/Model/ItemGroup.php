<?php
App::uses('AppModel', 'Model');
/**
 * ItemGroup Model
 *
 * @property GroupType $GroupType
 */
class ItemGroup extends AppModel {
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
		'GroupType' => array(
			'className' => 'GroupType',
			'foreignKey' => 'group_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
