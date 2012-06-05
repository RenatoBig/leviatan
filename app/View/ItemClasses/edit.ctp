<div class="itemClasses form">
<?php echo $this->Form->create('ItemClass');?>
	<fieldset>
		<legend><?php echo __('Edit Item Class'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item_group_id');
		echo $this->Form->input('keycode');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ItemClass.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ItemClass.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Item Classes'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Item Groups'), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item Group'), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Item'), array('controller' => 'items', 'action' => 'add')); ?> </li>
	</ul>
</div>
