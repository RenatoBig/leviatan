<div class="orderItems view">
<h2><?php  echo __('Order Item');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Order']['id'], array('controller' => 'orders', 'action' => 'view', $orderItem['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Item']['name'], array('controller' => 'items', 'action' => 'view', $orderItem['Item']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo $this->Html->link($orderItem['Status']['name'], array('controller' => 'statuses', 'action' => 'view', $orderItem['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($orderItem['OrderItem']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Order Item'), array('action' => 'edit', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Order Item'), array('action' => 'delete', $orderItem['OrderItem']['id']), null, __('Are you sure you want to delete # %s?', $orderItem['OrderItem']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status'), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Homologations'), array('controller' => 'homologations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Homologation'), array('controller' => 'homologations', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Homologations');?></h3>
	<?php if (!empty($orderItem['Homologation'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Order Item Id'); ?></th>
		<th><?php echo __('Remark'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($orderItem['Homologation'] as $homologation): ?>
		<tr>
			<td><?php echo $homologation['id'];?></td>
			<td><?php echo $homologation['order_item_id'];?></td>
			<td><?php echo $homologation['remark'];?></td>
			<td><?php echo $homologation['created'];?></td>
			<td><?php echo $homologation['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'homologations', 'action' => 'view', $homologation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'homologations', 'action' => 'edit', $homologation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'homologations', 'action' => 'delete', $homologation['id']), null, __('Are you sure you want to delete # %s?', $homologation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Homologation'), array('controller' => 'homologations', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
