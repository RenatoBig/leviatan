<div class="span9 well">
<?php echo $this->Form->create('UnitySector');?>
	<fieldset>
		<legend><?php echo __('Editar unidade_setor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unity_id', array('label'=>__('Unidade')));
		echo $this->Form->input('sector_id', array('label'=>__('Setor')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar dados da unidade setor')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'unity_sectors', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
<!--
//Função que retira o nome da área atual quando clica no select da área
$('#UnitySectorEditForm #UnitySectorSectorId').click(function() {
	var unidade = '<?php echo $this->request->data['Unity']['id']?>';
	var setor = '<?php echo $this->request->data['Sector']['id']?>';

	var unitySelect = document.getElementById("UnitySectorUnityId");
	var sectorSelect = document.getElementById("UnitySectorSectorId");
	
	if(unitySelect.value == unidade && sectorSelect.value == setor) {
		sectorSelect.remove(sectorSelect.selectedIndex);
	}		
});
//-->
</script>


