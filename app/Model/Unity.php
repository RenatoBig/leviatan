<?php
App::uses('AppModel', 'Model');
/**
 * Unity Model
 *
 * @property Region $Region
 * @property HealthDistrict $HealthDistrict
 * @property UnityType $UnityType
 * @property UnitySector $UnitySector
 */
class Unity extends AppModel {
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
		'Address' => array(
			'className' => 'Address',
			'foreignKey' => 'address_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HealthDistrict' => array(
			'className' => 'HealthDistrict',
			'foreignKey' => 'health_district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'UnityType' => array(
			'className' => 'UnityType',
			'foreignKey' => 'unity_type_id',
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
		'UnitySector' => array(
			'className' => 'UnitySector',
			'foreignKey' => 'unity_id',
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
		'cnes' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o número da CNES.',
			)			
		),
		'cnpj' => array(
			'registrationRule1' => array(
				'rule' => 'notEmpty',
				'message'=> 'É obrigátorio o número do CNPJ.',
			)
		),
		'name' => array(
			'validateUnity' => array(
    			'rule' => 'notEmpty',
    			'message' => 'É obrigatório o nome da unidade.'),
		),		
		'cep' => array(
			'validateCEP' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um cep.'
			)
		),
		'state' => array(
			'validateState' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um estado.'
			)
		),
			'city' => array(
					'validateCity' => array(
							'rule' => 'notEmpty',
							'message' => 'É obrigatório a escolha de um cidade.'
					)
			),
			'district' => array(
					'validateDistrict' => array(
							'rule' => 'notEmpty',
							'message' => 'É obrigatório a escolha de um bairro.'
					)
			),
			'address' => array(
					'validateAddress' => array(
							'rule' => 'notEmpty',
							'message' => 'É obrigatório a escolha de um endereço.'
					)
			),
		'address_id' => array(
			'validateAddress' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um cep.'
			)
		),
		'health_district_id' => array(
			'validateHealthDistrict' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um distrito sanitário.'
			)
		),
		'unity_type_id' => array(
			'validateUnityType' => array(
				'rule' => 'notEmpty',
				'message' => 'É obrigatório a escolha de um tipo da unidade.'
			)
		)
	);
	
/**
 * Função chamada antes de deletar o registro
 * @see lib/Cake/Model/Model::beforeDelete()
 */
	public function beforeDelete() {
		$register = $this->read(null, $this->id);
		if(!empty($register['UnitySector'])) {
			return false;
		}		
	}

}
