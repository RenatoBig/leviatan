<?php
App::uses('AppModel', 'Model');
/**
 * InputCategory Model
 *
 * @property Input $Input
 */
class InputCategory extends AppModel {
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
		'Input' => array(
			'className' => 'Input',
			'foreignKey' => 'input_category_id',
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
		/*'namekeycode' => array(
			'registrationRule1' => array(
					'rule' => 'notEmpty',
					'message'=> 'É obrigátorio um código para a categoria.',
			)
		),*/
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio um nome para a categoria.',
			)
		),
		'description' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio uma descrição para a categoria.',
			)
		)		
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['Input'])) {
			return false;
		}		
	}

}
