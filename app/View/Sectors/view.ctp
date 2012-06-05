<div class="sectors view">
<h2><?php  echo __('Sector');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sector['Sector']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sector'), array('action' => 'edit', $sector['Sector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sector'), array('action' => 'delete', $sector['Sector']['id']), null, __('Are you sure you want to delete # %s?', $sector['Sector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unity Sectors'), array('controller' => 'unity_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Unity Sectors');?></h3>
	<?php if (!empty($sector['UnitySector'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unity Id'); ?></th>
		<th><?php echo __('Sector Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sector['UnitySector'] as $unitySector): ?>
		<tr>
			<td><?php echo $unitySector['id'];?></td>
			<td><?php echo $unitySector['unity_id'];?></td>
			<td><?php echo $unitySector['sector_id'];?></td>
			<td><?php echo $unitySector['created'];?></td>
			<td><?php echo $unitySector['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'unity_sectors', 'action' => 'view', $unitySector['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'unity_sectors', 'action' => 'edit', $unitySector['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'unity_sectors', 'action' => 'delete', $unitySector['id']), null, __('Are you sure you want to delete # %s?', $unitySector['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unity Sector'), array('controller' => 'unity_sectors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
