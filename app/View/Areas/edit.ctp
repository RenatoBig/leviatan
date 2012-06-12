<script>
$(document).ready(function() {

	//validação de formulário
	$("#AreaEditForm").validate({ 
    	rules: { 
			'data[Area][name]':{
				required: true
			}
		},
		messages: {
			'data[Area][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
});
</script>

<div class="areas form">
<?php echo $this->Form->create('Area');?>
	<fieldset>
		<legend><?php echo __('Editar Área'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Deletar área'), array('action' => 'delete', $this->Form->value('Area.id')), null, __('Deseja realmente deletar #%s?', $this->Form->value('Area.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Lista de áreas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Lista de regiões'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Nova região'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
	</ul>
</div>
