<div class="homologations form">
<?php echo $this->Form->create('Homologation');?>
	<fieldset>
		<legend><?php echo __('Add Homologation'); ?></legend>
	<?php
		echo $this->Form->input('order_item_id');
		echo $this->Form->input('remark');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Homologations'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Order Items'), array('controller' => 'order_items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order Item'), array('controller' => 'order_items', 'action' => 'add')); ?> </li>
	</ul>
</div>
