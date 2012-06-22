<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 * @property UnitySector $UnitySector
 * @property User $User
 */
class Employee extends AppModel {
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
		'UnitySector' => array(
			'className' => 'UnitySector',
			'foreignKey' => 'unity_sector_id',
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'employee_id',
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
		'registration' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o número da matrícula.',
			),
			'registrationRule2' => array(
				'rule' => 'numeric',
				'message' => 'Apenas números são permitidos.',				
			),
			'registrationRule3' => array(
				'rule' => array('minLength', 6),
				'message' => 'Número mínimo de caracteres é 6.'
			)
			
		),
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome do funcionário.',
			)
		),
		'Unity' => array(
			'validateUnity' => array(
    			'rule' => 'notEmpty',
    			'message' => 'É obrigatório a escolha de uma unidade.'),
		),
		'unity_sector_id' => array(
			'validateSector' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um setor.'
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
