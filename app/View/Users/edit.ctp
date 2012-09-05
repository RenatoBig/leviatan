<div class="span9 well">
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
		<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar dados do usuário'))); ?>
		<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'users', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
	
	<?php echo $this->Form->end(); ?>
</div>

