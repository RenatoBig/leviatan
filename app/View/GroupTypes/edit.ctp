<script>
$(document).ready(function() {

	//validação de formulário
	$("#GroupTypeEditForm").validate({ 
    	rules: { 
			'data[GroupType][name]':{
				required: true,
			}
		},
		messages: {
			'data[GroupType][name]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	
});
</script>

<div class="groupTypes form">
<?php echo $this->Form->create('GroupType');?>
	<fieldset>
		<legend><?php echo __('Editar tipos do grupo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nome'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar tipo do grupo'), array('action' => 'delete', $this->Form->value('GroupType.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GroupType.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar tipos de grupos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar itens dos grupos'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
