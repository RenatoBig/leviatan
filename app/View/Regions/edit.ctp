<div class="span9 well">
<?php echo $this->Form->create('Region', array('class'=>'well'));?>
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
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar região')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'regions', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>

<script type="text/javascript">
<!--
//Função que retira o nome da área atual quando clica no select da área
$('#RegionEditForm #RegionAreaId').click(function() {
	var cidade = '<?php echo $this->request->data['City']['id']?>';
	var area = '<?php echo $this->request->data['Area']['id']?>';

	var citySelect = document.getElementById("RegionCityId");
	var areaSelect = document.getElementById("RegionAreaId");
	
	if(areaSelect.value == area && citySelect.value == cidade) {
		areaSelect.remove(areaSelect.selectedIndex);
	}		
});
//-->
</script>
