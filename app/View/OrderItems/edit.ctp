<div class="orderItems form">
<?php echo $this->Form->create('OrderItem');?>
	<fieldset>
		<legend><?php echo __('Edit Order Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_id');
		echo $this->Form->input('item_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('status_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrderItem.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrderItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index'));?></li>
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
