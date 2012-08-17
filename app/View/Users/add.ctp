<div class="span9 well">
	<?php echo $this->Form->create('User', array('class'=>'well'));?>
		<fieldset>
			<legend><?php echo __('Adicionar usuário'); ?></legend>
			<?php
			echo $this->Form->input('group_id', array('label'=>__('Grupo')));
			echo $this->Form->input('employee_id', array('label'=>__('Funcionário')));
			echo $this->Form->input('password', array('label'=>__('Senha')));
			echo $this->Form->input('confirm_password', array('label'=>__('Confirmar senha'), 'type'=>'password'));		
			?>
		</fieldset>
		<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar usuário')));?>
		<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'users', 'action'=>'index'), array('title'=>__('Cancelar'), 'class'=>'btn'))?>
	<?php echo $this->Form->end(); ?>	
</div>

