<div class="span9 well">
<?php echo $this->Form->create('Status');?>
	<fieldset>
		<legend><?php echo __('Editar Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar status')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'statuses', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
