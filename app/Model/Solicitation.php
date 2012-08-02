<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property User $User
 * @property Status $Status
 * @property SolicitationItem $SolicitationItem
 */
class Solicitation extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
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
		'SolicitationItem' => array(
			'className' => 'SolicitationItem',
			'foreignKey' => 'solicitation_id',
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
 * Enter description here ...
 * @var unknown_type
 */
	var $validate = array(
		'keycode'=>array(
			'keycodeRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório preencher o código.'
			)
		),
		'description'=>array(
				'descriptionRule' => array(
						'rule'=>'notEmpty',
						'message'=>'É obrigatório preencher uma descrição.'
				)
		),
		'user_id'=>array(
			'userRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher um usuário.'
			)
		),
		'status_id'=>array(
			'statusRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório escolher um status.'
			)
		)		
	);

/**
 * (non-PHPdoc)
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() { 
		
		$solicitation = $this->read(null, $this->id);
		if(!empty($solicitation['SolicitationItem'])) {
			return false;
		}
	}

}
