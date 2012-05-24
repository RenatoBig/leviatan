<div class="itemClasses index">
	<h2><?php echo __('Item Classes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('item_group_id');?></th>
			<th><?php echo $this->Paginator->sort('keycode');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($itemClasses as $itemClass): ?>
	<tr>
		<td><?php echo h($itemClass['ItemClass']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($itemClass['ItemGroup']['name'], array('controller' => 'item_groups', 'action' => 'view', $itemClass['ItemGroup']['id'])); ?>
		</td>
		<td><?php echo h($itemClass['ItemClass']['keycode']); ?>&nbsp;</td>
		<td><?php echo h($itemClass['ItemClass']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itemClass['ItemClass']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itemClass['ItemClass']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itemClass['ItemClass']['id']), null, __('Are you sure you want to delete # %s?', $itemClass['ItemClass']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Item Class'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
