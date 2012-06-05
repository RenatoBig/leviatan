<div class="groupTypes view">
<h2><?php  echo __('Group Type');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($groupType['GroupType']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group Type'), array('action' => 'edit', $groupType['GroupType']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group Type'), array('action' => 'delete', $groupType['GroupType']['id']), null, __('Are you sure you want to delete # %s?', $groupType['GroupType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Types'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Type'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Item Groups');?></h3>
	<?php if (!empty($groupType['ItemGroup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Keycode'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Group Type Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($groupType['ItemGroup'] as $itemGroup): ?>
		<tr>
			<td><?php echo $itemGroup['id'];?></td>
			<td><?php echo $itemGroup['keycode'];?></td>
			<td><?php echo $itemGroup['name'];?></td>
			<td><?php echo $itemGroup['group_type_id'];?></td>
			<td><?php echo $itemGroup['created'];?></td>
			<td><?php echo $itemGroup['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'item_groups', 'action' => 'view', $itemGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'item_groups', 'action' => 'edit', $itemGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'item_groups', 'action' => 'delete', $itemGroup['id']), null, __('Are you sure you want to delete # %s?', $itemGroup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
