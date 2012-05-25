<div class="pngcCodes index">
	<h2><?php echo __('Pngc Codes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('keycode');?></th>
			<th><?php echo $this->Paginator->sort('expense_group_id');?></th>
			<th><?php echo $this->Paginator->sort('functional_unit_id');?></th>
			<th><?php echo $this->Paginator->sort('input_category_id');?></th>
			<th><?php echo $this->Paginator->sort('input_subcategory_id');?></th>
			<th><?php echo $this->Paginator->sort('measure_type_id');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($pngcCodes as $pngcCode): ?>
	<tr>
		<td><?php echo h($pngcCode['PngcCode']['id']); ?>&nbsp;</td>
		<td><?php echo h($pngcCode['PngcCode']['keycode']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pngcCode['ExpenseGroup']['name'], array('controller' => 'expense_groups', 'action' => 'view', $pngcCode['ExpenseGroup']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['FunctionalUnit']['name'], array('controller' => 'functional_units', 'action' => 'view', $pngcCode['FunctionalUnit']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $pngcCode['InputCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $pngcCode['InputSubcategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pngcCode['MeasureType']['name'], array('controller' => 'measure_types', 'action' => 'view', $pngcCode['MeasureType']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $pngcCode['PngcCode']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $pngcCode['PngcCode']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $pngcCode['PngcCode']['id']), null, __('Are you sure you want to delete # %s?', $pngcCode['PngcCode']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('action' => 'add')); ?></li>
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
