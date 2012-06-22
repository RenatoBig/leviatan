<?php
App::uses('AppModel', 'Model');
/**
 * Region Model
 *
 * @property City $City
 * @property Area $Area
 * @property Unity $Unity
 */
class Region extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'City' => array(
			'className' => 'City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
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
		'Unity' => array(
			'className' => 'Unity',
			'foreignKey' => 'region_id',
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
		'city_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma cidade.',
			)			
		),
		'area_id' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio escolher uma área.',
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['Unity'])) {
			return false;
		}		
	}

}
