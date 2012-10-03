<?php echo $this->Html->script(array('validate'));?>
<div class="well">
<?php echo $this->Form->create('Sector');?>
	<fieldset>
		<legend><?php echo __('Adicionar setor'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Cadastrar setor')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('#'), array('class'=>'btn', 'title'=>__('Cancelar'), 'data-dismiss'=>'modal', 'aria-hidden'=>'true'))?>
<?php echo $this->Form->end();?>
</div>

