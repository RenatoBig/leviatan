<div class="span9 well">
<?php echo $this->Form->create('FunctionalUnit');?>
	<fieldset>
		<legend><?php echo __('Adicionar unidade funcional'); ?></legend>
	<?php
		echo $this->Form->input('keycode', array('label'=>__('Código'), 'class'=>'input-mini'));
		echo $this->Form->input('name', array('label'=>__('Nome')));
		echo $this->Form->input('description', array('label'=>__('Descrição')));
		echo $this->Fck->load('FunctionalUnitDescription');
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar unidade funcional')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'functional_units', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
