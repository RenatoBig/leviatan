<div class="pngcCodes form">
<?php echo $this->Form->create('PngcCode');?>
	<fieldset>
		<legend><?php echo __('Adicionar Código PNGC'); ?></legend>
	<?php
		echo $this->Form->input('keycode', array('label'=>'Código'));
		echo $this->Form->input('expense_group_id', array('label'=>'Grupo de gastos'));
		echo $this->Form->input('functional_unit_id', array('label'=>'Unidade funcional'));
		echo $this->Form->input('input_category_id', array('label'=>'Grupo de insumos'));
		echo $this->Form->input('input_subcategory_id', array('label'=>'Subgrupo de insumos'));
		echo $this->Form->input('measure_type_id', array('label'=>'Unidade de medida'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Expense Groups'), array('controller' => 'expense_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expense Group'), array('controller' => 'expense_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Functional Units'), array('controller' => 'functional_units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Functional Unit'), array('controller' => 'functional_units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Categories'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Category'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measure Types'), array('controller' => 'measure_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure Type'), array('controller' => 'measure_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
