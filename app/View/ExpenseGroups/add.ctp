<div class="span9 well">
<?php echo $this->Form->create('ExpenseGroup');?>
	<fieldset>
		<legend><?php echo __('Adicionar grupo de gastos'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label'=>'Nome'));
		echo $this->Form->input('description', array('label'=>'Descrição'));
		echo $this->Fck->load('ExpenseGroupDescription');
	?>
	</fieldset>
	<?php echo $this->Form->button(__('Cadastrar'), array('class'=>'btn btn-primary', 'title'=>__('cadastrar grupo de gastos')));?>
	<?php echo $this->Html->link(__('Cancelar'), array('controller'=>'expense_groups', 'action'=>'index'), array('class'=>'btn', 'title'=>__('Cancelar')))?>
<?php echo $this->Form->end();?>
</div>
