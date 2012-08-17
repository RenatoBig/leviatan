<div class="span9 well">
<?php echo $this->Form->create('InputCategory');?>
	<fieldset>
		<legend><?php echo __('Editar categoria de insumo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar categoria')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'input_categories', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
