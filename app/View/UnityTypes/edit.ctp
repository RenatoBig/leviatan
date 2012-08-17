<div class="span9 well">
	<?php echo $this->Form->create('UnityType');?>
		<fieldset>
			<legend><?php echo __('Editar tipo da unidade'); ?></legend>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name', array('label'=>__('Nome')));
		?>
		</fieldset>
		<?php echo $this->Form->button(__('Alterar'), array('class'=>'btn btn-primary', 'title'=>__('Alterar dados do tipo da unidade')));?>
		<?php echo $this->Html->link('Cancelar', array('controller'=>'unity_types', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')));?>
	<?php echo $this->Form->end();?>
</div>
