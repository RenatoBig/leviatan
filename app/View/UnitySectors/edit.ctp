<script>
$(document).ready(function() {

	//validação de formulário
	$("#UnitySectorEditForm").validate({ 
    	rules: { 
			'data[UnitySector][unity_id]':{
				required: true,
			},
			'data[UnitySector][sector_id]':{
				required: true
			}
		},
		messages: {
			'data[UnitySector][unity_id]':{
				required: "Este campo é obrigatório"
			},
			'data[UnitySector][sector_id]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="unitySectors form">
<?php echo $this->Form->create('UnitySector');?>
	<fieldset>
		<legend><?php echo __('Editar unidade_setor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('unity_id', array('label'=>__('Unidade')));
		echo $this->Form->input('sector_id', array('label'=>__('Setor')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar unidade_setor'), array('action' => 'delete', $this->Form->value('UnitySector.id')), null, __('Deseja realmente deletar a unidade_setor #%s?', $this->Form->value('UnitySector.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar unidades_setores'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar unidades'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova unidade'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar setores'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo setor'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Listar funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo funcionário'), array('controller' => 'employees', 'action' => 'add')); ?> </li>
	</ul>
</div>
