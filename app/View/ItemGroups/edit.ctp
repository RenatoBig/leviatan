<div class="span9 well">
<?php echo $this->Form->create('ItemGroup');?>
	<fieldset>
		<legend><?php echo __('Editar item do grupo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_type_id', array('label'=>'Tipo do grupo'));
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('name', array('label'=>'Nome'));		
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar item do grupo')));?>
	<?php echo $this->Html->link('Cancelar', array('controller'=>'item_groups', 'action'=>'index'), array('class'=>'btn', 'title'=>'Cancelar'));?>
<?php echo $this->Form->end();?>
</div>
