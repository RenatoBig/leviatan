<div class="span9 well">
<?php echo $this->Form->create('Area');?>
	<fieldset>
		<legend><?php echo __('Editar Área'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar área')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'areas', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
