<div class="span9 well">
<?php echo $this->Form->create('Region', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar Região'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id', array('label'=>__('Cidade'), 'onChange'=>'selectFill("areas", "get_areas", options[selectedIndex].value)'));
		echo $this->Form->input('area_id', array('label'=>__('Área'), 'id'=>'select_child'));
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
