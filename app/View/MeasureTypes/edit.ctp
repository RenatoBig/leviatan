<div class="span9 well">
<?php echo $this->Form->create('MeasureType');?>
	<fieldset>
		<legend><?php echo __('Editar tipo de medida'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar tipo de medida')));?>
	<?php echo $this->Html->link('Cancelar', array('controller'=>'measure_types', 'action'=>'index'), array('class'=>'btn', 'title'=>'Cancelar'));?>
<?php echo $this->Form->end();?>
</div>
