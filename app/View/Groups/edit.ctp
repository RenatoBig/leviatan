<div class="span9 well">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php echo __('Editar Grupo'); ?></legend>
		<div>
			<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name', array('label'=>__('Nome')));
			?>
		</div>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar grupo')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'groups', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>

