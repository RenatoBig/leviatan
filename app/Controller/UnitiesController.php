<?php
App::uses('AppController', 'Controller');
/**
 * Unities Controller
 *
 * @property Unity $Unity
 */
class UnitiesController extends AppController {
	
	public $layout = 'leviatan';
	public $uses = array('Unity', 'Region', 'City', 'Address', 'District' ,'State');
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Unity->recursive = 0;
		
		$options['order'] = array('Unity.name'=>'asc');
		$options['limit'] = 10;
		
		$this->paginate = $options;
		
		$this->set('unities', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Unity->recursive = 0;
		$unity = $this->Unity->read(null, $id);

		$this->set(compact('unity'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {			
			
			$data['response'] = $this->request->data['Unity']['cod_response'];
			$data['cep'] = $this->request->data['Unity']['cep'];
			$data['address'] = $this->request->data['Unity']['address'];
			$data['district'] = $this->request->data['Unity']['district'];
			$data['city'] = $this->request->data['Unity']['city'];
			if(isset($this->request->data['Unity']['state'])) {
				$data['state'] = $this->request->data['Unity']['state'];
			}else {
				$data['state'] = $this->request->data['Unity']['state_hidden'];
			} 
						
			$address_id = $this->__checkAddress($data);			
			$this->request->data['Unity']['address_id'] = $address_id;
			
			$this->Unity->create();
			if ($this->Unity->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
			} else {
				$this->__getMessage(ERROR);
			}
			$this->redirect(array('controller'=>'unity_sectors', 'action' => 'add'));
		}
		
		if($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}
		
		$states = array(''=>'') + $this->State->find('list', array('fields'=>array('State.uf', 'State.name')));
		$inicio = array(''=>'Selecione um item');		
		$healthDistricts = $this->Unity->HealthDistrict->find('list');
		$unityTypes = $this->Unity->UnityType->find('list');
		//---------------
		$healthDistricts = $inicio + $healthDistricts;
		$unityTypes = $inicio + $unityTypes;
		$this->set(compact('states', 'healthDistricts', 'unityTypes'));
	}
	
/**
 * Função que verifica se já existe o endereço cadastrado no banco de dados
 * Se existir retorna o id do endereço, caso não exista salva no banco de dados e retorna o id
 */
	private function __checkAddress($data) {
		
		$address_id = -1;
		//id do estado
		$opState['conditions'] = array('State.uf'=>$data['state']);
		$state_id = $this->__getModelId('State', $opState);
		//id da cidade ou false
		$opCity['conditions'] = array('City.name'=>$data['city']);
		$city_id = $this->__getModelId('City', $opCity);
		//id do bairro ou false
		$opDistrict['conditions'] = array('District.name'=>$data['district']);
		$district_id = $this->__getModelId('District', $opDistrict);
		//id do endereço ou false
		$opAddress['conditions'] = array('Address.name'=>$data['address']);
		$address_id = $this->__getModelId('Address', $opAddress);
					
		if($data['response'] == 0 || $data['response'] == 1 || $data['response'] == 2) {
			
			if(!$address_id) {
				if(!$city_id) {
					$dataCity['City']['state_id'] = $state_id;
					$dataCity['City']['name'] = $data['city'];
					$city_id = $this->__saveModel('City', $dataCity);
				}
				
				if(!$district_id) {
					$dataDistrict['District']['city_id'] = $city_id;
					$dataDistrict['District']['name'] = $data['district'];
					$district_id = $this->__saveModel('District', $dataDistrict);
				}
				
				$dataAddress['Address']['district_id'] = $district_id;
				$dataAddress['Address']['postal_code'] = $data['cep'];
				$dataAddress['Address']['name'] = $data['address'];
				$address_id = $this->__saveModel('Address', $dataAddress);
			}
			
		}else if($data['response'] == 3) {
			$this->Address->recursive = -1;
			$op['fields'] = array('Address.id');
			$op['conditions'] = array('Address.postal_code'=>$data['cep']);
			$address = $this->Address->find('first', $op);
			
			$address_id = $address['Address']['id'];			
		}
		
		return $address_id;
	}
	
/**
 * Verifica se existe o registro no modelo e opções passadas como parâmetros
 * @param string $model
 * @param array $options
 * 
 * @return id do registro no banco de dados ou false
 */
	private function __getModelId($model, $options) {
		$this->$model->recursive = -1;
	
		$options['fields'] = array($model.'.id');
		$data = $this->$model->find('first', $options);
	
		if($model) {
			$model_id = $data[$model]['id'];
		}else {
			$model_id = false;
		}
	
		return $model_id;
	}
	
/**
 * Salva o model e retorna o id do registro
 * @param string $model
 * @param array $data
 * 
 * @return id do registro salvo ou false
 */
	private function __saveModel($model, $data) {
		
		$model_id = -1;
		
		$this->$model->create();
		if($this->$model->save($data)) {
			$model_id = $this->$model->id;
		}else {
			$model_id = false;
		}
		
		return $model_id;
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			
			if($this->request->data['Unity']['cod_response'] != '') {
				$data['response'] = $this->request->data['Unity']['cod_response'];
				$data['cep'] = $this->request->data['Unity']['cep'];
				$data['address'] = $this->request->data['Unity']['address'];
				$data['district'] = $this->request->data['Unity']['district'];
				$data['city'] = $this->request->data['Unity']['city'];
				if(isset($this->request->data['Unity']['state'])) {
					$data['state'] = $this->request->data['Unity']['state'];
				}else {
					$data['state'] = $this->request->data['Unity']['state_hidden'];
				}
				
				$address_id = $this->__checkAddress($data);
				$this->request->data['Unity']['address_id'] = $address_id;
			}else {
				$this->request->data['Unity']['address_id'] = $this->request->data['Unity']['address_hidden'];
			}
			
			if ($this->Unity->save($this->request->data)) {
				$this->__getMessage(SUCCESS);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->__getMessage(ERROR);
			}
		} else {
			//$this->request->data = $this->Unity->read(null, $id);
			$this->__getInformationEdit($id);
		}
		
	}
	
/**
 * 
 * Recupera informações para popular o formulário de edição de uma unidade
 * 
 */
	private function __getInformationEdit($id) {
		
		
		$this->Unity->recursive = -1;
		
		$options['fields'] = array('Unity.*', 'HealthDistrict.*', 'UnityType.*', 'Address.*', 'District.*', 'City.*', 'State.*');
		$options['joins'] = array(
			array(
				'table'=>'health_districts',
				'alias'=>'HealthDistrict',
				'type'=>'inner',
				'conditions'=>array(
					'Unity.health_district_id = HealthDistrict.id'		
				)
			),
			array(
				'table'=>'unity_types',
				'alias'=>'UnityType',
				'type'=>'inner',
				'conditions'=>array(
					'Unity.unity_type_id = UnityType.id'
				)
			),
			array(
				'table'=>'addresses',
				'alias'=>'Address',
				'type'=>'inner',
				'conditions'=>array(
					'Unity.address_id = Address.id'
				)
			),
			array(
				'table'=>'districts',
				'alias'=>'District',
				'type'=>'inner',
				'conditions'=>array(
					'Address.district_id = District.id'
				)
			),
			array(
				'table'=>'cities',
				'alias'=>'City',
				'type'=>'inner',
				'conditions'=>array(
					'District.city_id= City.id'
				)
			),
			array(
				'table'=>'states',
				'alias'=>'State',
				'type'=>'inner',
				'conditions'=>array(
					'City.state_id = State.id'
				)
			)
		);
		$options['conditions'] =array(
			'Unity.id'=>$id	
		);
		
		$inicio = array(''=>'Selecione um item');
		$this->request->data = $this->Unity->find('first', $options);
		$unity_types = $inicio + $this->UnityType->find('list');
		$health_districts = $inicio + $this->HealthDistrict->find('list');
		$states = $inicio + $this->State->find('list', array('fields'=>array('State.uf', 'State.name')));
		
		$this->set(compact('unity_types', 'health_districts', 'states'));		
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			$this->__getMessage(BAD_REQUEST);
			$this->redirect(array('action'=>'index'));
		}
		$this->Unity->id = $id;
		if (!$this->Unity->exists()) {
			$this->__getMessage(INVALID_RECORD);
			$this->redirect(array('action'=>'index'));
		}
		
		if ($this->Unity->delete()) {
			$this->__getMessage(SUCCESS);
		}else {
			$this->__getMessage(ERROR_DELETE);
		}
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * Procura pelo cep no banco de dados, caso não exista faz a busca no webservice
 */
	public function search_cep() {
		$this->autoRender = false;
		if($this->request->is('ajax')) {
			
			$cep = $this->request->data['cep'];
			//procura no banco de dados
			$result = $this->search_database($cep);
			//Se não estiver no banco de dados, procura no webservice
			if($result['response'] == 0) {
				$result = $this->search_webservice($cep);
			}
			
			echo json_encode($result);
			exit;
		}
	}
	
/**
 * Busca cep no banco de dados
 * @param unknown_type $cep
 */
	private function search_database($cep) {
		
		$this->Address->recursive = -1;
		$options['joins'] = array(				
			array(
				'table'=>'districts',
				'alias'=>'District',
				'type'=>'INNER',
				'conditions'=>array(
						'District.id = Address.district_id'
				)
			),
			array(
				'table'=>'cities',
				'alias'=>'City',
				'type'=>'INNER',
				'conditions'=>array(
					'City.id = District.city_id'		
				)
			),
			array(
				'table'=>'states',
				'alias'=>'State',
				'type'=>'INNER',
				'conditions'=>array(
					'State.id = City.state_id'
				)
			)
		);
		$options['conditions'] = array(
			'Address.postal_code'=>$cep		
		);
		$options['fields'] = array(
			'Address.*', 'District.*', 'City.*', 'State.*'
		);
		$address = $this->Address->find('first', $options);

		if($address) {			
			//Recupera o sufixo do CEP, que são os três últimos números
			$sufix = substr($cep, 5);
			
			//Cidade de CEP único
			if($sufix == '000') {
				$result['response'] = 2;
				$result['state'] = $address['State']['uf'];
				$result['city'] = $address['City']['name'];	
				$result['district'] = 'Centro';
			}else {
				$result['response'] = 3;
				$result['state'] = $address['State']['uf'];
				$result['city'] = $address['City']['name'];
				$result['district'] = $address['District']['name'];
				$result['address'] = $address['Address']['name'];				
			}
			
		}else {
			$result['response'] = 0;			
		}
		
		return $result;
	} 
	
/**
 * Faz a busca do CEP no webservice
 * @param unknown_type $cep
 */
	private function search_webservice($cep) {
		
		$handler = curl_init('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=json');
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handler, CURLOPT_FOLLOWLOCATION, true);
		//Pega dados do CEP
		$data = curl_exec($handler);
		//Pega código http
		$http_code = curl_getinfo($handler, CURLINFO_HTTP_CODE);
		//
		curl_close($handler);

		if($http_code == 200) {
			$data = json_decode($data);
			if($data->resultado == 1) {
				$result['response'] = 1;
				$result['state'] = $data->uf;
				$result['address'] = $data->tipo_logradouro.' '.$data->logradouro;
				$result['district'] = $data->bairro;
				$result['city'] = $data->cidade;
			}else if($data->resultado == 2) {
				$result['response'] = 2;
				$result['state'] = $data->uf;
				$result['city'] = $data->cidade;
				$result['district'] = 'Centro';
			}else {
				$result['response'] = 0;
			}
		}else {
			$result['response'] = 0;
		}
			
		return $result;		
	}
	
/**
 * auto completar 
 */
	public function autocomplete() {
		
		if($this->request->is('AJAX')) {
			
			$cep = $this->request->data['cep'];
			$model = $this->request->data['model'];
			$query = $this->request->data['term'];
			$options = array(
	            'conditions' => array($model.'.name LIKE' => '%'.$query.'%', $model.'.postal_code'=>$cep),
	            'fields' => array('name', 'id'),
				'limit'=>$this->request->data['limit']
			);
			$data = $this->$model->find('all', $options);
			
			$response = array();
			foreach($data as $i=>$value) {
				$response[$i]= array('label'=>$value[$model]['name']);
			}
			
			echo json_encode($response);
			exit;
		}
	}
}
