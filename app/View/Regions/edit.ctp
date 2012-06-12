<script>
$(document).ready(function() {
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
