<script>
$(document).ready(function() {

	//validação de formulário
	$("#GroupAddForm").validate({ 
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
		<legend><?php echo __('Adicionar grupo'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar grupos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar usuários'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo usuário'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
