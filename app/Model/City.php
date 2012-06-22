<?php
App::uses('AppModel', 'Model');
/**
 * City Model
 *
 * @property Region $Region
 */
class City extends AppModel {
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
		'Region' => array(
			'className' => 'Region',
			'foreignKey' => 'city_id',
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
				'message'=> 'É obrigátorio o código da cidade.',
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
				'message'=> 'É obrigátorio o nome da cidade.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['Region'])) {
			return false;
		}		
	}

}
