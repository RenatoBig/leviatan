<div class="inputs index">
	<h2><?php echo __('Inputs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('input_category_id');?></th>
			<th><?php echo $this->Paginator->sort('input_subcategory_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($inputs as $input): ?>
	<tr>
		<td><?php echo h($input['Input']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($input['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $input['InputCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($input['InputSubcategory']['name'], array('controller' => 'input_subcategories', 'action' => 'view', $input['InputSubcategory']['id'])); ?>
		</td>
		<td><?php echo h($input['Input']['created']); ?>&nbsp;</td>
		<td><?php echo h($input['Input']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $input['Input']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $input['Input']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $input['Input']['id']), null, __('Are you sure you want to delete # %s?', $input['Input']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Input'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Input Categories'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Category'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Input Subcategories'), array('controller' => 'input_subcategories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('controller' => 'input_subcategories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
