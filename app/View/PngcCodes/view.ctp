<div class="pngcCodes view">
<h2><?php  echo __('Pngc Code');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keycode'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['keycode']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expense Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['ExpenseGroup']['name'], array('controller' => 'expense_groups', 'action' => 'view', $pngcCode['ExpenseGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Functional Unit'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['FunctionalUnit']['name'], array('controller' => 'functional_units', 'action' => 'view', $pngcCode['FunctionalUnit']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input Id'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['input_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pngcCode['MeasureType']['name'], array('controller' => 'measure_types', 'action' => 'view', $pngcCode['MeasureType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pngcCode['PngcCode']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pngc Code'), array('action' => 'edit', $pngcCode['PngcCode']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pngc Code'), array('action' => 'delete', $pngcCode['PngcCode']['id']), null, __('Are you sure you want to delete # %s?', $pngcCode['PngcCode']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Items');?></h3>
	<?php if (!empty($pngcCode['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Item Class Id'); ?></th>
		<th><?php echo __('Pngc Code Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Image Path'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pngcCode['Item'] as $item): ?>
		<tr>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['item_class_id'];?></td>
			<td><?php echo $item['pngc_code_id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['description'];?></td>
			<td><?php echo $item['image_path'];?></td>
			<td><?php echo $item['created'];?></td>
			<td><?php echo $item['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $item['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'items', 'action' => 'edit', $item['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'items', 'action' => 'delete', $item['id']), null, __('Are you sure you want to delete # %s?', $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
