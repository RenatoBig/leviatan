<div class="inputs view">
<h2><?php  echo __('Input');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($input['Input']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($input['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $input['InputCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Input Subcategory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($input['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $input['InputSubcategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($input['Input']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($input['Input']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Input'), array('action' => 'edit', $input['Input']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Input'), array('action' => 'delete', $input['Input']['id']), null, __('Are you sure you want to delete # %s?', $input['Input']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Inputs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Categories'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Category'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pngc Codes');?></h3>
	<?php if (!empty($input['PngcCode'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Keycode'); ?></th>
		<th><?php echo __('Expense Group Id'); ?></th>
		<th><?php echo __('Functional Unit Id'); ?></th>
		<th><?php echo __('Input Id'); ?></th>
		<th><?php echo __('Measure Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($input['PngcCode'] as $pngcCode): ?>
		<tr>
			<td><?php echo $pngcCode['id'];?></td>
			<td><?php echo $pngcCode['keycode'];?></td>
			<td><?php echo $pngcCode['expense_group_id'];?></td>
			<td><?php echo $pngcCode['functional_unit_id'];?></td>
			<td><?php echo $pngcCode['input_id'];?></td>
			<td><?php echo $pngcCode['measure_type_id'];?></td>
			<td><?php echo $pngcCode['created'];?></td>
			<td><?php echo $pngcCode['modified'];?></td>
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
