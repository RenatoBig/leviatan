<?php
App::uses('AppModel', 'Model');
/**
 * Order Model
 *
 * @property User $User
 * @property Status $Status
 * @property OrderItem $OrderItem
 */
class Order extends AppModel {

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
		'OrderItem' => array(
			'className' => 'OrderItem',
			'foreignKey' => 'order_id',
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
		),
		'start_date'=>array(
			'stardateRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório preencher a data inicial.'
			)
		),
		'end_date'=>array(
			'stardateRule' => array(
				'rule'=>'notEmpty',
				'message'=>'É obrigatório preencher a data final.'
			)
		)		
	);

/**
 * (non-PHPdoc)
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() { 
		
		$order = $this->read(null, $this->id);
		if(!empty($order['OrderItem'])) {
			return false;
		}
	}
	
/**
 * (non-PHPdoc)
 * @see lib/Cake/Model/Model::beforeSave()
 */
	public function beforeSave($options) {
		$dataInicial = $this->data['Order']['start_date'];
		$dataFinal = $this->data['Order']['end_date'];
		$hora = date('H:i:s');
		
		$dI = explode("/", $dataInicial);
		$dF = explode("/", $dataFinal);
		
		$dataInicial = $dI[2].'-'.$dI[1].'-'.$dI[0];
		$dataFinal = $dF[2].'-'.$dF[1].'-'.$dF[0];
		
		$this->data['Order']['start_date'] = $dataInicial;
		$this->data['Order']['end_date'] = $dataFinal;
	}

}
