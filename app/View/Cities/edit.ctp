<div class="span9 well">
<?php echo $this->Form->create('City');?>
	<fieldset>
		<legend><?php echo __('Editar cidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('keycode', array('label'=>__('Código')));
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar cidade')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'cities', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
