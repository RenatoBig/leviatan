<div class="span9 well">
<?php echo $this->Form->create('ItemClass');?>
	<fieldset>
		<legend><?php echo __('Adicionar classe do item'); ?></legend>
	<?php
		echo $this->Form->input('item_group_id', array('label'=>'Grupo do item'));
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('name', array('label'=>'Nome'));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar classe do item')));?>
	<?php echo $this->Html->link('Cancelar', array('controller'=>'item_classes', 'action'=>'index'), array('class'=>'btn', 'title'=>'Cancelar'));?>
<?php echo $this->Form->end();?>
</div>
