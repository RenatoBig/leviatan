<script>
$(document).ready(function() {

	//validação de formulário
	$("#HealthDistrictEditForm").validate({ 
    	rules: { 			
			'data[HealthDistrict][name]':{
				required: true
			}
		},
		messages: {
			
			'data[HealthDistrict][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="healthDistricts form">
<?php echo $this->Form->create('HealthDistrict');?>
	<fieldset>
		<legend><?php echo __('Editar distrito sanitário'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar distrito sanitário'), array('action' => 'delete', $this->Form->value('HealthDistrict.id')), null, __('Deseja realmente deletar o distrito sanitário #%s?', $this->Form->value('HealthDistrict.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar distritos sanitários'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
