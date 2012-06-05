<div class="regions index">
	<h2><?php echo __('Regions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('city_id');?></th>
			<th><?php echo $this->Paginator->sort('area_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($regions as $region): ?>
	<tr>
		<td><?php echo h($region['Region']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($region['City']['name'], array('controller' => 'cities', 'action' => 'view', $region['City']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($region['Area']['name'], array('controller' => 'areas', 'action' => 'view', $region['Area']['id'])); ?>
		</td>
		<td><?php echo h($region['Region']['created']); ?>&nbsp;</td>
		<td><?php echo h($region['Region']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $region['Region']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $region['Region']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $region['Region']['id']), null, __('Are you sure you want to delete # %s?', $region['Region']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Areas'), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area'), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities'), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity'), array('controller' => 'unities', 'action' => 'add')); ?> </li>
	</ul>
</div>
