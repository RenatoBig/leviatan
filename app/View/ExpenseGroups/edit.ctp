<script>
$(document).ready(function() {

	//validação de formulário
	$("#ExpenseGroupEditForm").validate({ 
    	rules: { 
			'data[ExpenseGroup][name]':{
				required: true,
			},
			'data[ExpenseGroup][description]':{
				required: true,
			}
		},
		messages: {
			'data[ExpenseGroup][name]':{
				required: "Campo obrigatório.",
			},
			'data[ExpenseGroup][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	
});
</script>

<div class="expenseGroups form">
<?php echo $this->Form->create('ExpenseGroup');?>
	<fieldset>
		<legend><?php echo __('Editar grupo de gastos'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nome'));
		echo $this->Form->input('description', array('label'=>'Descrição'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar grupo de gastos'), array('action' => 'delete', $this->Form->value('ExpenseGroup.id')), null, __('Deseja realmente deletar o grupo de gastos #%s?', $this->Form->value('ExpenseGroup.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar grupo de gastos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar PNGCs'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo PNGC'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
