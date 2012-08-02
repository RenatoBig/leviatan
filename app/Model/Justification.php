<?php
App::uses('AppModel', 'Model');
/**
 * Justification Model
 *
 * @property SolicitationItem $SolicitationItem
 */
class Justification extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SolicitationItem' => array(
			'className' => 'SolicitationItem',
			'foreignKey' => 'solicitation_item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
