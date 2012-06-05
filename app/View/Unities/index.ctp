<div class="unities index">
	<h2><?php echo __('Unities');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('cnes');?></th>
			<th><?php echo $this->Paginator->sort('cnpj');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('trade_name');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('number');?></th>
			<th><?php echo $this->Paginator->sort('cep');?></th>
			<th><?php echo $this->Paginator->sort('phone');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('region_id');?></th>
			<th><?php echo $this->Paginator->sort('health_district_id');?></th>
			<th><?php echo $this->Paginator->sort('unity_type_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($unities as $unity): ?>
	<tr>
		<td><?php echo h($unity['Unity']['id']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cnes']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cnpj']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['name']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['trade_name']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['address']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['number']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['cep']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['phone']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['fax']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($unity['Region']['id'], array('controller' => 'regions', 'action' => 'view', $unity['Region']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['HealthDistrict']['name'], array('controller' => 'health_districts', 'action' => 'view', $unity['HealthDistrict']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($unity['UnityType']['name'], array('controller' => 'unity_types', 'action' => 'view', $unity['UnityType']['id'])); ?>
		</td>
		<td><?php echo h($unity['Unity']['created']); ?>&nbsp;</td>
		<td><?php echo h($unity['Unity']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $unity['Unity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $unity['Unity']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $unity['Unity']['id']), null, __('Are you sure you want to delete # %s?', $unity['Unity']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Unity'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Health Districts'), array('controller' => 'health_districts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Health District'), array('controller' => 'health_districts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Types'), array('controller' => 'unity_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Type'), array('controller' => 'unity_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
