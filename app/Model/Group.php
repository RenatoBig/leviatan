<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 */
class Group extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
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
	
	public $actsAs = array('Acl' => array('type' => 'requester'));

/**
 * 
 * Enter description here ...
 */
    public function parentNode() {
        return null;
    }
    
    /**
	 * 
	 * Validação dos campos
	 * @var unknown_type
	 */
	var $validate = array(
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome do grupo.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['User'])) {
			return false;
		}		
	}

}
