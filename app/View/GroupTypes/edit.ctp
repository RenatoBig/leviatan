<div class="span9 well">
<?php echo $this->Form->create('GroupType');?>
	<fieldset>
		<legend><?php echo __('Editar tipo do grupo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nome'));
	?>
	</fieldset>
<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar tipo do grupo')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'group_types', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
