<?php
App::uses('AppModel', 'Model');
/**
 * FunctionalUnit Model
 *
 * @property PngcCode $PngcCode
 */
class FunctionalUnit extends AppModel {
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
		'PngcCode' => array(
			'className' => 'PngcCode',
			'foreignKey' => 'functional_unit_id',
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
		'keycode' => array(
				'registrationRule1' => array(
						'rule' => 'notEmpty',
						'message'=> 'É obrigátorio o código da unidade funcional.',
				)
		),
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome da unidade funcional.',
			)
		),
		'description' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio a descrição da unidade funcional.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['PngcCode'])) {
			return false;
		}		
	}

}
