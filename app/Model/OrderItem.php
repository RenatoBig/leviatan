<?php
App::uses('AppModel', 'Model');
/**
 * OrderItem Model
 *
 * @property Order $Order
 * @property SolicitationItem $SolicitationItem
 */
class OrderItem extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'order_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SolicitationItem' => array(
			'className' => 'SolicitationItem',
			'foreignKey' => 'solicitation_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
