<div class="networkItems view">
<h2><?php  echo __('Network Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($networkItem['NetworkItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($networkItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $networkItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($networkItem['NetworkItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($networkItem['NetworkItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Network Item'), array('action' => 'edit', $networkItem['NetworkItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Network Item'), array('action' => 'delete', $networkItem['NetworkItem']['id']), null, __('Are you sure you want to delete # %s?', $networkItem['NetworkItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Network Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Network Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
