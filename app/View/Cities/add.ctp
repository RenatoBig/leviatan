<?php echo $this->Html->script(array('validate'));?>
<div class="well">
<?php echo $this->Form->create('City');?>
	<fieldset>
		<legend><?php echo __('Adicionar cidade'); ?></legend>
	<?php
		echo $this->Form->input('keycode', array('label'=>__('Código'), 'class'=>'input-mini'));
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar cidade')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('#'), array('class'=>'btn', 'title'=>__('Cancelar'), 'data-dismiss'=>'modal', 'aria-hidden'=>'true'))?>
<?php echo $this->Form->end();?>
</div>

