<script>
$(document).ready(function() {

	$('#RegionCityId').change(function() {		
		if($(this).val() == 0) {
			$('#RegionAreaId').parent().hide('slow');
		}else {
			$('#RegionAreaId').parent().show('slow');
		}
	});
	
	//Função que retira o nome da área atual quando clica no select da área
	$('#RegionAreaId').click(function() {
		var cidade = '<?php echo $this->request->data['City']['id']?>';
		var area = '<?php echo $this->request->data['Area']['id']?>';

		var citySelect = document.getElementById("RegionCityId");
		var areaSelect = document.getElementById("RegionAreaId");
		
		if(areaSelect.value == area && citySelect.value == cidade) {
			areaSelect.remove(areaSelect.selectedIndex);
		}		
	});
	
	
	//validação de formulário
	$("#RegionEditForm").validate({ 
    	rules: {
			'data[Region][city_id]':{
				required: true
			},
			'data[Region][area_id]':{
				required: true
			}
		},
		messages: {			
			'data[Region][city_id]':{
				required: "Selecione uma região."
			},
			'data[Region][area_id]':{
				required: "Selecione um área"
			}
		}
	}); 
});
</script>

<div class="regions form">
<?php echo $this->Form->create('Region');?>
	<fieldset>
		<legend><?php echo __('Editar Região'); ?></legend>
	<?php
		//requisição feita quando se muda a cidade. Como resposta ele popula o select
		//das regiões com as que ainda não foram cadastradas 
		//-------------------
		$this->Js->get('#RegionCityId')->event('change', 
			$this->Js->request(
				array(
					'controller'=>'Areas',
					'action'=>'getAreas'
				), 
				array(
					'update'=>'#RegionAreaId',
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
		echo $this->Form->input('id');
		echo $this->Form->input('city_id', array('label'=>__('Cidade')));
		echo $this->Form->input('area_id', array('label'=>__('Área')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar região'), array('action' => 'delete', $this->Form->value('Region.id')), null, __('Deseja realmente deletar #%s?', $this->Form->value('Region.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Lista regiões'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Lista cidades'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova cidade'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista áreas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova área'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Lista unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
