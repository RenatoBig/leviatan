<?php
App::uses('AppModel', 'Model');
/**
 * UnitySector Model
 *
 * @property Unity $Unity
 * @property Sector $Sector
 * @property Employee $Employee
 */
class UnitySector extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Unity' => array(
			'className' => 'Unity',
			'foreignKey' => 'unity_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sector' => array(
			'className' => 'Sector',
			'foreignKey' => 'sector_id',
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
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'unity_sector_id',
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
		'unity_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma unidade.',
			)			
		),
		'sector_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher um setor.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['Employee'])) {
			return false;
		}		
	}
}
