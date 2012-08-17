<div class="span9 well">
<?php echo $this->Form->create('Unity');?>
	<fieldset>
		<legend><?php echo __('Adicionar unidade'); ?></legend>
	<?php		
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das áreas de acordo com a cidade escolhida 
		//-------------------
		$this->Js->get('#UnityCityId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'regions',
					'action'=>'getAreas'
				), 
				array(
					'update'=>'#UnityRegionId',
					'async' => true,
					'method' => 'post',
					'dataExpression'=>true,
					'data'=> $this->Js->serializeForm(
						array(
							'isForm' => true,
							'inline' => true
						)
					)
				)
			)
		);		
		//----------------------
		echo $this->Form->input('cnes', array('label'=>__('CNES')));
		echo $this->Form->input('cnpj', array('label'=>__('CNPJ')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('trade_name', array('label'=>__('Nome fantasia')));
		echo $this->Form->input('address', array('label'=>__('Endereço')));
		echo $this->Form->input('number', array('label'=>__('Número'), 'class'=>'input-mini'));
		echo $this->Form->input('cep', array('label'=>__('CEP')));
		echo $this->Form->input('phone', array('label'=>__('Telefone')));
		echo $this->Form->input('fax', array('label'=>__('FAX')));
		echo $this->Form->input('city_id', array('label'=>__('Cidade')));
		echo $this->Form->input('region_id', array('label'=>__('Área')));
		echo $this->Form->input('health_district_id', array('label'=>__('Distrito sanitário')));
		echo $this->Form->input('unity_type_id', array('label'=>__('Tipo da unidade')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar unidade')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unities', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
	
<?php echo $this->Form->end();?>
</div>
