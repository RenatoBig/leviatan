<div class="span9 well">
<?php echo $this->Form->create('HealthDistrict');?>
	<fieldset>
		<legend><?php echo __('Adicionar distrito sanitário'); ?></legend>
		<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
		?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar distrito sanitário')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'health_districts', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>

