<div class="expenseGroups view">
<h2><?php  echo __('Expense Group');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($expenseGroup['ExpenseGroup']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Expense Group'), array('action' => 'edit', $expenseGroup['ExpenseGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Expense Group'), array('action' => 'delete', $expenseGroup['ExpenseGroup']['id']), null, __('Are you sure you want to delete # %s?', $expenseGroup['ExpenseGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Expense Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expense Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pngc Codes');?></h3>
	<?php if (!empty($expenseGroup['PngcCode'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Keycode'); ?></th>
		<th><?php echo __('Expense Group Id'); ?></th>
		<th><?php echo __('Functional Unit Id'); ?></th>
		<th><?php echo __('Input Category Id'); ?></th>
		<th><?php echo __('Input Subcategory Id'); ?></th>
		<th><?php echo __('Measure Type Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($expenseGroup['PngcCode'] as $pngcCode): ?>
		<tr>
			<td><?php echo $pngcCode['id'];?></td>
			<td><?php echo $pngcCode['keycode'];?></td>
			<td><?php echo $pngcCode['expense_group_id'];?></td>
			<td><?php echo $pngcCode['functional_unit_id'];?></td>
			<td><?php echo $pngcCode['input_category_id'];?></td>
			<td><?php echo $pngcCode['input_subcategory_id'];?></td>
			<td><?php echo $pngcCode['measure_type_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pngc_codes', 'action' => 'view', $pngcCode['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pngc_codes', 'action' => 'edit', $pngcCode['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pngc_codes', 'action' => 'delete', $pngcCode['id']), null, __('Are you sure you want to delete # %s?', $pngcCode['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
