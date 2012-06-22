<?php
App::uses('AppModel', 'Model');
/**
 * GroupType Model
 *
 * @property ItemGroup $ItemGroup
 */
class GroupType extends AppModel {
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
		'ItemGroup' => array(
			'className' => 'ItemGroup',
			'foreignKey' => 'group_type_id',
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
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome do tipo do grupo.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['ItemGroup'])) {
			return false;
		}		
	}

}
