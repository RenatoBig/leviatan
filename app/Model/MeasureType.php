<?php
App::uses('AppModel', 'Model');
/**
 * MeasureType Model
 *
 * @property PngcCode $PngcCode
 */
class MeasureType extends AppModel {
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
			'foreignKey' => 'measure_type_id',
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
	/*	'keycode' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
					'message'=> 'É obrigátorio o código do tipo de medidas.',
			)
		),*/
		'name' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o nome do tipo de medidas.',
			)
		),
		'description' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio a descrição do tipo de medida.',
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
