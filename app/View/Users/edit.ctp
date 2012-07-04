<div class="span2">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li class="nav-header"><h3><?php echo __('Ações'); ?></h3></li>
			<li class="divider"></li>
			<li><?php echo $this->Html->link(__('Novo usuário'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('Grupos'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Funcionários'), array('controller' => 'employees', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('Pedidos'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		</ul>
	</div>
</div>

<div class="span4">
<?php echo $this->Form->create('User', array('class'=>'well'));?>
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
<?php echo $this->Form->end(array('label'=>__('Alterar'), 'class'=>'btn btn-primary'));?>
</div>

