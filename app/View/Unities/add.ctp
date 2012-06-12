<script>
$(document).ready(function() {

	//Combobox
	$('#UnityRegionId').parent().hide();
	
	$('#UnityCityId').change(function() {
		if($(this).val() == 0) {
			$('#UnityRegionId').parent().hide('slow');
		}else {
			$('#UnityRegionId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#UnityAddForm").validate({ 
    	rules: { 
			'data[Unity][cnes]':{
				required: true,
			},
			'data[Unity][cnpj]':{
				required: true
			},
			'data[Unity][name]':{
				required: true
			},
			'data[Unity][city_id]':{
				required: true,
			},
			'data[Unity][region_id]':{
				required: true,
			},
			'data[Unity][health_district_id]':{
				required: true,
			},
			'data[Unity][unity_type_id]':{
				required: true,
			}
		},
		messages: {
			'data[Unity][cnes]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][cnpj]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][name]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][city_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][region_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][health_district_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][unity_type_id]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="unities form">
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
					'controller'=>'Regions',
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
		echo $this->Form->input('number', array('label'=>__('Número')));
		echo $this->Form->input('cep', array('label'=>__('CEP')));
		echo $this->Form->input('phone', array('label'=>__('Telefone')));
		echo $this->Form->input('fax', array('label'=>__('FAX')));
		echo $this->Form->input('city_id', array('label'=>__('Cidade')));
		echo $this->Form->input('region_id', array('label'=>__('Área')));
		echo $this->Form->input('health_district_id', array('label'=>__('Distrito sanitário')));
		echo $this->Form->input('unity_type_id', array('label'=>__('Tipo da unidade')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar unidades'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar distritos sanitários'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo distrito sanitário'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar tipos das unidades'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo tipo da unidade'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo unidade_setor'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
