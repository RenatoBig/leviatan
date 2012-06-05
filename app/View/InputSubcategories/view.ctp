<div class="inputSubcategories view">
<h2><?php  echo __('Input Subcategory');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($inputSubcategory['InputSubcategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Input Subcategory'), array('action' => 'edit', $inputSubcategory['InputSubcategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Input Subcategory'), array('action' => 'delete', $inputSubcategory['InputSubcategory']['id']), null, __('Are you sure you want to delete # %s?', $inputSubcategory['InputSubcategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inputs'), array('controller' => 'inputs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input'), array('controller' => 'inputs', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Inputs');?></h3>
	<?php if (!empty($inputSubcategory['Input'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Input Category Id'); ?></th>
		<th><?php echo __('Input Subcategory Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($inputSubcategory['Input'] as $input): ?>
		<tr>
			<td><?php echo $input['id'];?></td>
			<td><?php echo $input['input_category_id'];?></td>
			<td><?php echo $input['input_subcategory_id'];?></td>
			<td><?php echo $input['created'];?></td>
			<td><?php echo $input['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inputs', 'action' => 'view', $input['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inputs', 'action' => 'edit', $input['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inputs', 'action' => 'delete', $input['id']), null, __('Are you sure you want to delete # %s?', $input['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Input'), array('controller' => 'inputs', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
