<div class="orderItems form">
<?php echo $this->Form->create('OrderItem'); ?>
	<fieldset>
		<legend><?php echo __('Edit Order Item'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('order_id');
		echo $this->Form->input('solicitation_item_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrderItem.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('OrderItem.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Solicitation Items'), array('controller' => 'solicitation_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Solicitation Item'), array('controller' => 'solicitation_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
