<div class="itemGroups view">
<h2><?php  echo __('Item Group');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itemGroup['GroupType']['name'], array('controller' => 'group_types', 'action' => 'view', $itemGroup['GroupType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Key'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($itemGroup['ItemGroup']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Item Group'), array('action' => 'edit', $itemGroup['ItemGroup']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Item Group'), array('action' => 'delete', $itemGroup['ItemGroup']['id']), null, __('Are you sure you want to delete # %s?', $itemGroup['ItemGroup']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Types'), array('controller' => 'group_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Type'), array('controller' => 'group_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
