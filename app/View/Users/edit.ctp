<script>
$(document).ready(function() {

	$("#UserGroupId").attr('disabled', true);
	$("#UserEmployeeId").attr('disabled', true);
	$("#UserUsername").attr('disabled', true);

	//validação de formulário
	$("#UserEditForm").validate({ 
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
		<legend><?php echo __('Editar Usuário'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label'=>__('ID')));
		echo $this->Form->input('group_id', array('label'=>__('Grupo')));
		echo $this->Form->input('employee_id', array('label'=>__('Funcionário')));
		echo $this->Form->input('username', array('label'=>__('Usuário')));
		echo $this->Form->input('password', array('label'=>__('Senha')));
		echo $this->Form->input('confirm_password', array('label'=>__('Confirmar senha'), 'type'=>'password'));		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Alterar'));?>
</div>
<div class="actions">
	<h3><?php echo __('Ações'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Deletar usuário'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Deseja realmente deletar o usuário #%s?', $this->Form->value('User.username'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar usuários'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Novo grupo'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
