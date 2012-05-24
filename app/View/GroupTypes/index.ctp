<div class="groupTypes index">
	<h2><?php echo __('Group Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($groupTypes as $groupType): ?>
	<tr>
		<td><?php echo h($groupType['GroupType']['id']); ?>&nbsp;</td>
		<td><?php echo h($groupType['GroupType']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $groupType['GroupType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $groupType['GroupType']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $groupType['GroupType']['id']), null, __('Are you sure you want to delete # %s?', $groupType['GroupType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Group Type'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
