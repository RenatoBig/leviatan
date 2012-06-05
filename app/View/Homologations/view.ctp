<div class="homologations view">
<h2><?php  echo __('Homologation');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($homologation['OrderItem']['id'], array('controller' => 'order_items', 'action' => 'view', $homologation['OrderItem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remark'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['remark']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($homologation['Homologation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Homologation'), array('action' => 'edit', $homologation['Homologation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Homologation'), array('action' => 'delete', $homologation['Homologation']['id']), null, __('Are you sure you want to delete # %s?', $homologation['Homologation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Homologations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Homologation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
