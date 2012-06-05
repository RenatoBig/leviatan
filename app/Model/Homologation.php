<?php
App::uses('AppModel', 'Model');
/**
 * Homologation Model
 *
 * @property OrderItem $OrderItem
 */
class Homologation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'order_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
