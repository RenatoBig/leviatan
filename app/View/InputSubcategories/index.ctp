<div class="inputSubcategories index">
	<h2><?php echo __('Input Subcategories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('input_category_id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($inputSubcategories as $inputSubcategory): ?>
	<tr>
		<td><?php echo h($inputSubcategory['InputSubcategory']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inputSubcategory['InputCategory']['name'], array('controller' => 'input_categories', 'action' => 'view', $inputSubcategory['InputCategory']['id'])); ?>
		</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($inputSubcategory['InputSubcategory']['description']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inputSubcategory['InputSubcategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inputSubcategory['InputSubcategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inputSubcategory['InputSubcategory']['id']), null, __('Are you sure you want to delete # %s?', $inputSubcategory['InputSubcategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Input Subcategory'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Input Categories'), array('controller' => 'input_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Input Category'), array('controller' => 'input_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pngc Codes'), array('controller' => 'pngc_codes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pngc Code'), array('controller' => 'pngc_codes', 'action' => 'add')); ?> </li>
	</ul>
</div>
