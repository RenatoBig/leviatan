<?php echo $this->Html->script(array('validate'));?>
<div class="well">
<?php echo $this->Form->create('Area');?>
	<fieldset>
		<legend><?php echo __('Adicionar área'); ?></legend>
		<?php
		echo $this->Form->input('name', array('label'=>__('Nome')));
		?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar área')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('#'), array('class'=>'btn', 'title'=>__('Cancelar'), 'data-dismiss'=>'modal', 'aria-hidden'=>'true'))?>
<?php echo $this->Form->end();?>
</div>
