<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Unidades setores'), array('controller'=>'unity_sectors', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Unidades'), array('controller'=>'unities', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller'=>'employees', 'action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('Setores'), array('controller'=>'sectors', 'action' => 'index')); ?></li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('UnitySector', array('class'=>'well'));?>
	<fieldset>
		<legend><?php echo __('Editar unidade_setor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unity_id', array('label'=>__('Unidade')));
		echo $this->Form->input('sector_id', array('label'=>__('Setor')));
	?>
	</fieldset>
<?php echo $this->Form->end(array('label'=>__('Alterar'), 'class'=>'btn btn-primary'));?>
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


