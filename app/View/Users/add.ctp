<script>
$(document).ready(function() {

	//validação de formulário
	$("#UserAddForm").validate({ 
    	rules: { 			
			'data[User][group_id]':{
				required: true
			},
			'data[User][employee_id]':{
				required: true
			},
			'data[User][password]':{
				required: true
			},
			'data[User][confirm_password]':{
				required: true,
				equalTo: "#UserPassword"
			}
		},
		messages: {
			'data[User][group_id]':{
				required: "Campo obrigatório"
			},
			'data[User][employee_id]':{
				required: "Campo obrigatório"
			},
			'data[User][password]':{
				required: "Campo obrigatório"
			},
			'data[User][confirm_password]':{
				required: "Campo obrigatório",
				equalTo: "Senhas não conferem"
			}
		}
	}); 
	
});
</script>

<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Adicionar usuário'); ?></legend>
	<?php
		echo $this->Form->input('group_id', array('label'=>__('Grupo')));
		echo $this->Form->input('employee_id', array('label'=>__('Funcionário')));
		echo $this->Form->input('password', array('label'=>__('Senha')));
		echo $this->Form->input('confirm_password', array('label'=>__('Confirmar senha')));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Cadastrar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Listar usuários'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
