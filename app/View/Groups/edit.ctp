<script>
$(document).ready(function() {

	//validação de formulário
	$("#GroupEditForm").validate({ 
    	rules: { 			
			'data[Group][name]':{
				required: true
			}
		},
		messages: {
			'data[Group][name]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});
</script>

<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php echo __('Editar Grupo'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Deletar grupo'), array('action' => 'delete', $this->Form->value('Group.id')), null, __('Deseja realmente deletar o grupo #%s?', $this->Form->value('Group.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Grupos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
