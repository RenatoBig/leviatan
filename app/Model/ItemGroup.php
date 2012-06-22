<?php
App::uses('AppModel', 'Model');
/**
 * ItemGroup Model
 *
 * @property GroupType $GroupType
 * @property ItemClass $ItemClass
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ItemClass' => array(
			'className' => 'ItemClass',
			'foreignKey' => 'item_group_id',
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
		'group_type_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher um tipo do grupo.',
			)
		),
		'keycode' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio informar um código.',
			)
		),
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio informar um nome.',
			)
		)		
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['ItemClass'])) {
			return false;
		}		
	}

}
