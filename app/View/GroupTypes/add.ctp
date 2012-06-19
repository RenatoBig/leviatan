<script>
$(document).ready(function() {

	//validação de formulário
	$("#GroupTypeAddForm").validate({ 
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
		<legend><?php echo __('Adicionar tipo do grupo'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>'Nome'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar tipos dos grupos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar itens dos grupos'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo item do grupo'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
